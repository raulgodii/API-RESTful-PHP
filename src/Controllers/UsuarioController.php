<?php

namespace Controllers;

use Models\Usuario;
use Lib\Pages;
use Utils\Utils;

/**
 * Controlador para gestionar las operaciones relacionadas con los usuarios.
 */
class UsuarioController {
    private Pages $pages;
    private Usuario $model;

    /**
     * Constructor de la clase UsuarioController.
     */
    public function __construct() {
        $this->pages = new Pages();
        //$this->model = new Usuario();
    }

    public function iniciarSesion(){
        $this->pages->render('usuario/iniciarSesion');
    }

    public function registro(){
        $this->pages->render('usuario/registro');
    }

    /**
     * Registra un nuevo usuario.
     */
    public function register(): void {
        // Verifica si la solicitud es de tipo POST.
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($_POST['data']) {
                $usuarioReg = $_POST['data'];

                // Validación y sanitización del usuario.
                if (Usuario::validSanitizeUsuario($usuarioReg)) {
                    //$usuarioReg['contrasena'] = password_hash($usuarioReg['contrasena'], PASSWORD_BCRYPT, ['cost' => 4]);
                    $usuario = Usuario::fromArray($usuarioReg);

                    // Registro del usuario en la base de datos.
                    $save = $this->model->registerUsuario($usuario);

                    if ($save) {
                        $_SESSION['register'] = "complete";
                    } else {
                        $_SESSION['register'] = "failed";
                    }
                } else {
                    $_SESSION['register'] = "failed";
                }
            } else {
                $_SESSION['register'] = "failed";
            }
        }

        // Renderiza la vista de registro.
        if (isset($usuarioReg)) {
            $this->pages->render('Usuario/Register', ['usuario' => $usuarioReg]);
        } else {
            $this->pages->render('Usuario/Register');
        }
    }

    /**
     * Realiza el proceso de inicio de sesión.
     */
    public function login(): void {
        // Verifica si la solicitud es de tipo POST.
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['data'])) {
                $login = $_POST['data'];

                $usuarioLog = Usuario::fromArray($login);

                // Intento de inicio de sesión.
                $identity = $this->model->login($usuarioLog);

                if ($identity && is_object($identity)) {
                    $_SESSION['login'] = $identity;
                } else {
                    $this->model->close();
                    $this->pages->render("Usuario/Login", ["errorLogin" => true, "email" => $usuarioLog->getEmail()]);
                }

                $this->model->close();
            } else {
                $this->pages->render("Usuario/Login", ["errorLogin" => true]);
            }
        }

        // Renderiza la vista de inicio de sesión.
        $this->pages->render('Usuario/Login');
    }

    /**
     * Cierra la sesión del usuario.
     */
    public function logout(): void {
        Utils::deleteSession('login');

        header("Location:" . BASE_URL);
    }

    /**
     * Obtiene un usuario a partir de su ID.
     *
     * @param int $usuario_id ID del usuario.
     * @return array|null Arreglo con la información del usuario o null si no se encuentra.
     */
    public function getUsuarioFromId(int $usuario_id): ?array {
        $this->model = new Usuario();
        return $this->model->getUsuarioFromId($usuario_id);
    }

    /**
     * Muestra la página de gestión de perfil de usuario.
     */
    public function manageProfile(): void {
        $this->pages->render("Usuario/ManageProfile");
    }

    /**
     * Muestra la página de edición de perfil de usuario.
     */
    public function editProfile(): void {
        $this->pages->render("Usuario/ManageProfile", ["editProfile" => true]);
    }

    /**
     * Actualiza la información del usuario.
     */
    public function updateUsuario(): void {
        // Verifica si la solicitud es de tipo POST.
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($_POST['updateUsuario']) {
                $updateUsuario = $_POST['updateUsuario'];

                // Validación y sanitización de la información del usuario.
                if (Usuario::validSanitizeUsuario($updateUsuario)) {
                    $update = $this->model->updateUsuario($updateUsuario);

                    if ($update) {
                        $usuarioLog = Usuario::fromArray($updateUsuario);

                        $this->model = new Usuario();

                        // Actualiza la sesión del usuario.
                        $identity = $this->model->updateLogin($usuarioLog);

                        if ($identity && is_object($identity)) {
                            $_SESSION['login'] = $identity;
                        } else {
                            $this->model->close();
                            $this->pages->render("Usuario/ManageProfile", ["errorUpdateUsuario" => true]);
                        }
                    } else {
                        $this->model->close();
                        $this->pages->render("Usuario/ManageProfile", ["errorUpdateUsuario" => true]);
                    }
                } else {
                    $this->model->close();
                    $this->pages->render("Usuario/ManageProfile", ["errorUpdateUsuario" => true]);
                }

                $this->model->close();
            } else {
                $this->pages->render("Usuario/ManageProfile", ["errorUpdateUsuario" => true]);
            }
        }

        // Renderiza la vista de gestión de perfil de usuario.
        $this->pages->render("Usuario/ManageProfile");
    }

    public function modificarProfesores(){
        $profesores = $this->model->obtenerProfesores();
        $this->pages->render('usuario/modificarProfesores', ["profesores" => $profesores]);
    }

    public function eliminarProfesor($id){
        $this->model->eliminarProfesor($id);
        $profesores = $this->model->obtenerProfesores();
        $this->pages->render('usuario/modificarProfesores', ["profesores" => $profesores]);
    }

    public function modificarProfesor($id){
        $profesor = $this->model->obtenerProfesorId($id);
        $this->pages->render('usuario/modificarProfesor', ["profesor" => $profesor]);
    }

    public function confirmarModificarProfesor($id){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($_POST['data']) {
                $this->model->confirmarModificarProfesor($data);
            } 
        }
        
        $profesores = $this->model->obtenerProfesores();
        $this->pages->render('usuario/modificarProfesores', ["profesores" => $profesores]);
    }
}
