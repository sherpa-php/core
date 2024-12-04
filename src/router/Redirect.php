<?php

namespace Sherpa\Core\router;

use Sherpa\Core\core\Sherpa;

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
        $urn = Sherpa::env("SITE_URL");

        header("Location: $urn$path");

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

        $urn = Sherpa::env("SITE_URL");

        header("Location: $urn{$route->path()}");

        return true;
    }
}