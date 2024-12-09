<?php

namespace Sherpa\Core\exceptions\validator;

use Sherpa\Core\exceptions\SherpaException;
use Throwable;

/**
 * Sherpa Exception
 * <p>
 *     To throw if given rule class
 *     does no longer exist.
 * </p>
 */
class RuleDoesNotExistException extends SherpaException
{
    public function __construct(string $rule,
                                ?Throwable $previous = null)
    {
        $message = "Following rule class does no longer exist: $rule";

        parent::__construct($message, 1301, $previous);
    }
}