<?php

namespace Sherpa\Core\router;

use Sherpa\Core\router\http\HttpMethod;

class Router
{
    public private(set) static array $routes = [];

    public static function get(string $path, array|string $controller): Route
    {
        $controllerClass = is_array($controller) && isset($controller[0])
            ? $controller[0]
            : $controller;

        $controllerMethod = is_array($controller) && isset($controller[1])
            ? $controller[1]
            : null;

        $route = new Route(
            HttpMethod::GET,
            $path,
            $controllerClass,
            $controllerMethod,
            null);

        return self::$routes[] = $route;
    }
}