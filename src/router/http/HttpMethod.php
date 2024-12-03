<?php

namespace Sherpa\Core\router\http;

enum HttpMethod
{
    case GET;
    case POST;
    case HEAD;
    case PUT;
    case DELETE;

    public static function from(string $method): self
    {
        return match (strtoupper($method))
        {
            "GET" => self::GET,
            "POST" => self::POST,
            "HEAD" => self::HEAD,
            "PUT" => self::PUT,
            "DELETE" => self::DELETE,
            default => throw new \InvalidArgumentException(
                "Invalid HTTP method: $method"),
        };
    }
}
