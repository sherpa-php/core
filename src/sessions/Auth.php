<?php

namespace Sherpa\Core\sessions;

use Sherpa\Core\core\Sherpa;

class Auth
{
    public const string SESSION_KEY = "sherpaf_session_user_id";

    public static function check(): bool
    {
        $storedUserId = Sherpa::session(self::SESSION_KEY);

        if ($storedUserId === null)
        {
            return false;
        }

        return Session::query()
                      ->where("user_id", $storedUserId)
                      ->count();
    }

    public static function id(): ?int
    {
        if (Auth::check())
        {
            return Session::query()
                          ->where("user_id", $_SESSION[self::SESSION_KEY])
                          ->first()
                          ?->id;
        }
        else
        {
            return null;
        }
    }

    public static function user(): ?User
    {
        return Auth::check()
            ? User::query()->find(Auth::id())
            : null;
    }
}