<?php

namespace SherpaCore\router;

use SherpaCore\router\http\HttpMethod;

class Route
{
    public private(set) HttpMethod $httpMethod;
    public private(set) string $path;
    public private(set) string $controllerClass;
    public private(set) ?string $controllerMethod;
    public private(set) ?string $name;

    public function __construct(
        HttpMethod $httpMethod,
        string $path,
        string $controllerClass,
        ?string $controllerMethod = null,
        ?string $name = null)
    {
        $this->httpMethod = $httpMethod;
        $this->path = $path;
        $this->controllerClass = $controllerClass;
        $this->controllerMethod = $controllerMethod;
        $this->name = $name;
    }

    public function httpMethod(HttpMethod $httpMethod): self
    {
        $this->httpMethod = $httpMethod;

        return $this;
    }

    public function path(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    public function controller(string $controllerClass): self
    {
        $this->controllerClass = $controllerClass;

        return $this;
    }

    public function method(?string $controllerMethod = null): self
    {
        $this->controllerMethod = $controllerMethod;

        return $this;
    }

    public function name(string $name): self
    {
        $this->name = $name;

        return $thid;
    }
}