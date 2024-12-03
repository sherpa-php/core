<?php

namespace Sherpa\Core\router\http;

/**
 * HTTP methods enum class.
 */
enum HttpMethod
{
    case GET;
    case POST;
    case HEAD;
    case PUT;
    case DELETE;

    /**
     * Give Enum value from a given HTTP method string.
     *
     * @param string $method HTTP method as string
     * @return self Enum value for given method
     */
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
