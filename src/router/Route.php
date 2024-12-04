<?php

namespace Sherpa\Core\router;

use Sherpa\Core\core\Sherpa;
use Sherpa\Core\router\http\HttpMethod;

/**
 * Route entity class.
 * <p>
 *     Detains all route's information.
 * </p>
 */
class Route
{
    private HttpMethod $httpMethod;
    private string $path;
    private string $controllerClass;
    private string $controllerMethod;
    private ?string $name;
    private array $middlewares;

    public function __construct(
        HttpMethod $httpMethod,
        string $path,
        string $controllerClass,
        string $controllerMethod,
        ?string $name = null,
        array $middlewares = [])
    {
        $this->httpMethod = $httpMethod;
        $this->path = $path;
        $this->controllerClass = $controllerClass;
        $this->controllerMethod = $controllerMethod;
        $this->name = $name;
        $this->middlewares = $middlewares;
    }

    /**
     * Get or set route's HTTP method.
     *
     * @param HttpMethod|null $httpMethod To set an HTTP method
     * @return HttpMethod|$this|self
     */
    public function httpMethod(?HttpMethod $httpMethod = null): self|HttpMethod
    {
        if ($httpMethod !== null)
        {
            $this->httpMethod = $httpMethod;

            return $this;
        }

        return $this->httpMethod;
    }

    /**
     * Get or set route's path.
     *
     * @param string|null $path To set a path
     * @return string|$this|self
     */
    public function path(?string $path = null): self|string
    {
        if ($path !== null)
        {
            $this->path = $path;

            return $this;
        }

        return $this->path;
    }

    /**
     * Get or set route's controller class.
     *
     * @param string|null $controllerClass To set a controller class
     * @return string|$this|self
     */
    public function controller(?string $controllerClass = null): self|string
    {
        if ($controllerClass !== null)
        {
            $this->controllerClass = $controllerClass;

            return $this;
        }

        return $this->controllerClass;
    }

    /**
     * Get or set route's controller method.
     *
     * @param string|null $controllerMethod To set a controller method
     * @return string|$this|self
     */
    public function method(?string $controllerMethod = null): self|string
    {
        if ($controllerMethod !== null)
        {
            $this->controllerMethod = $controllerMethod;

            return $this;
        }

        return $this->controllerMethod;
    }

    /**
     * Remove route's controller method.
     *
     * @return $this
     */
    public function removeMethod(): self
    {
        $this->controllerMethod = Sherpa::DEFAULT_CONTROLLER_METHOD;

        return $this;
    }

    /**
     * Get or set route's name.
     *
     * @param string|null $name To set a name
     * @return string|$this|self
     */
    public function name(?string $name = null): self|string
    {
        if ($name !== null)
        {
            $this->name = $name;

            return $this;
        }

        return $this->name;
    }

    /**
     * Remove route's name.
     *
     * @return $this
     */
    public function removeName(): self
    {
        $this->name = null;

        return $this;
    }

    /**
     * Get or set route's middlewares.
     *
     * @param array|null $middlewares To set route's middlewares
     * @return array Updated route's middlewares array
     */
    public function middlewares(?array $middlewares = null): array
    {
        if ($middlewares !== null)
        {
            $this->middlewares = $middlewares;
        }

        return $this->middlewares;
    }
}