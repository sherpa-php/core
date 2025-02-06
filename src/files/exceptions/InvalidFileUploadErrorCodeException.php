<?php

namespace Sherpa\Core\files\exceptions;

use Sherpa\Exceptions\exceptions\SherpaException;
use Throwable;

class InvalidFileUploadErrorCodeException extends SherpaException
{
    public function __construct(string $code,
                                ?Throwable $previous = null)
    {
        $message = "$code is not a valid file upload error code.";

        parent::__construct($message, 1502, $previous);
    }
}