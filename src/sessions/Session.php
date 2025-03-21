<?php

namespace Sherpa\Core\sessions;

use Sherpa\Core\encryption\Encryptor;
use Sherpa\Core\models\Model;

class Session extends Model
{
    protected static array $public = [
        "token", "user_id",
    ];


    public function add(string $key, mixed $value): static
    {
        $encryptor = new Encryptor();

        $session = self::createOrRetrieve();
        $sessionData = json_decode($encryptor->decrypt($session->data));
        $sessionData[$key] = $value;
        $session->data->data = $encryptor->encrypt(json_encode($sessionData));
        $session->update();

        return $this;
    }


    /**
     * Retrieve session row from sessions table
     * using user ID.
     *
     * @param int $userId
     * @return Session|null
     */
    public static function getByUserId(int $userId): ?Session
    {
        return Session::query()
                      ->where("user_id", $userId)
                      ->first();
    }

    /**
     * Attempt to retrieve the current session's row.
     * If it does no longer exist, it will be created
     * and returned.
     *
     * @return Session
     */
    public static function createOrRetrieve(): Session
    {
        if (!self::exists())
        {
            return Session::query()->create([
                "token" => SessionsManager::token(),
                "user_id" => null,  // TODO: implement user_id
                "data" => "",
            ]);
        }
        else
        {
            return Session::query()
                          ->where("token", SessionsManager::token())
                          ->first();
        }
    }

    /**
     * @return bool If current session is existing
     */
    public static function exists(): bool
    {
        $token = SessionsManager::token();

        return Session::query()
                      ->where("token", $token)
                      ->count();
    }
}