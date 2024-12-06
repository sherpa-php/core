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
        if (!in_array("rendering/dump.css", get_included_files()))
        {
            include "rendering/dump.css";
        }

        include "rendering/dump.html";
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