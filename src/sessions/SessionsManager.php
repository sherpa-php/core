<?php

namespace Sherpa\Core\sessions;

use Sherpa\Core\core\Sherpa;
use Sherpa\Core\encryption\Encryptor;

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
        $sessionKey = Sherpa::session("session_key");

        if (isset($sessionKey))
        {
            return $sessionKey;
        }
        else
        {
            return $_SESSION["session_key"]
                = Encryptor::generateEncryptKey();
        }
    }
}