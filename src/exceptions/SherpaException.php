<?php

namespace Sherpa\Core\exceptions;

use Throwable;

class SherpaException extends \Exception
{
    public function __construct(string $message = "",
                                string $code = "SHERPA_EXC_GBL",
                                ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}