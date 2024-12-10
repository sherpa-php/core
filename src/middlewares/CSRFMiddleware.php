<?php

namespace Sherpa\Core\middlewares;

use Sherpa\Core\router\http\HttpMethod;
use Sherpa\Core\router\Request;
use Sherpa\Core\security\CSRF;

/**
 * CSRF Middleware
 * <p>
 *     It verifies the request's CSRF token
 *     by comparing it with back-end's one.
 * </p>
 */
class CSRFMiddleware implements Middleware
{
    /** HTTP methods concerned by CSRF verification. */
    private const array CONCERNED_HTTP_METHODS = [
        HttpMethod::POST, HttpMethod::PUT,
        HttpMethod::DELETE,
    ];

    public function run(Request $request): MiddlewareResponse
    {
        if (in_array($request->httpMethod, self::CONCERNED_HTTP_METHODS)
            && !CSRF::validate($request))
        {
            abort(409);
        }

        return MiddlewareResponse::CONTINUE;
    }
}