<?php

namespace Lib;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use PDOException;
use Firebase\JWT\ExpiredException;

class Security
{
    final public static function claveSecreta()
    {
        return $_ENV['SECRET_KEY'];
    }
    final public static function encriptaPassw(string $pass)
    {
        $pass = password_hash($pass, PASSWORD_DEFAULT);
        return $pass;
    }

    final public static function validaPassw(string $pass, string $passHash)
    {
        return password_verify($pass, $passHash);
    }

    final public static function crearToken(string $key, array $data): string
    {
        $time = strtotime("now");
        $token = array(
            "iat" => $time,
            "exp" => $time + 1800,
            "data" => $data
        );
        return JWT::encode($token, $key, "HS256");
    }

    final public static function crearTokenExpirado(string $key, array $data): string
    {
        $time = strtotime("now");
        $token = array(
            "iat" => $time,
            "exp" => $time - 1800,
            "data" => $data
        );
        return JWT::encode($token, $key, "HS256");
    }

    final public static function descrifrarToken($token)
    {

        $decoded = JWT::decode($token, new Key(Security::claveSecreta(), 'HS256'));
        return $decoded;
    }

    final public static function getToken()
    {
        $headers = apache_request_headers(); // Recoger las cabeceras en el servidor Apache
        if (!isset($headers['Authorization'])) { // Comprobamos que existe la cabecera authorization
            return "";
        }
        try {
            $authorizationArr = explode(' ', $headers['Authorization']);
            $token = $authorizationArr[1];
            return $token;
        } catch (PDOException $e) {
            return "";
        }
    }
}
