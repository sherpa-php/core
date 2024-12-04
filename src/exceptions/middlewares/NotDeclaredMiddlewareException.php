<?php

namespace Sherpa\Core\exceptions\middlewares;

use Sherpa\Core\exceptions\SherpaException;

class NotDeclaredMiddlewareException extends SherpaException
{
    public function __construct(string $middlewareKey,
                                ?Throwable $previous = null)
    {
        $message = "Following middleware name does no longer declared: $middlewareKey";

        parent::__construct($message, 1501, $previous);
    }
}