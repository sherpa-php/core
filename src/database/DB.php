<?php

namespace Sherpa\Core\database;

use PDO;
use PDOException;
use Sherpa\Core\core\Sherpa;
use Sherpa\Core\exceptions\database\CannotConnectToDatabaseException;

/**
 * Database management class.
 */
class DB
{
    private static PDO $pdo;

    private static function connect(): void
    {
        $db = Sherpa::db();
        $dsn = "{$db['dbms']}:host={$db['host']};port={$db['port']}"
             . ";charset={$db['charset']}";

        try
        {
            self::$pdo = new PDO(
                $dsn,
                $db["user"],
                $db["password"]);
        }
        catch (PDOException $exception)
        {
            throw new CannotConnectToDatabaseException($exception);
        }
    }
}