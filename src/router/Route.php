<?php

namespace Sherpa\Core\router;

use Sherpa\Core\core\Sherpa;
use Sherpa\Core\router\http\HttpMethod;

class Route
{
    private HttpMethod $httpMethod;
    private string $path;
    private string $controllerClass;
    private string $controllerMethod;
    private ?string $name;

    public function __construct(
        HttpMethod $httpMethod,
        string $path,
        string $controllerClass,
        string $controllerMethod,
        ?string $name = null)
    {
        $this->httpMethod = $httpMethod;
        $this->path = $path;
        $this->controllerClass = $controllerClass;
        $this->controllerMethod = $controllerMethod;
        $this->name = $name;
    }

    public function httpMethod(?HttpMethod $httpMethod = null): self|HttpMethod
    {
        if ($httpMethod !== null)
        {
            $this->httpMethod = $httpMethod;

            return $this;
        }

        return $this->httpMethod;
    }

    public function path(?string $path = null): self|string
    {
        if ($path !== null)
        {
            $this->path = $path;

            return $this;
        }

        return $this->path;
    }

    public function controller(?string $controllerClass = null): self|string
    {
        if ($controllerClass !== null)
        {
            $this->controllerClass = $controllerClass;

            return $this;
        }

        return $this->controllerClass;
    }

    public function method(?string $controllerMethod = null): self|string
    {
        if ($controllerMethod !== null)
        {
            $this->controllerMethod = $controllerMethod;

            return $this;
        }

        return $this->controllerMethod;
    }

    public function removeMethod(): self
    {
        $this->controllerMethod = Sherpa::DEFAULT_CONTROLLER_METHOD;

        return $this;
    }

    public function name(?string $name = null): self|string
    {
        if ($name !== null)
        {
            $this->name = $name;

            return $this;
        }

        return $this->name;
    }

    public function removeName(): self
    {
        $this->name = null;

        return $this;
    }
}