<?php
namespace Controllers;
use Lib\Pages;
use Lib\Security;
use Models\Usuario;

class AuthController{

    /** @var Pages Instancia de la clase Pages para la gestión de páginas. */
    private Pages $pages;

    public function __construct()
    {
        $this->pages = new Pages();
    }

    public function confirmarCorreo($token){
        $decoded = Security::descrifrarToken($token);
        $errores = Usuario::confirmarCorreo($decoded);
        $this->pages->render('usuario/confirmarCorreo', ['token' => $token]);
    }
}