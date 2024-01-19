<?php
namespace Controllers;
use Lib\Pages;
use Lib\Security;

class AuthController{
    public function pruebas(){
        echo Security::crearToken(Security::claveSecreta(), ['id=>19']);
        echo "<br>";
        var_dump(Security::getToken());
    }
}