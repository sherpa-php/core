<?php

namespace Sherpa\Core\security;

use Sherpa\Core\core\Sherpa;

final class Hash
{
    /**
     * Hash the provided string
     * using provided algorithm and options.
     * <p>
     *     Useful for passwords.
     * </p>
     *
     * @param string $value
     * @param int|string|null $algo
     * @param array $options
     * @return string Hashed string
     */
    public static function hash(
        string $value,
        int|string|null $algo = PASSWORD_BCRYPT,
        array $options = []): string
    {
        if (Sherpa::env("BCRYPT_COST_FACTOR"))
        {
            $options["cost"] = Sherpa::env("BCRYPT_COST");
        }

        return password_hash($value, $algo, $options);
    }

    /**
     * Verify the provided hashed string
     * by comparing it with the provided clear one.
     *
     * @param string $value Clear value
     * @param string $hashed Hash value
     * @return bool If both values are verified
     */
    public static function verify(
        string $value,
        string $hashed): bool
    {
        return password_verify($value, $hashed);
    }
}