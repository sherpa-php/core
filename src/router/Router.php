<?php

namespace Sherpa\Core\router;

use Sherpa\Core\core\Sherpa;
use Sherpa\Core\exceptions\router\InvalidControllerMethodException;
use Sherpa\Core\exceptions\router\UrlNotLinkedToAnyRouteException;
use Sherpa\Core\router\http\HttpMethod;

class Router
{
    private static array $routes = [];

    public static function get(string $path, array|string $controller): Route
    {
        $controllerClass = is_array($controller) && isset($controller[0])
            ? $controller[0]
            : $controller;

        $controllerMethod = is_array($controller) && isset($controller[1])
            ? $controller[1]
            : Sherpa::DEFAULT_CONTROLLER_METHOD;

        $route = new Route(
            HttpMethod::GET,
            self::preparePath($path),
            $controllerClass,
            $controllerMethod,
            null);

        return self::$routes[] = $route;
    }

    public static function getRouteByPath(string $path,
                                          HttpMethod $httpMethod): ?Route
    {
        foreach (self::$routes as $route)
        {
            if ($route->path() === $path
                && $route->httpMethod() === $httpMethod)
            {
                return $route;
            }
        }

        return null;
    }

    public static function getRouteByName(string $name,
                                          HttpMethod $httpMethod): ?Route
    {
        foreach (self::$routes as $route)
        {
            if ($route->name() === $name
                && $route->httpMethod() === $httpMethod)
            {
                return $route;
            }
        }

        return null;
    }

    /**
     * @throws InvalidControllerMethodException
     * @throws UrlNotLinkedToAnyRouteException
     */
    public static function resolve(Request $request): void
    {
        $url = $request->url;
        $httpMethod = $request->httpMethod;
        $route = self::getRouteByPath($url, $httpMethod);

        if ($route === null)
        {
            throw new UrlNotLinkedToAnyRouteException($url);
        }

        $controller = $route->controller();
        $method = $route->method();

        if (!method_exists($controller, $method))
        {
            throw new InvalidControllerMethodException($controller, $method);
        }

        $instance = new $controller();
        call_user_func([$instance, $method], $request);
    }

    private static function preparePath(string $path): string
    {
        return ltrim($path, '/');
    }

    public static function routes(): array
    {
        return self::$routes;
    }
}