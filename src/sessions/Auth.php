<?php

namespace Sherpa\Core\sessions;

use Sherpa\Core\core\Sherpa;

class Auth
{
    public const string SESSION_KEY = "sherpaf_session_user_id";

    public static function check(): bool
    {
        $storedUserId = self::id();

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
        return Sherpa::session(self::SESSION_KEY);
    }

    public static function user(): ?User
    {
        return Auth::check()
            ? User::query()->find(Auth::id())
            : null;
    }
}