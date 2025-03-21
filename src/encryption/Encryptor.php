<?php

namespace Sherpa\Core\encryption;

use Sherpa\Core\core\Sherpa;
use Sherpa\Core\encryption\exceptions\UnknownEncryptionKeyException;

class Encryptor
{
    private const int KEY_BYTES = 32;
    private const string DEFAULT_CIPHER = "AES-256-CBC";

    private $key;
    private $cipher;

    public function __construct()
    {
        $key = Sherpa::encryptKey();

        if ($key === null)
        {
            throw new UnknownEncryptionKeyException();
        }

        $this->key = hash('sha256', $key, true);
        $this->cipher = Sherpa::encryptCipher()
            ?? self::DEFAULT_CIPHER;
    }

    public function encrypt(string $data): string
    {
        $iv = openssl_random_pseudo_bytes(
            openssl_cipher_iv_length(
                $this->cipher));

        $encrypted = openssl_encrypt(
            $data,
            $this->cipher,
            $this->key,
            iv: $iv);

        return base64_encode($iv . $encrypted);
    }

    public function decrypt(string $data): string
    {
        $data = base64_decode($data);
        $ivLength = openssl_cipher_iv_length($this->cipher);
        $iv = substr($data, 0, $ivLength);
        $encrypted = substr($data, $ivLength);

        return openssl_decrypt($encrypted,
            $this->cipher,
            $this->key,
            iv: $iv);
    }


    /**
     * Generate an encryption key,
     * used for session encryption.
     * <p>
     *     This method is used internally,
     *     not necessary for the developer.
     * </p>
     *
     * @return string
     * @throws \Random\RandomException
     */
    public static function generateEncryptKey(): string
    {
        return bin2hex(random_bytes(self::KEY_BYTES));
    }
}