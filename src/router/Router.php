<?php

namespace Sherpa\Core\router;

use Sherpa\Core\core\Sherpa;
use Sherpa\Core\exceptions\router\InvalidControllerMethodException;
use Sherpa\Core\router\http\HttpMethod;

/**
 * Router utility class.
 */
class Router
{
    /** Routes array */
    private static array $routes = [];

    /**
     * Creates a GET route.
     * <p>
     *     Implicitly creates an HEAD route.
     * </p>
     *
     * @param string $path Route's path
     * @param array|string $controller If it is a string: controller's class name
     *                                 if it is an array: controller's class name, controller's method
     * @return Route
     */
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

        self::head($path, $controller);

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
    public static function post(string $path, array|string $controller): Route
    {
        $controllerClass = is_array($controller) && isset($controller[0])
            ? $controller[0]
            : $controller;

        $controllerMethod = is_array($controller) && isset($controller[1])
            ? $controller[1]
            : Sherpa::DEFAULT_CONTROLLER_METHOD;

        $route = new Route(
            HttpMethod::POST,
            self::preparePath($path),
            $controllerClass,
            $controllerMethod,
            null);

        return self::$routes[] = $route;
    }

    /**
     * Creates a HEAD route.
     *
     * @param string $path Route's path
     * @param array|string $controller If it is a string: controller's class name
     *                                 if it is an array: controller's class name, controller's method
     * @return Route
     */
    public static function head(string $path, array|string $controller): Route
    {
        $controllerClass = is_array($controller) && isset($controller[0])
            ? $controller[0]
            : $controller;

        $controllerMethod = is_array($controller) && isset($controller[1])
            ? $controller[1]
            : Sherpa::DEFAULT_CONTROLLER_METHOD;

        $route = new Route(
            HttpMethod::HEAD,
            self::preparePath($path),
            $controllerClass,
            $controllerMethod,
            null);

        return self::$routes[] = $route;
    }

    /**
     * Creates a PUT route.
     *
     * @param string $path Route's path
     * @param array|string $controller If it is a string: controller's class name
     *                                 if it is an array: controller's class name, controller's method
     * @return Route
     */
    public static function put(string $path, array|string $controller): Route
    {
        $controllerClass = is_array($controller) && isset($controller[0])
            ? $controller[0]
            : $controller;

        $controllerMethod = is_array($controller) && isset($controller[1])
            ? $controller[1]
            : Sherpa::DEFAULT_CONTROLLER_METHOD;

        $route = new Route(
            HttpMethod::PUT,
            self::preparePath($path),
            $controllerClass,
            $controllerMethod,
            null);

        return self::$routes[] = $route;
    }

    /**
     * Creates a DELETE route.
     *
     * @param string $path Route's path
     * @param array|string $controller If it is a string: controller's class name
     *                                 if it is an array: controller's class name, controller's method
     * @return Route
     */
    public static function delete(string $path, array|string $controller): Route
    {
        $controllerClass = is_array($controller) && isset($controller[0])
            ? $controller[0]
            : $controller;

        $controllerMethod = is_array($controller) && isset($controller[1])
            ? $controller[1]
            : Sherpa::DEFAULT_CONTROLLER_METHOD;

        $route = new Route(
            HttpMethod::DELETE,
            self::preparePath($path),
            $controllerClass,
            $controllerMethod,
            null);

        return self::$routes[] = $route;
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
            if ($route->path() === $path
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

        $controller = $route->controller();
        $method = $route->method();

        if (!method_exists($controller, $method))
        {
            throw new InvalidControllerMethodException($controller, $method);
        }

        $instance = new $controller();
        call_user_func([$instance, $method], $request);
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
        return trim($path, '/ \t');
    }

    /**
     * @return array Routes array
     */
    public static function routes(): array
    {
        return self::$routes;
    }
}