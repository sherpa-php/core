<?php

namespace Sherpa\Core\sessions;

use Sherpa\Core\core\Sherpa;
use Sherpa\Core\encryption\Encryptor;
use Sherpa\Core\encryption\exceptions\UnknownEncryptionKeyException;
use Sherpa\Core\models\Model;

class Session extends Model
{
    protected static array $public = [
        "id", "token",
        "user_id", "data",
    ];


    /**
     * Add a session's attribute.
     *
     * @param string $key
     * @param mixed $value
     * @return $this
     * @throws UnknownEncryptionKeyException If .env does no longer
     *                                       have an ENCRYPT_KEY variable
     */
    public function add(string $key, mixed $value): static
    {
        $encryptKey = Sherpa::encryptKey();

        if ($encryptKey === null)
        {
            throw new UnknownEncryptionKeyException();
        }

        $encryptor = new Encryptor($encryptKey);

        $session = self::createOrRetrieve();
        $sessionData = json_decode($encryptor->decrypt($session->data->data));
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