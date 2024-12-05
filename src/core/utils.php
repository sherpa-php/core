<?php

/*
 * Sherpa Framework Internal Util methods
 */

use Sherpa\Core\core\Sherpa;
use Sherpa\Core\debugging\Debug;
use Sherpa\Core\router\Request;


/**
 * Retrieve useful Sherpa information.
 *
 * @param bool $displayAsHtml Display an HTML interface
 * @return array|string[] Sherpa information array
 */
function sherpa_info(bool $displayAsHtml = true): array
{
    $path = $_GET["sherpaf__path"] ?? "[Unknown/Root]";

    $version = Sherpa::VERSION;

    if ($displayAsHtml)
    {
        echo "
        <h1>Sherpa Frameworks Information:</h1>
        
        <ul>
          <li>
            <strong>Path:</strong>
            $path
          </li>
        </ul>
        
        <hr />
        
        <ul>
          <li>
            <strong>Version:</strong>
            $version
          </li>
        </ul>
        ";
    }

    return [
        "path" => $path,
    ];
}


/**
 * Exit process with HTTP code.
 *
 * @param int $code HTTP response code
 */
function abort(int $code): void
{
    if (ob_get_length())
    {
        ob_clean();
    }

    http_response_code($code);
    exit;
}

/**
 * Create a new Request instance.
 * <p>
 *     It might be different than controller method $request
 * </p>
 *
 * @return Request New Request instance
 */
function request(): Request
{
    return new Request();
}

/**
 * Dumps provided arguments using Sherpa Interface.
 *
 * @param mixed ...$args
 */
function dump(mixed ...$args): void
{
    Debug::dump(...$args);
}

/**
 * Dumps and dies.
 *
 * @param mixed ...$args
 */
function dd(mixed ...$args): void
{
    Debug::dd(...$args);
}