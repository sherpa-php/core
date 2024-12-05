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

    /** $_ENV variables */
    private static array $env = [];

    /**
     * Saves all $_ENV variables statically.
     */
    public static function loadEnv(): void
    {
        self::$env = $_ENV;
    }

    /**
     * @param string|null $key
     * @return mixed If $key is not provided, all env variables;
     *               else env variable value using $key
     */
    public static function env(?string $key = null): mixed
    {
        if ($key === null)
        {
            return self::$env;
        }

        return self::$env[$key] ?? null;
    }

    /**
     * SECURITY WARNING: DO NOT SHARE TO CLIENT!
     *
     * @return array All database credentials
     */
    public static function db(): array
    {
        return [
            "dbms" => self::env("DB_DBMS"),
            "host" => self::env("DB_HOST"),
            "port" => self::env("DB_PORT"),
            "charset" => self::env("DB_CHARSET"),
            "dbname" => self::env("DB_NAME"),
            "user" => self::env("DB_USER"),
            "password" => self::env("DB_PASSWORD"),
        ];
    }
}