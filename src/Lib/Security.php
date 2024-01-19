<?php

namespace Lib;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use PDOException;

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
            "int" => $time,
            "exp" => $time + 3600,
            "data" => $data
        );
        return JWT::encode($token, $key, "HS256");
    }

    final public static function getToken()
    {
        $headers = apache_request_headers(); // Recoger las cabeceras en el servidor Apache
        if (!isset($headers['Authorization'])) { // Comprobamos que existe la cabecera authorization
            return $response['message'] = json_decode(ResponseHTTP::statusMessage(403, 'Acceso Denegado'));
        }
        try {
            $authorizationArr = explode('', $headers['Authorization']);
            $token = $authorizationArr[1];
            $decodeToken = JWT::decode($token, new Key(Security::claveSecreta(), 'HS256'));
            return $decodeToken;
        } catch (PDOException $e) {
            return $response['message'] = json_encode(ResponseHTTP::statusMessage(401, 'Token expirado o invalido'));
        }
    }
}
