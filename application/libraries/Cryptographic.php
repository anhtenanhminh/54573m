<?php
include ('Crypt/TripleDES.php');

class Cryptographic
{

    public static function encrypt($plaintext)
    {
        $cipher = new Crypt_TripleDES(CRYPT_DES_MODE_CBC);
        $cipher->setKey(base64_decode("R/lzQX3ej9iqG9ldjyElbA=="));
        $cipher->setIV(base64_decode("8AMtHQBMrTs="));
        return base64_encode($cipher->encrypt($plaintext));
    }

    public static function decrypt($ciphertext)
    {
        $cipher = new Crypt_TripleDES(CRYPT_DES_MODE_CBC);
        $cipher->setKey(base64_decode("R/lzQX3ej9iqG9ldjyElbA=="));
        $cipher->setIV(base64_decode("8AMtHQBMrTs="));
        return $cipher->decrypt(base64_decode($ciphertext));
    }
}