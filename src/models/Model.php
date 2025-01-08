<?php

namespace Sherpa\Core\models;

use Sherpa\Core\core\naming\Name;
use Sherpa\Trail\orm\ORMQuery;
use Sherpa\Trail\orm\Relationships;

class Model
{
    use Relationships;

    protected static array $public = [];
    protected static array $hidden = [];

    /** Database Table name. */
    private static string $table;

    public function __construct()
    {
    }


    public static function use(?string $table = null): ORMQuery
    {
        return new ORMQuery($table ?? Name::getDBNameFromModel(static::class));
    }

    protected function setTable(string $name): void
    {
        self::$table = $name;
    }

    public function table(): string
    {
        return self::$table;
    }
}