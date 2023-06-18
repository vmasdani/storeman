<?php
namespace App\Http\Services;

class AuthService
{

    public static function getSecretKey()
    {
        $secretFileExists = file_exists('jwt_secret');

        if (!$secretFileExists) {
            $f = fopen('jwt_secret', 'w');
            $secret = bin2hex(random_bytes(32));
            fwrite($f, $secret);
            fclose($f);

            return $secret;
        }

        return file_get_contents('jwt_secret');
    }
}