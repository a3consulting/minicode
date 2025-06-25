<?php

namespace App\Service;

class CodeEncryptionService
{
    /**
     * Chiffre un texte avec une clé symétrique (sodium ou openssl).
     */
    public function encrypt(string $plaintext, string $hexKey): string
    {
        if (function_exists('sodium_crypto_secretbox')) {
            $key = sodium_hex2bin($hexKey);
            $nonce = random_bytes(SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);
            $cipher = sodium_crypto_secretbox($plaintext, $nonce, $key);
            return base64_encode($nonce . $cipher);
        }
        // Fallback openssl (moins sécurisé)
        $iv = random_bytes(16);
        $cipher = openssl_encrypt($plaintext, 'aes-256-cbc', hex2bin($hexKey), OPENSSL_RAW_DATA, $iv);
        return base64_encode($iv . $cipher);
    }

    /**
     * Déchiffre un texte avec une clé symétrique (sodium ou openssl).
     */
    public function decrypt(string $ciphertext, string $hexKey): string
    {
        $data = base64_decode($ciphertext);
        if (function_exists('sodium_crypto_secretbox_open')) {
            $key = sodium_hex2bin($hexKey);
            $nonce = substr($data, 0, SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);
            $cipher = substr($data, SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);
            $plain = sodium_crypto_secretbox_open($cipher, $nonce, $key);
            if ($plain === false) {
                throw new \Exception('Déchiffrement échoué');
            }
            return $plain;
        }
        // Fallback openssl
        $iv = substr($data, 0, 16);
        $cipher = substr($data, 16);
        $plain = openssl_decrypt($cipher, 'aes-256-cbc', hex2bin($hexKey), OPENSSL_RAW_DATA, $iv);
        if ($plain === false) {
            throw new \Exception('Déchiffrement échoué');
        }
        return $plain;
    }
}
