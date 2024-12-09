<?php

namespace Sherpa\Core\security;

use Random\RandomException;

/**
 * CSRF utility class
 * <p>
 *     Allows to manage CSRF token.
 * </p>
 */
class CSRF
{
    /**
     * @return string|null Current CSRF token if exists
     */
    public static function get(): ?string
    {
        return $_SESSION["CSRF_TOKEN"] ?? null;
    }

    /**
     * Replace current CSRF token by a new one.
     *
     * @return string New CSRF token
     * @throws RandomException
     */
    public static function regenerate(): string
    {
        $csrf = bin2hex(random_bytes(32));

        return $_SESSION["CSRF_TOKEN"] = $csrf;
    }
}