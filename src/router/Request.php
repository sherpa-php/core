<?php

namespace Sherpa\Core\router;

use Sherpa\Core\router\http\HttpMethod;
use Sherpa\Core\router\utils\URI;

class Request
{
    public private(set) HttpMethod $httpMethod;

    public private(set) string $url;

    private array $data;
    public private(set) array $sherpaData;

    public function __construct()
    {
        $this->httpMethod = HttpMethod::from($_SERVER["REQUEST_METHOD"]);
        $this->url = $_GET["sherpaf__path"] ?? "";
        $this->data = URI::getExternalData();
        $this->sherpaData = URI::getSherpaData();
    }

    public function data(?string $key = null): mixed
    {
        return $key !== null
            ? $this->data[$key] ?? null
            : $this->data;
    }

    public function has(string $key): bool
    {
        return isset($this->data[$key]);
    }
}