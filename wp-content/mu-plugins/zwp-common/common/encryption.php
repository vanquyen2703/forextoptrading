<?php
define('WIV', 'YwqYNCHHEHo=');
define('OPENSSL_CIPHER_METHOD', 'BF-ECB');

class ZwpEncryption
{

    public static function encrypt($input = null, $key = null)
    {
        $data = openssl_encrypt(
           $input,
           OPENSSL_CIPHER_METHOD,
           $key,
           OPENSSL_RAW_DATA
        );
        return self::base64UrlsafeEncode($data);
    }

    public static function decrypt($input = null, $key = null)
    {

        $input = self::base64UrlsafeDecode($input);

        $data = openssl_decrypt(
           $input,
           OPENSSL_CIPHER_METHOD,
           $key,
           OPENSSL_RAW_DATA
        );
        return preg_replace("/\p{Cc}*$/u", "", rtrim($data, "\0"));
    }


    private static function base64UrlsafeEncode($val)
    {
        $val = base64_encode($val);
        return str_replace(array('+', '/', '='), array('_', '-', '.'), $val);
    }

    private static function base64UrlsafeDecode($val)
    {
        $val = str_replace(array('_', '-', '.'), array('+', '/', '='), $val);
        return base64_decode($val);
    }

}
