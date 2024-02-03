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

        $this->pages->render('usuario/confirmarCorreo', ['errores' => $errores]);
    }

    public function obtenerToken()
    {
        if (isset($_SESSION['login']) && $_SESSION['login'] != 'failed'){
            $token = Security::crearToken(Security::claveSecreta(), [$_SESSION['login']->nombre, $_SESSION['login']->correo]);

            $usuario = Usuario::fromArray([]);
            $guardado = $usuario->guardaToken($token);
            
            if($guardado){
                return $token;
            } else {
                return 'Error al obtener token';
            }
        } else {
            return 'Sin inicio de sesion';
        }
        
    }
}
