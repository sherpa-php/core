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
            echo "<style>";
            include "rendering/dump.css";
            echo "</style>";
        }

        $gi = file_get_contents("rendering/dump.html");

        foreach ($args as $arg)
        {
            ob_start();
            var_dump($arg);
            $dump = ob_get_clean();

            echo str_replace("Sherpa(.Dumping)", $dump, $gi);
        }
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