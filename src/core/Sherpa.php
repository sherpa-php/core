<?php

namespace Sherpa\Core\core;

/**
 * Sherpa Framework main class.
 */
class Sherpa
{
    /*
     * Framework Information
     */

    /** Current Sherpa Framework version */
    public const string VERSION = "0.1-dev";


    /*
     * Framework Conventions
     */

    /** Sherpa GET parameters prefix */
    public const string SHERPA_DATA_PREFIX = "sherpaf__";

    /** Sherpa controllers default method name */
    public const string DEFAULT_CONTROLLER_METHOD = "__default";

    private static array $env = [];

    public static function loadEnv(): void
    {
        self::$env = $_ENV;
    }

    public static function env(?string $key = null): mixed
    {
        if ($key === null)
        {
            return self::$env;
        }

        return self::$env[$key] ?? null;
    }
}