<?php

namespace Sherpa\Core\router\exceptions;

use Sherpa\Exceptions\exceptions\SherpaException;
use Throwable;

/**
 * Sherpa Exception
 * <p>
 *     To throw if given Request's header's locales
 *     do not respect the required format.
 * </p>
 */
class InvalidHeaderLocalesException extends SherpaException
{
    public function __construct(?Throwable $previous = null)
    {
        $message = "Request's locales do not respect the required format";

        parent::__construct($message, 1001, $previous);
    }
}