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
    public const string ROUTE_PARAMETER_REGEX = "/:(([a-zA-Z])([a-zA-Z0-9]*))/";

    private HttpMethod $httpMethod;
    private string $path;
    private $callback;
    private ?string $controllerClass;
    private ?string $controllerMethod;
    private ?string $name;
    private array $middlewares;
    private array $linkedRoutes;
    public private(set) array $parameters;
    public private(set) array $parametersFlags;

    public function __construct(
        HttpMethod $httpMethod,
        string $path,
        ?callable $callback = null,
        ?string $controllerClass = null,
        ?string $controllerMethod = null,
        ?string $name = null,
        array $middlewares = [],
        array $linkedRoutes = [],
        array $parameters = [])
    {
        $this->httpMethod = $httpMethod;
        $this->path = $path;
        $this->callback = $callback;
        $this->controllerClass = $controllerClass;
        $this->controllerMethod = $controllerMethod;
        $this->name = $name;
        $this->middlewares = $middlewares;
        $this->linkedRoutes = $linkedRoutes;
        $this->parameters = $parameters;
        $this->parametersFlags = [];

        foreach ($this->parameters as $parameter)
        {
            $this->parametersFlags[$parameter] = [];
        }
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
    public function name(?string $name = null): self|string|null
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

    /**
     * @return bool If the current instance route
     *              is the current resolved one.
     */
    public function isCurrent(): bool
    {
        $request = new Request();

        $currentRoute = Router::getRouteByPath(
            $request->url,
            $request->httpMethod);

        return $this == $currentRoute;
    }

    /**
     * @return bool If route uses a callback
     *              instead of controller + method
     */
    public function hasCallback(): bool
    {
        return $this->callback !== null
            && is_callable($this->callback);
    }

    /**
     * Run route's callback.
     */
    public function runCallback(mixed ...$params): void
    {
        ($this->callback)(...$params);
    }

    public function addRouteLink(Route $route): static
    {
        $this->linkedRoutes[] = $route;

        return $this;
    }

    public function paramFlags(string $paramKey, array $flags, bool $recursive = true): static
    {
        $this->parametersFlags[$paramKey] = $flags;

        if ($recursive)
        {
            foreach ($this->linkedRoutes as $route)
            {
                $route->paramFlags($paramKey, $flags);
            }
        }

        return $this;
    }
}