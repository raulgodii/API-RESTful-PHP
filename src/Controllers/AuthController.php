<?php
namespace Controllers;
use Lib\Pages;
use Lib\Security;

class AuthController{

    /** @var Pages Instancia de la clase Pages para la gestión de páginas. */
    private Pages $pages;

    public function __construct()
    {
        $this->pages = new Pages();
    }

    public function confirmarCorreo($token){
        var_dump(Security::getToken());
        $this->pages->render('usuario/confirmarCorreo', ['token' => $token]);
    }
}