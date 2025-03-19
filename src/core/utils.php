<?php

use Sherpa\Core\core\Sherpa;
use Sherpa\Core\debugging\Debug;
use Sherpa\Core\files\Application;
use Sherpa\Core\files\Audio;
use Sherpa\Core\files\Document;
use Sherpa\Core\files\File;
use Sherpa\Core\files\Image;
use Sherpa\Core\files\Text;
use Sherpa\Core\router\Request;
use Sherpa\Core\router\Router;


/*
 * Sherpa Framework Internal Util methods
 */


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

/**
 * @param mixed $file
 * @return bool Is a Document class instance
 * @see Document
 */
function isDocument(mixed $file): bool
{
    return $file instanceof Document;
}

/**
 * @param mixed $file
 * @return bool Is an Application class instance
 * @see Application
 */
function isApplication(mixed $file): bool
{
    return $file instanceof Application;
}

/**
 * @param mixed $file
 * @return bool Is an Audio class instance
 * @see Audio
 */
function isAudio(mixed $file): bool
{
    return $file instanceof Audio;
}

/**
 * @param mixed $file
 * @return bool Is an Image class instance
 * @see Image
 */
function isImage(mixed $file): bool
{
    return $file instanceof Image;
}

/**
 * @param mixed $file
 * @return bool Is a Text class instance
 * @see Text
 */
function isText(mixed $file): bool
{
    return $file instanceof Text;
}

/**
 * @param mixed $source
 * @return bool Is a File (or inherited) class instance
 * @see File
 */
function isFile(mixed $source): bool
{
    return $source instanceof File;
}

/**
 * Retrieves all HTTP methods allowed for given route's path.
 *
 * @param string $path
 * @return array|null An array with all allowed HTTP methods
 *                    for the provided path;
 *                    if the given path does no longer exist,
 *                    NULL will be returned
 * @see Router::allowedMethods()
 */
function allowedMethods(string $path): ?array
{
    return Router::allowedMethods($path);
}