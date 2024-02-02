<?php

namespace Controllers;

use Lib\Pages;
use Lib\Security;
use Models\Usuario;
use Firebase\JWT\ExpiredException;
use Exception;

class AuthController
{

    /** @var Pages Instancia de la clase Pages para la gestión de páginas. */
    private Pages $pages;

    public function __construct()
    {
        $this->pages = new Pages();
    }

    public function confirmarCorreo($token)
    {

        try {
            $decoded = Security::descrifrarToken($token);
            // El token es válido y no ha expirado
            $usuario = Usuario::fromArray([]);
            $errores = $usuario->confirmarCorreo($decoded, $token);
        } catch (ExpiredException $e) {
            // El token ha expirado, manejar aquí la lógica correspondiente
            $errores = 'Error: El token ha expirado, vuelva a registrarse.';
        } catch (Exception $e) {
            // Otras excepciones
            $errores = 'Error al decodificar el token: ' . $e->getMessage();
        }

        $this->pages->render('usuario/confirmarCorreo', ['token' => $token, 'errores' => $errores]);
    }
}
