<?php

namespace Sherpa\Core\router;

use Sherpa\Core\router\http\HttpMethod;
use Sherpa\Core\router\utils\URI;

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
    public private(set) array $sherpaData;

    public function __construct()
    {
        $this->httpMethod = HttpMethod::from($_SERVER["REQUEST_METHOD"]);
        $this->url = URI::getSherpaPath();
        $this->data = URI::getExternalData();
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
                ? self::secureData($this->data[$key])
                : null)
            : $this->data;
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
     * Secures provided data for using in back-end.
     * <p>
     *     It prevents from injections and other kinds of attack.
     * </p>
     *
     * @param mixed $data Data value to secure
     * @return mixed Secured data value
     */
    private static function secureData(mixed $data): mixed
    {
        if (is_string($data))
        {
            $data = htmlspecialchars($data);
        }

        return $data;
    }

    /**
     * @return self|null Current (singleton) Request object
     */
    public static function current(): ?self
    {
        return static::$current;
    }
}