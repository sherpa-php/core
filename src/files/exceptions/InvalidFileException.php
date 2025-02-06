<?php

namespace Sherpa\Core\files\exceptions;

use Sherpa\Exceptions\exceptions\SherpaException;
use Throwable;

class InvalidFileException extends SherpaException
{
    public function __construct(?Throwable $previous = null)
    {
        $message = "Given file is not valid.";

        parent::__construct($message, 1501, $previous);
    }
}