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
        var_dump($decoded);

        $usuario = Usuario::fromArray([]);
        $errores = $usuario->confirmarCorreo($decoded, $token);
        $this->pages->render('usuario/confirmarCorreo', ['token' => $token, 'errores' => $errores]);
    }
}