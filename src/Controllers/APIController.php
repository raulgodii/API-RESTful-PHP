<?php

namespace Controllers;

use Lib\Pages;
use Lib\Security;
use Models\Competicion;
use Models\Usuario;

class APIController
{
    private Pages $pages;
    private Competicion $model;

    private Usuario $usuario;
    function __construct()
    {
        $this->pages = new Pages();
        $this->model = new Competicion();
        $this->usuario = Usuario::fromArray([]);;
    }

    public function mostrar_competiciones()
    {
        if (isset($_SESSION['login']) && $_SESSION['login'] != 'failed') {
            $token = Security::getToken();
            // Comprobar que el token que llega es el mismo de la base de datos
            if (!$this->usuario->comprobarToken($_SESSION['login']->correo, $token)) {
                $error = "Token no válido";
                $this->pages->render("competiciones/mostrar_competiciones", ["error" => $error]);
            }

            // Comprobar que el token no está expirado
            elseif ($this->usuario->tokenExpirado($_SESSION['login']->correo)) {
                $error = "Token expirado";
                $this->pages->render("competiciones/mostrar_competiciones", ["error" => $error]);
            }

            // Comprobar datos del token que llega
            elseif (!$this->usuario->datosCorrectosToken($token, $_SESSION['login']->nombre, $_SESSION['login']->correo)) {
                $error = "Token no correspondido";
                $this->pages->render("competiciones/mostrar_competiciones", ["error" => $error]);
            }

            // Exito
            else {
                $this->usuario->guardaToken(Security::crearTokenExpirado(Security::claveSecreta(), [$_SESSION['login']->nombre, $_SESSION['login']->correo]));
                $body = $this->model->mostrar_competiciones();
                $this->pages->render("competiciones/mostrar_competiciones", ["body" => $body]);
            }
        } else {
            $error = "No tienes acceso a esta pagina";
            $this->pages->render("competiciones/mostrar_competiciones", ["error" => $error]);
        }
    }

    public function mostrar_competicion($id)
    {
        if (isset($_SESSION['login']) && $_SESSION['login'] != 'failed') {
            $token = Security::getToken();
            // Comprobar que el token que llega es el mismo de la base de datos
            if (!$this->usuario->comprobarToken($_SESSION['login']->correo, $token)) {
                $error = "Token no válido";
                $this->pages->render("competiciones/mostrar_competicion", ["error" => $error]);
            }

            // Comprobar que el token no está expirado
            elseif ($this->usuario->tokenExpirado($_SESSION['login']->correo)) {
                $error = "Token expirado";
                $this->pages->render("competiciones/mostrar_competicion", ["error" => $error]);
            }

            // Comprobar datos del token que llega
            elseif (!$this->usuario->datosCorrectosToken($token, $_SESSION['login']->nombre, $_SESSION['login']->correo)) {
                $error = "Token no correspondido";
                $this->pages->render("competiciones/mostrar_competicion", ["error" => $error]);
            }

            // Exito
            else {
                $this->usuario->guardaToken(Security::crearTokenExpirado(Security::claveSecreta(), [$_SESSION['login']->nombre, $_SESSION['login']->correo]));
                $body = $this->model->mostrar_competicion($id);
                $this->pages->render("competiciones/mostrar_competicion", ["body" => $body]);
            }
        } else {
            $error = "No tienes acceso a esta pagina";
            $this->pages->render("competiciones/mostrar_competicion", ["error" => $error]);
        }
    }

