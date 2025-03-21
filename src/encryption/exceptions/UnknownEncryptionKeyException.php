<?php

namespace Sherpa\Core\encryption\exceptions;

use Sherpa\Exceptions\exceptions\SherpaException;
use Throwable;

/**
 * Sherpa Exception
 * <p>
 *     To throw if .env file does not have an ENCRYPT_KEY
 *     variable.
 * </p>
 */
class UnknownEncryptionKeyException extends SherpaException
{
    public function __construct(?Throwable $previous = null)
    {
        $message = "An encryption key must be defined into .env file.";

        parent::__construct($message, 1411, $previous);
    }
}