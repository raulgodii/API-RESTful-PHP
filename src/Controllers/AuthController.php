<?php
namespace Controllers;
use Lib\Pages;
use Lib\Security;

class AuthController{
    public function pruebas(){
        $pass = Security::encriptaPassw("123");
        echo $pass;
        echo "<br>";
        echo "Password validada: " . Security::validaPassw("123d", $pass);
    }
}