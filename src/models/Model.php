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


    public private(set) array $data;


    public function __construct(array $data = [])
    {
        $this->data = $data;
    }


    /*
     * Model's Relationship Builder
     */

    /**
     * Create a "Many-to-One (reversed)" relationship.
     *
     * @param string $related Inherited model
     * @param string|null $fkColumn (optional) foreign key column's name
     */
    protected function belongsTo(string $related, ?string $fkColumn = null): ORMQuery
    {
        return $this->makeBelongsTo($this->{$fkColumn ?? "id"}, $related);
    }


    /*
     * Model's Utility Methods
     */

    /**
     * Instantiate a new ORMQuery object.
     *
     * @return ORMQuery
     */
    public static function use(): ORMQuery
    {
        return new ORMQuery(
            static::class,
            static::$public,
            static::$hidden);
    }

    /**
     * Set custom table's name.
     *
     * @param string $name
     * @return $this
     */
    protected static function setTable(string $name): self
    {
        self::$table = $name;
    }

    /**
     * @return string Model's table's name
     */
    public static function table(): string
    {
        return self::$table
            ?? Name::getDBNameFromModel(static::class);
    }
}