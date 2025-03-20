<?php

namespace Sherpa\Core\sessions;

class SessionsManager
{
    private const int KEY_BYTES = 32;

    /**
     * Generate an encryption key,
     * used for session encryption.
     * <p>
     *     This method is used internally,
     *     not necessary for the developer.
     * </p>
     *
     * @return string
     * @throws \Random\RandomException
     */
    public static function generateAppKey(): string
    {
        return bin2hex(random_bytes(self::KEY_BYTES));
    }

    public static function token(): string
    {
        dd(Session::getByUserId(1));
    }
}