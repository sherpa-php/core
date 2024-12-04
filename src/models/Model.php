<?php

namespace Sherpa\Core\models;

use Sherpa\Core\core\naming\Name;
use Sherpa\Trail\orm\CRUD;

class Model
{
    use CRUD;

    /** Database Table name. */
    public protected(set) string $table;

    public function __construct()
    {
        $this->table = Name::getDBNameFromModel(static::class);
    }

    protected static array $public = [];
    protected static array $hidden = [];
}