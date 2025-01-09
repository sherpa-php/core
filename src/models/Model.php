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

    protected function belongsTo(string $related, ?string $fkColumn = null)
    {
        $this->makeBelongsTo($this->{$fkColumn ?? "id"}, $related);
    }


    public static function use(): ORMQuery
    {
        return new ORMQuery(
            static::$table
            ?? Name::getDBNameFromModel(static::class),
            static::$public,
            static::$hidden);
    }

    protected function setTable(string $name): self
    {
        self::$table = $name;

        return $this;
    }

    public function table(): string
    {
        return self::$table;
    }
}