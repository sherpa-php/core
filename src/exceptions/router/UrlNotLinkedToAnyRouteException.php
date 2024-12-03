<?php

namespace Sherpa\Core\exceptions\router;

use Sherpa\Core\exceptions\SherpaException;
use Throwable;

class UrlNotLinkedToAnyRouteException extends SherpaException
{
    public function __construct(string $url,
                                ?Throwable $previous = null)
    {
        $code = "SHERPA_EXC_UNLTAR_IR01";
        $message = "Following URL is no longer linked to any route: "
                 . "$url";

        parent::__construct($message, 1002, $previous);
    }
}