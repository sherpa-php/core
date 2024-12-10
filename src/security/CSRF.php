<?php

namespace Sherpa\Core\security;

use Random\RandomException;
use Sherpa\Core\router\Request;

/**
 * CSRF utility class
 * <p>
 *     Allows to manage CSRF token.
 * </p>
 */
class CSRF
{
    /** CSRF token duration in milliseconds. */
    private const int DURATION = 3600;

    /**
     * Generates a new CSRF token.
     *
     * @return string CSRF token
     * @throws RandomException
     */
    private static function generate(): string
    {
        return bin2hex(random_bytes(32));
    }

    /**
     * Generates a new CSRF object
     * using a new token and ending time.
     */
    public static function regenerate(): void
    {
        $_SESSION["CSRF_TOKEN"] = self::generate();
        $_SESSION["CSRF_END_AT"] = time() + self::DURATION;
    }

    /**
     * Verifies CSRF token from request by comparing it
     * with back-end stored one.
     *
     * @param Request $request
     * @return bool Verification result
     */
    public static function validate(Request $request): bool
    {
        return isset($request->sherpaData["sherpaf__csrf"])
            && $_SESSION["SHERPA_END_AT"] !== null
            && $_SESSION["SHERPA_TOKEN"] === $request->sherpaData["sherpaf__csrf"]
            && $_SESSION["SHERPA_END_AT"] > time();
    }
}