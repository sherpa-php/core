<?php

namespace Sherpa\Core\exceptions\csrf;

use Sherpa\Core\exceptions\SherpaException;
use Throwable;

class IncorrectCSRFTokenException extends SherpaException
{
    public function __construct(?Throwable $previous = null)
    {
        $message = "Request CSRF token is incorrect.";

        parent::__construct($message, 1401, $previous);
    }
}