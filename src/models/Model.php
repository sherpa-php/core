<?php

namespace Sherpa\Core\models;

use Sherpa\Core\core\naming\Name;
use Sherpa\Trail\orm\ORMQuery;
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


    public function __construct()
    {
        $this->data = new stdClass();
    }


    /*
     * Model's Relationship Builder
     */

    /**
     * Create a "Many-to-One (reversed)" relationship.
     *
     * @param string $related Inherited model
     * @param string $fkColumn (optional) foreign key column's name
     * @return ORMQuery
     */
    protected function belongsTo(string $related, ?string $fkColumn = null): ORMQuery
    {
        if ($fkColumn === null)
        {
            $fkColumn = Name::singularize(Name::getDBNameFromModel($related))
                . "_id";
        }

        return $this->makeBelongsTo($this->data->$fkColumn, $related);
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