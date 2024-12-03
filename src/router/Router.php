<?php

namespace Sherpa\Core\router;

use Sherpa\Core\core\Sherpa;
use Sherpa\Core\exceptions\router\InvalidControllerMethodException;
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
            $path,
            $controllerClass,
            $controllerMethod,
            null);

        return self::$routes[] = $route;
    }

    public static function getRouteByPath(string $path): ?Route
    {
        foreach (self::$routes as $route)
        {
            if ($route->path() === $path)
            {
                return $route;
            }
        }

        return null;
    }

    public static function getRouteByName(string $name): ?Route
    {
        foreach (self::$routes as $route)
        {
            if ($route->name() === $name)
            {
                return $route;
            }
        }

        return null;
    }

    /**
     * @throws InvalidControllerMethodException
     */
    public static function resolve(Route $route): void
    {
        $controller = $route->controller();
        $method = $route->method();

        $request = new Request();

        if (!method_exists($controller, $method))
        {
            throw new InvalidControllerMethodException($controller, $method);
        }

        call_user_func([$controller, $method], $request);
    }

    public static function routes(): array
    {
        return self::$routes;
    }
}