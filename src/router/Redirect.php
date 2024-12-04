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
     */
    public static function to(string $path): void
    {
        $urn = Sherpa::env("SITE_URL");

        header("Location: $urn$path");
        die;
    }

    /**
     * Redirects using route's name.
     *
     * @param string $name Route's name
     */
    public static function route(string $name): void
    {
        $request = new Request();
        $route = Router::getRouteByName($name, $request->httpMethod);

        if ($route === null)
        {
            abort(404);
        }

        $urn = Sherpa::env("SITE_URL");

        header("Location: $urn{$route->path()}");
        die;
    }
}