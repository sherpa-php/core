<?php

namespace Sherpa\Core\router;

use Sherpa\Core\core\Sherpa;
use Sherpa\Core\middlewares\exceptions\NotDeclaredMiddlewareException;
use Sherpa\Core\router\exceptions\InvalidControllerMethodException;
use Sherpa\Core\middlewares\CSRFMiddleware;
use Sherpa\Core\middlewares\MiddlewareResponse;
use Sherpa\Core\router\http\HttpMethod;

/**
 * Router utility class.
 */
class Router
{
    private static array $routes = [];
    private static array $middlewares = [];

    private static function makeRoute(HttpMethod $httpMethod,
                                      string $path,
                                      array|string|callable $target): Route
    {
        if (is_callable($target))
        {
            $route = new Route(
                $httpMethod,
                self::preparePath($path),
                $target);
        }
        else
        {
            $controllerClass = is_array($target) && isset($target[0])
                ? $target[0]
                : $target;

            $controllerMethod = is_array($target) && isset($target[1])
                ? $target[1]
                : Sherpa::DEFAULT_CONTROLLER_METHOD;

            $route = new Route(
                $httpMethod,
                self::preparePath($path),
                null,
                $controllerClass,
                $controllerMethod);
        }

        return $route;
    }

    /**
     * Creates a GET route.
     * <p>
     *     Implicitly creates an HEAD route.
     * </p>
     *
     * @param string $path Route's path
     * @param array|string $target If it is a string: controller's class name
     *                                 if it is an array: controller's class name, controller's method
     * @return Route
     */
    public static function get(string $path, array|string|callable $target): Route
    {
        $route = self::makeRoute(HttpMethod::GET, $path, $target);
        self::head($path, $target);

        return self::$routes[] = $route;
    }

    /**
     * Creates a POST route.
     *
     * @param string $path Route's path
     * @param array|string $controller If it is a string: controller's class name
     *                                 if it is an array: controller's class name, controller's method
     * @return Route
     */
    public static function post(string $path, array|string|callable $target): Route
    {
        return self::$routes[] = self::makeRoute(
            HttpMethod::POST, $path, $target);
    }

    /**
     * Creates a HEAD route.
     *
     * @param string $path Route's path
     * @param array|string $controller If it is a string: controller's class name
     *                                 if it is an array: controller's class name, controller's method
     * @return Route
     */
    public static function head(string $path, array|string|callable $target): Route
    {
        return self::$routes[] = self::makeRoute(
            HttpMethod::HEAD, $path, $target);
    }

    /**
     * Creates a PUT route.
     *
     * @param string $path Route's path
     * @param array|string $controller If it is a string: controller's class name
     *                                 if it is an array: controller's class name, controller's method
     * @return Route
     */
    public static function put(string $path, array|string|callable $target): Route
    {
        return self::$routes[] = self::makeRoute(
            HttpMethod::PUT, $path, $target);
    }

    /**
     * Creates a DELETE route.
     *
     * @param string $path Route's path
     * @param array|string $controller If it is a string: controller's class name
     *                                 if it is an array: controller's class name, controller's method
     * @return Route
     */
    public static function delete(string $path, array|string|callable $target): Route
    {
        return self::$routes[] = self::makeRoute(
            HttpMethod::DELETE, $path, $target);
    }

    /**
     * Retrieves route by its path and HTTP method.
     *
     * @param string $path
     * @param HttpMethod $httpMethod
     * @return Route|null Route object if exists
     */
    public static function getRouteByPath(string $path,
                                          HttpMethod $httpMethod): ?Route
    {
        foreach (self::$routes as $route)
        {
            if ($route->path() === self::preparePath($path)
                && $route->httpMethod() === $httpMethod)
            {
                return $route;
            }
        }

        return null;
    }

    /**
     * Retrieves route by its name and HTTP method.
     *
     * @param string $name
     * @param HttpMethod $httpMethod
     * @return Route|null Route object if exists
     */
    public static function getRouteByName(string $name,
                                          ?HttpMethod $httpMethod = null): ?Route
    {
        foreach (self::$routes as $route)
        {
            if ($route->name() === $name
                && $httpMethod === null
                ^ $route->httpMethod() === $httpMethod)
            {
                return $route;
            }
        }

        return null;
    }

    /**
     * Resolves route using Request object.
     * <ul>
     *     <li>Retrieves route by request's path</li>
     *     <li>Instantiates route's controller's class</li>
     *     <li>Run route's controller's method</li>
     * </ul>
     * <p>
     *     If route does no longer exist,
     *     it'll abort with 404 error.
     * </p>
     *
     * @throws InvalidControllerMethodException If given controller's method
     *                                          does no longer exist
     * @throws NotDeclaredMiddlewareException If required middleware does no
     *                                        longer exist
     */
    public static function resolve(Request $request): void
    {
        $url = $request->url;
        $httpMethod = $request->httpMethod;
        $route = self::getRouteByPath($url, $httpMethod);

        if ($route === null)
        {
            abort(404);
        }

        if ($route->hasCallback())
        {
            $middlewares = $route->middlewares();

            if (Sherpa::env("CSRF_TOKEN") === "true")
            {
                new CSRFMiddleware()->run($request);
            }

            foreach ($middlewares as $middleware)
            {
                $middlewareClassName = self::middlewares()[$middleware];

                if (!isset($middlewareClassName))
                {
                    throw new NotDeclaredMiddlewareException($middleware);
                }

                $middlewareResponse = new $middlewareClassName()
                    ->run($request);

                if ($middlewareResponse === MiddlewareResponse::ABORT)
                {
                    abort(404);
                }
            }

            $route->runCallback();
        }
        else
        {
            $controller = $route->controller();
            $method = $route->method();

            if (!method_exists($controller, $method))
            {
                throw new InvalidControllerMethodException($controller, $method);
            }

            $middlewares = $route->middlewares();

            if (Sherpa::env("CSRF_TOKEN") === "true")
            {
                new CSRFMiddleware()->run($request);
            }

            foreach ($middlewares as $middleware)
            {
                $middlewareClassName = self::middlewares()[$middleware];

                if (!isset($middlewareClassName))
                {
                    throw new NotDeclaredMiddlewareException($middleware);
                }

                $middlewareResponse = new $middlewareClassName()
                    ->run($request);

                if ($middlewareResponse === MiddlewareResponse::ABORT)
                {
                    abort(404);
                }
            }

            $instance = new $controller();
            call_user_func([$instance, $method], $request);
        }
    }

    /**
     * Trims given path, by removing slashes, spaces and tabs
     * at its beginning and ending.
     *
     * @param string $path
     * @return string Trimmed path
     */
    public static function preparePath(string $path): string
    {
        return trim($path, '/ ');
    }

    /**
     * @return array Routes array
     */
    public static function routes(): array
    {
        return self::$routes;
    }

    /**
     * Get or set router's middlewares
     *
     * @return array Router's middlewares array
     */
    public static function middlewares(?array $middlewares = null): array
    {
        if ($middlewares !== null)
        {
            self::$middlewares = $middlewares;
        }

        return self::$middlewares;
    }
}