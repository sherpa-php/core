<?php

namespace Sherpa\Core\exceptions;

use Throwable;

/**
 * Sherpa Exception class.
 * <p>
 *     Provides utilities methods.
 * </p>
 */
class SherpaException extends \Exception
{
    /*
     * Sherpa Exceptions Conventions
     * =================================
     *
     *      Global Error:       0
     *      Router Exceptions:  1XXX
     *
     */

    public function __construct(string $message = "",
                                int $code = 0,
                                ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}