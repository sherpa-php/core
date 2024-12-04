<?php

namespace Sherpa\Core\exceptions\middlewares;

use Sherpa\Core\exceptions\SherpaException;
use Throwable;

/**
 * Sherpa Exception
 * <p>
 *     To throw if given middleware key does
 *     no longer exist.
 * </p>
 */
class NotDeclaredMiddlewareException extends SherpaException
{
    public function __construct(string $middlewareKey,
                                ?Throwable $previous = null)
    {
        $message = "Following middleware name does no longer declared: $middlewareKey";

        parent::__construct($message, 1501, $previous);
    }
}