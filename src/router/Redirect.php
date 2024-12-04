<?php

namespace Sherpa\Core\router;

/**
 * Redirect utility class.
 * <p>
 *     Offers many methods to use router
 *     for redirecting.
 * </p>
 */
class Redirect
{
    /**
     * Redirects using path.
     *
     * @param string $path
     * @return bool If redirection is successful
     */
    public static function to(string $path): bool
    {
        header("Location: $path");

        return true;
    }

    /**
     * Redirects using route's name.
     *
     * @param string $name Route's name
     * @return bool If redirection is successful
     */
    public static function route(string $name): bool
    {
        $request = new Request();
        $route = Router::getRouteByName($name, $request->httpMethod);

        if ($route === null)
        {
            return false;
        }

        header("Location: {$route->path()}");

        return true;
    }
}