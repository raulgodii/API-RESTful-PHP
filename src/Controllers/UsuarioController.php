<?php

namespace Controllers;

use Models\Usuario;
use Lib\Pages;
use Utils\Utils;
use Repositories\UsuarioRepository;

/**
 * Controlador para gestionar las operaciones relacionadas con los usuarios.
 */
class UsuarioController {
    private Pages $pages;
    private UsuarioRepository $repository;

    /**
     * Constructor de la clase UsuarioController.
     */
    public function __construct() {
        $this->pages = new Pages();
        $this->repository = new UsuarioRepository();
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
                    $usuarioReg['password'] = password_hash($usuarioReg['password'], PASSWORD_BCRYPT, ['cost' => 4]);

                    $usuario = Usuario::fromArray($usuarioReg);

                    // Registro del usuario en la base de datos.
                    $save = $this->repository->registerUsuario($usuario);

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
                $identity = $this->repository->login($usuarioLog);

                if ($identity && is_object($identity)) {
                    $_SESSION['login'] = $identity;
                } else {
                    $this->repository->close();
                    $this->pages->render("Usuario/Login", ["errorLogin" => true, "email" => $usuarioLog->getEmail()]);
                }

                $this->repository->close();
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
        $this->repository = new UsuarioRepository();
        return $this->repository->getUsuarioFromId($usuario_id);
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
                    $update = $this->repository->updateUsuario($updateUsuario);

                    if ($update) {
                        $usuarioLog = Usuario::fromArray($updateUsuario);

                        $this->repository = new UsuarioRepository();

                        // Actualiza la sesión del usuario.
                        $identity = $this->repository->updateLogin($usuarioLog);

                        if ($identity && is_object($identity)) {
                            $_SESSION['login'] = $identity;
                        } else {
                            $this->repository->close();
                            $this->pages->render("Usuario/ManageProfile", ["errorUpdateUsuario" => true]);
                        }
                    } else {
                        $this->repository->close();
                        $this->pages->render("Usuario/ManageProfile", ["errorUpdateUsuario" => true]);
                    }
                } else {
                    $this->repository->close();
                    $this->pages->render("Usuario/ManageProfile", ["errorUpdateUsuario" => true]);
                }

                $this->repository->close();
            } else {
                $this->pages->render("Usuario/ManageProfile", ["errorUpdateUsuario" => true]);
            }
        }

        // Renderiza la vista de gestión de perfil de usuario.
        $this->pages->render("Usuario/ManageProfile");
    }
}
