<?php

namespace Sherpa\Core\sessions;

class Auth
{
    public const string SESSION_KEY = "sherpaf_session_user_id";

    public static function check(): bool
    {
        $storedUserId = array_key_exists(self::SESSION_KEY, $_SESSION)
            ? $_SESSION[self::SESSION_KEY]
            : null;

        if ($storedUserId === null)
        {
            return false;
        }

        return Session::query()
                      ->where("user_id", $storedUserId)
                      ->count();
    }


                // TODO: use symfony cache or eq.

    public static function id(): ?int
    {
        if (Auth::check())
        {
            return Session::query()
                          ->where("user_id", $_SESSION[self::SESSION_KEY])
                          ->first()
                          ->id;
        }
        else
        {
            return null;
        }
    }
}