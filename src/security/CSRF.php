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

    public private(set) string $token;

    private int $endAt;

    public function __construct()
    {
        $this->token = self::generate();
        $this->endAt = time() + self::DURATION;
    }

    /**
     * @return bool If CSRF token is expired
     */
    public function isExpired(): bool
    {
        return $this->endAt < time();
    }

    /**
     * @return string|null Current CSRF token if exists
     */
    public static function get(): ?string
    {
        return $_SESSION["CSRF_TOKEN"] ?? null;
    }

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
     *
     * @return CSRF
     */
    public static function regenerate(): self
    {
        return $_SESSION["CSRF_TOKEN"] = new self();
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
        $csrf = self::get();

        return isset($request->sherpaData["sherpaf__csrf"])
            && $csrf !== null
            && $csrf->token === $request->sherpaData["sherpaf__csrf"]
            && !$csrf->isExpired();
    }
}