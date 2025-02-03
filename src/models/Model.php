<?php

namespace Sherpa\Core\models;

use Sherpa\Core\core\naming\Name;
use Sherpa\Trail\orm\ORMQuery;
use Sherpa\Trail\orm\ORMRelationshipQuery;
use Sherpa\Trail\orm\Relationships;
use stdClass;

class Model
{
    use Relationships;

    protected static array $public = [];
    protected static array $hidden = [];

    /** Database Table name. */
    private static string $table;


    public object $data;
    private object $privateData;


    public function __construct(array $public, array $private)
    {
        $this->data = (object) $public;
        $this->privateData = (object) $private;
    }


    /*
     * Model's Relationship Builder
     */

    /**
     * Create a "Many-to-One (reversed)" relationship.
     *
     * @param string $related Inherited model
     * @param string|null $fkColumn (optional) foreign key column's name
     * @return ORMRelationshipQuery
     */
    protected function belongsTo(string $related, ?string $fkColumn = null): ORMRelationshipQuery
    {
        if ($fkColumn === null)
        {
            $fkColumn = Name::getFkColumnFromModel($related);
        }

        return $this->makeBelongsTo($this->data->$fkColumn, $related);
    }

    protected function hasMany(string $related, ?string $fkColumn = null): ORMRelationshipQuery
    {
        if ($fkColumn === null)
        {
            $fkColumn = Name::getFkColumnFromModel($related);
        }

        return $this->makeHasMany($this->data->id, $fkColumn, $related);
    }

    protected function hasOne(string $related, ?string $fkColumn = null): ORMRelationshipQuery
    {
        if ($fkColumn === null)
        {
            $fkColumn = Name::getFkColumnFromModel($related);
        }

        return $this->makeHasOne($this->data->id, $fkColumn, $related);
    }

    protected function manyToMany(
        string $related,
        string $pivotTable,
        ?string $leftFkColumn = null,
        ?string $rightFkColumn = null): ORMRelationshipQuery
    {
        if ($leftFkColumn === null)
        {
            $leftFkColumn = Name::getFkColumnFromModel(static::class);
        }

        if ($rightFkColumn === null)
        {
            $rightFkColumn = Name::getFkColumnFromModel($related);
        }

        return $this->makeManyToMany(
            $this->data->id, $leftFkColumn,
            $rightFkColumn,
            $pivotTable,
            $related);
    }


    /*
     * Model's Utility Methods
     */

    /**
     * Instantiate a new ORMQuery object.
     *
     * @return ORMQuery
     */
    public static function query(): ORMQuery
    {
        return new ORMQuery(
            static::class,
            static::$public,
            static::$hidden);
    }

    /**
     * Set custom table's name.
     * <p>
     *     This method is discouraged because not following
     *     our conventions.
     * </p>
     * <p>
     *     You should define the model's table's name globally.
     * </p>
     *
     * @param string $name
     */
    protected static function setTable(string $name): void
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