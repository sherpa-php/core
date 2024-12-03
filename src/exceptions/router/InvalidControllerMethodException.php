<?php

namespace Sherpa\Core\exceptions\router;

use Sherpa\Core\exceptions\SherpaException;
use Throwable;

class InvalidControllerMethodException extends SherpaException
{
    public function __construct(string $controller,
                                string $method,
                                ?Throwable $previous = null)
    {
        $code = "SHERPA_EXC_RTE_ICM01";
        $message = "Following controller method does no longer exist:"
                 . " $controller::$method()";

        parent::__construct($message, $code, $previous);
    }
}