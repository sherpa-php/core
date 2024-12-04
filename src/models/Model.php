<?php

namespace Sherpa\Core\models;

use Sherpa\Core\core\naming\Name;

class Model
{
    /** Database Table name. */
    public string $table;

    public function __construct()
    {
        $this->table = Name::getDBNameFromModel(static::class);
    }

    private static array $public = [];
    private static array $hidden = [];
}