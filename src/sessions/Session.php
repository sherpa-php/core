<?php

namespace Sherpa\Core\sessions;

use Sherpa\Core\models\Model;

class Session extends Model
{
    protected static array $public = [
        "token", "user_id",
    ];


    public static function getByUserId(int $userId): ?Session
    {
        return Session::query()
                      ->where("user_id", $userId)
                      ->first();
    }
}