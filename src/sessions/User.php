<?php

namespace Sherpa\Core\sessions;

use Sherpa\Core\models\Model;

class User extends Model
{
    protected static array $public = [
        "id",
    ];
}