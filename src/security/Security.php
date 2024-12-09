<?php

namespace Sherpa\Core\security;

/**
 * Security utility class.
 * <p>
 *     Provides utility methods to
 *     secure processes and datas.
 * </p>
 */
class Security
{
    /**
     * Secures provided data for using in back-end.
     * <p>
     *     It prevents from injections and other kinds of attack.
     * </p>
     *
     * @param mixed $data Data value to secure
     * @return mixed Secured data value
     */
    public static function secureData(mixed $data): mixed
    {
        if (is_string($data))
        {
            $data = htmlspecialchars($data);
        }

        return $data;
    }
}