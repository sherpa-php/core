<?php

namespace Sherpa\Core\exceptions\router;

use Sherpa\Core\exceptions\SherpaException;
use Sherpa\Core\router\http\HttpMethod;
use Throwable;

class UrlNotLinkedToAnyRouteException extends SherpaException
{
    public function __construct(string $url,
                                HttpMethod $httpMethod,
                                ?Throwable $previous = null)
    {
        $message = "Following URL is no longer linked to any route: "
                 . "$url\[$httpMethod->name]";

        parent::__construct($message, 1002, $previous);
    }
}