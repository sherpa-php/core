<?php

namespace Sherpa\Core\router;

use Sherpa\Core\containment\Bag;
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
    public private(set) Bag $data;
    public private(set) Bag $files;
    public private(set) Bag $sherpaData;

    public function __construct()
    {
        $this->httpMethod = HttpMethod::from($_SERVER["REQUEST_METHOD"]);
        $this->url = URI::getSherpaPath();
        $this->data = new Bag(URI::getExternalData());
        $this->files = new Bag(URI::getFiles());
        $this->sherpaData = new Bag(URI::getSherpaData());
    }

    /**
     * @param string|null $key Data key
     * @return mixed All data if no one key is given
     *               else, data value from given key
     */
    public function data(?string $key = null): mixed
    {
        return $key !== null
            ? ($this->data->has($key)
                ? Security::secureData($this->data->get($key))
                : null)
            : $this->data->all();
    }

    /**
     * @return array Request's files array
     */
    public function files(): array
    {
        $filteredFiles = array_filter(
            $this->files->all(),
            fn ($file) => File::validate($file));

        return array_map(function ($file)
        {
            return File::make($file);
        }, $filteredFiles);
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
     * @return self|null Current (singleton) Request object
     */
    public static function current(): ?self
    {
        return static::$current;
    }
}