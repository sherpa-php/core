<?php

namespace Sherpa\Core\router;

use Sherpa\Core\files\File;
use Sherpa\Core\router\http\HttpMethod;
use Sherpa\Core\router\utils\URI;
use Sherpa\Core\security\Security;

/**
 * Request entity class.
 * <p>
 *     Save current request data in it.
 * </p>
 */
class Request
{
    /** Current Request object. */
    private static ?self $current = null;

    public private(set) HttpMethod $httpMethod;
    public private(set) string $url;
    private array $data;
    private array $files;
    public private(set) array $sherpaData;

    public function __construct()
    {
        $this->httpMethod = HttpMethod::from($_SERVER["REQUEST_METHOD"]);
        $this->url = URI::getSherpaPath();
        $this->data = URI::getExternalData();
        $this->files = URI::getFiles();
        $this->sherpaData = URI::getSherpaData();
    }

    /**
     * @param string|null $key Data key
     * @return mixed All data if no one key is given
     *               else, data value from given key
     */
    public function data(?string $key = null): mixed
    {
        return $key !== null
            ? ($this->has($key)
                ? Security::secureData($this->data[$key])
                : null)
            : $this->data;
    }

    /**
     * @return array Request's files array
     */
    public function files(): array
    {
        return array_map(function ($file)
        {
            return File::make($file);
        }, $this->files);
    }

    /**
     * @param string $key File field's name
     * @return mixed File object if exists; else NULL
     */
    public function file(string $key): mixed
    {
        if (!in_array($key, array_keys($this->files())))
        {
            return null;
        }

        return $this->files()[$key];
    }

    /**
     * @param string $key Data key
     * @return bool If data key exists
     */
    public function has(string $key): bool
    {
        return isset($this->data[$key]);
    }

    /**
     * @return self|null Current (singleton) Request object
     */
    public static function current(): ?self
    {
        return static::$current;
    }
}