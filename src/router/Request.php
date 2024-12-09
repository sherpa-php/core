<?php

namespace Sherpa\Core\router;

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
                ? Security::secureData($this->data[$key])
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
     * @return self|null Current (singleton) Request object
     */
    public static function current(): ?self
    {
        return static::$current;
    }
}