<?php

namespace Lib;

class Security
{
    final public static function encriptaPassw(string $pass){
        $pass = password_hash($pass, PASSWORD_DEFAULT);
        return $pass;
    }

    final public static function validaPassw(string $pass, string $passHash){
        return password_verify($pass, $passHash);
    }
}