    public function eliminar_competicion($id)
    {
        if (isset($_SESSION['login']) && $_SESSION['login'] != 'failed') {
            $token = Security::getToken();
            // Comprobar que el token que llega es el mismo de la base de datos
            if (!$this->usuario->comprobarToken($_SESSION['login']->correo, $token)) {
                $error = "Token no válido";
                $this->pages->render("competiciones/eliminar_competicion", ["error" => $error]);
            }

            // Comprobar que el token no está expirado
            elseif ($this->usuario->tokenExpirado($_SESSION['login']->correo)) {
                $error = "Token expirado";
                $this->pages->render("competiciones/eliminar_competicion", ["error" => $error]);
            }

            // Comprobar datos del token que llega
            elseif (!$this->usuario->datosCorrectosToken($token, $_SESSION['login']->nombre, $_SESSION['login']->correo)) {
                $error = "Token no correspondido";
                $this->pages->render("competiciones/eliminar_competicion", ["error" => $error]);
            }

            // Exito
            else {
                $this->usuario->guardaToken(Security::crearTokenExpirado(Security::claveSecreta(), [$_SESSION['login']->nombre, $_SESSION['login']->correo]));
                $rowCount = $this->model->eliminar_competicion($id);
                $this->pages->render("competiciones/eliminar_competicion", ["rowCount" => $rowCount]);
            }
        } else {
            $error = "No tienes acceso a esta pagina";
            $this->pages->render("competiciones/eliminar_competicion", ["error" => $error]);
        }
    }

    public function crear_competicion()
    {
        if (isset($_SESSION['login']) && $_SESSION['login'] != 'failed') {
            $token = Security::getToken();
            // Comprobar que el token que llega es el mismo de la base de datos
            if (!$this->usuario->comprobarToken($_SESSION['login']->correo, $token)) {
                $error = "Token no válido";
                $this->pages->render("competiciones/crear_competicion", ["error" => $error]);
            }

            // Comprobar que el token no está expirado
            elseif ($this->usuario->tokenExpirado($_SESSION['login']->correo)) {
                $error = "Token expirado";
                $this->pages->render("competiciones/crear_competicion", ["error" => $error]);
            }

            // Comprobar datos del token que llega
            elseif (!$this->usuario->datosCorrectosToken($token, $_SESSION['login']->nombre, $_SESSION['login']->correo)) {
                $error = "Token no correspondido";
                $this->pages->render("competiciones/crear_competicion", ["error" => $error]);
            }

            // Exito
            else {
                $this->usuario->guardaToken(Security::crearTokenExpirado(Security::claveSecreta(), [$_SESSION['login']->nombre, $_SESSION['login']->correo]));

                $data = json_decode(file_get_contents("php://input"), true);
                $rowCount = $this->model->crear_competicion($data);
                $this->pages->render("competiciones/crear_competicion", ["rowCount" => $rowCount]);
            }
        } else {
            $error = "No tienes acceso a esta pagina";
            $this->pages->render("competiciones/crear_competicion", ["error" => $error]);
        }
    }

    public function modificar_competicion($id)
    {
        if (isset($_SESSION['login']) && $_SESSION['login'] != 'failed') {
            $token = Security::getToken();
            // Comprobar que el token que llega es el mismo de la base de datos
            if (!$this->usuario->comprobarToken($_SESSION['login']->correo, $token)) {
                $error = "Token no válido";
                $this->pages->render("competiciones/modificar_competicion", ["error" => $error]);
            }

            // Comprobar que el token no está expirado
            elseif ($this->usuario->tokenExpirado($_SESSION['login']->correo)) {
                $error = "Token expirado";
                $this->pages->render("competiciones/modificar_competicion", ["error" => $error]);
            }

            // Comprobar datos del token que llega
            elseif (!$this->usuario->datosCorrectosToken($token, $_SESSION['login']->nombre, $_SESSION['login']->correo)) {
                $error = "Token no correspondido";
                $this->pages->render("competiciones/modificar_competicion", ["error" => $error]);
            }

            // Exito
            else {
                $this->usuario->guardaToken(Security::crearTokenExpirado(Security::claveSecreta(), [$_SESSION['login']->nombre, $_SESSION['login']->correo]));

                $data = json_decode(file_get_contents("php://input"), true);
                $rowCount = $this->model->modificar_competicion($id, $data);
                $this->pages->render("competiciones/modificar_competicion", ["rowCount" => $rowCount]);
            }
        } else {
            $error = "No tienes acceso a esta pagina";
            $this->pages->render("competiciones/modificar_competicion", ["error" => $error]);
        }
    }

    public function home()
    {
        $this->pages->render("layout/home");
    }
}
