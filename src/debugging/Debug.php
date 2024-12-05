<?php

namespace Sherpa\Core\debugging;

class Debug
{
    /**
     * Dumps provided arguments using Sherpa Interface.
     *
     * @param mixed ...$args
     */
    public static function dump(mixed ...$args): void
    {
        echo "<pre>";
        var_dump(...$args);
        echo "</pre>";
    }

    /**
     * Dumps and dies.
     *
     * @param mixed ...$args
     */
    public static function dd(mixed ...$args): void
    {
        self::dump(...$args);
        die;
    }
}