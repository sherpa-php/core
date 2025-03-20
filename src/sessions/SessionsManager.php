<?php

namespace Sherpa\Core\sessions;

use Sherpa\Core\core\Sherpa;

class SessionsManager
{
    /**
     * Return stored session's key if exists;
     * else it creates a new one and returns it.
     *
     * @return string Created or retrieved session's key
     * @throws \Random\RandomException
     */
    public static function token(): string
    {
        if (isset($_SESSION["session_key"]))
        {
            return $_SESSION["session_key"];
        }
        else
        {
            return $_SESSION["session_key"]
                = self::generateEncryptKey();
        }
    }
}