<?php

namespace Models;

use Lib\BaseDatos;
use Lib\DataBase;
use PDO;
use PDOException;
use Lib\Security;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Firebase\JWT\ExpiredException;


/**
 * Clase Usuario que representa a un usuario en un sistema de gestión de usuarios.
 */
class Usuario
{
    /** @var string|null Identificador único del usuario. Puede ser nulo si el usuario aún no tiene un ID asignado. */
    private string|null $id;

    /** @var string Nombre del usuario. */
    private string $nombre;

    /** @var string Email del usuario. */
    private string $email;

    /** @var string Contraseña del usuario. */
    private string $password;

    /** @var DataBase Objeto para interactuar con la base de datos. */
    private DataBase $db;

    /**
     * Constructor de la clase Usuario.
     *
     * @param string|null $id Identificador único del usuario. Puede ser nulo si el usuario aún no tiene un ID asignado.
     * @param string $nombre Nombre del usuario.
     * @param string $apellidos Apellidos del usuario.
     * @param string $email Email del usuario.
     * @param string $password Contraseña del usuario.
     */
    public function __construct(string|null $id, string $nombre, string $email, string $password)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->email = $email;
        $this->password = $password;
        $this->db = new DataBase();
    }

    /**
     * Obtiene el identificador único del usuario.
     *
     * @return string|null Identificador único del usuario. Puede ser nulo si el usuario aún no tiene un ID asignado.
     */
    public function getId(): string|null
    {
        return $this->id;
    }

    /**
     * Establece el identificador único del usuario.
     *
     * @param string $id Identificador único del usuario. Puede ser nulo si el usuario aún no tiene un ID asignado.
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * Obtiene el nombre del usuario.
     *
     * @return string Nombre del usuario.
     */
    public function getNombre(): string
    {
        return $this->nombre;
    }

    /**
     * Establece el nombre del usuario.
     *
     * @param string $nombre Nombre del usuario.
     */
    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }

    /**
     * Obtiene el email del usuario.
     *
     * @return string Email del usuario.
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Establece el email del usuario.
     *
     * @param string $email Email del usuario.
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * Obtiene la contraseña del usuario.
     *
     * @return string Contraseña del usuario.
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Establece la contraseña del usuario.
     *
     * @param string $password Contraseña del usuario.
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }


    /**
     * Crea un objeto Usuario a partir de un array de datos.
     *
     * @param array $data Array de datos del usuario.
     *
     * @return Usuario Objeto Usuario creado a partir del array de datos.
     */
    public static function fromArray(array $data): Usuario
    {
        return new Usuario(
            $data['id'] ?? null,
            $data['nombre'] ?? '',
            $data['email'] ?? '',
            $data['password'] ?? ''
        );
    }

    public function confirmarCorreo($tokenDecoded, $token)
    {
        // Obtener datos del token
        $correo = $tokenDecoded->data[1];
        $usuario = $tokenDecoded->data[0];
        $expiracion = $tokenDecoded->exp;

        // Verificar si el usuario está registrado
        if (!$this->usuarioRegistrado($correo)) {
            return "Error: El usuario con correo $correo no está registrado.";
        }

        // Verificar si el usuario ya está confirmado
        if ($this->usuarioConfirmado($correo)) {
            return "Error: El usuario con correo $correo ya está confirmado.";
        }

        // Verificar si el token es el mismo
        if (!$this->comprobarToken($correo, $token)) {
            return "Error: El token para iniciar sesión no es válido.";
        }

        // Verificar si el token ha expirado
        $tiempoActual = time();

        if ($expiracion <= $tiempoActual) {
            return "Error: El token ha expirado, vuelva a registrarse.";
        }

        // Si todas las verificaciones pasan, marcar el usuario como confirmado


        return $this->marcarUsuarioConfirmado($correo, $usuario);
    }

    // Función para verificar si un usuario está registrado
    private function usuarioRegistrado($correo)
    {
        try {
            $select = $this->db->prepare("SELECT * FROM usuarios WHERE correo=:email");
            $select->bindValue(':email', $correo, PDO::PARAM_STR);
            $select->execute();
            if ($select && $select->rowCount() == 1) {
                $result = $select->fetch(PDO::FETCH_OBJ);
            } else {
                $result = false;
            }
        } catch (PDOException $err) {

            $result = false;
        }
        return $result;
    }

    // Función para verificar si un usuario ya está confirmado
    private function usuarioConfirmado($correo)
    {
        try {
            $select = $this->db->prepare("SELECT confirmado FROM usuarios WHERE correo=:email");
            $select->bindValue(':email', $correo, PDO::PARAM_STR);
            $select->execute();

            if ($select && $select->rowCount() == 1) {
                // Obtener el valor de confirmado directamente en la consulta SQL
                $result = $select->fetch(PDO::FETCH_OBJ)->confirmado;
            } else {
                $result = false;
            }
        } catch (PDOException $err) {
            // Manejar el error si ocurre una excepción
            $result = false;
        }

        return $result;
    }

    // Función para verificar si el token es el mismo
    public function comprobarToken($correo, $token)
    {
        try {
            $select = $this->db->prepare("SELECT token FROM usuarios WHERE correo=:correo");
            $select->bindValue(':correo', $correo, PDO::PARAM_STR);
            $select->execute();

            if ($select && $select->rowCount() == 1) {
                // Obtener el token de la base de datos
                $tokenBD = $select->fetch(PDO::FETCH_OBJ)->token;

                // Comparar el token de la base de datos con el proporcionado
                $result = ($tokenBD === $token);
            } else {
                $result = false;
            }
        } catch (PDOException $err) {
            // Manejar el error si ocurre una excepción
            $result = false;
        }

        return $result;
    }

    public function datosCorrectosToken($token, $nombre, $correo)
    {
        try {
            $tokenDecoded = Security::descrifrarToken($token);

            // Obtener datos del token
            $correoToken = $tokenDecoded->data[1];
            $nombreToken = $tokenDecoded->data[0];

            // El token es válido y no ha expirado
            if(($nombreToken === $nombre)&&($correoToken === $correo)){
                return true;
            }
        } catch (ExpiredException $e) {
            // El token ha expirado, manejar aquí la lógica correspondiente
            return false;
        } catch (Exception $e) {
            // Otras excepciones
            return false;
        }
    }


    // Función para marcar a un usuario como confirmado
    private function marcarUsuarioConfirmado($correo, $usuario)
    {
        try {
            $fechaExpiracion = strtotime("now") - 1800;
            $tokenExpirado = Security::crearTokenExpirado(Security::claveSecreta(), [$usuario, $correo]);

            // Actualizar el campo 'confirmado' a true para el usuario con el correo especificado
            $update = $this->db->prepare("UPDATE usuarios SET confirmado = true, fecha_expiracion_token = :fechaExpiracion, token = :tokenExpirado WHERE correo = :correo");
            $update->bindValue(':correo', $correo, PDO::PARAM_STR);
            $update->bindValue(':fechaExpiracion', $fechaExpiracion, PDO::PARAM_STR);
            $update->bindValue(':tokenExpirado', $tokenExpirado, PDO::PARAM_STR);


            $update->execute();

            // Verificar si la actualización fue exitosa
            $result = "Éxito: El usuario $usuario con correo $correo ha sido confirmado satisfactoriamente.";
        } catch (PDOException $err) {
            // Manejar el error si ocurre una excepción
            $result = "Error: El usuario $usuario con correo $correo no ha podido ser confirmado.";
        }

        return $result;
    }

    /**
     * Desconecta el objeto de la base de datos cerrando la conexión.
     */
    public function desconecta(): void
    {
        $this->db->close();
    }

    /**
     * Crea un nuevo usuario en la base de datos.
     *
     * @return bool True si la creación fue exitosa, False si ocurrió un error.
     */
    public function create(): bool
    {
        // die("entra");
        $nombre = $this->getNombre();
        $email = $this->getEmail();
        $password = $this->getPassword();
        $token = Security::crearToken(Security::claveSecreta(), [$nombre, $email]);
        $fecha_expiracion_token = strtotime("now") + 1800;

        try {
            $ins = $this->db->prepare("INSERT INTO usuarios (nombre, correo, contrasena, token, confirmado, fecha_expiracion_token) values (:nombre, :email, :password, :token, 0, :fecha_expiracion_token)");

            $ins->bindValue(':nombre', $nombre, PDO::PARAM_STR);
            $ins->bindValue(':email', $email, PDO::PARAM_STR);
            $ins->bindValue(':password', $password, PDO::PARAM_STR);
            $ins->bindValue(':token', $token, PDO::PARAM_STR);
            $ins->bindValue(':fecha_expiracion_token', $fecha_expiracion_token, PDO::PARAM_STR);

            $ins->execute();

            $result = true;
            $this->enviarMail($nombre, $email, $token);
        } catch (PDOException $error) {
            $result = false;
        }

        $ins->closeCursor();
        $ins = null;
        $this->db->close();

        return $result;
    }

    private function enviarMail($nombre, $correo, $token)
    {
        $mail = new PHPMailer(true);

        try {
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'raulgodii13@gmail.com';                     //SMTP username
            $mail->Password   = 'vxgfbwpltnhcgvtz';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('raulgodii13@gmail.com', 'Raul');
            $mail->addAddress($correo, 'Raul');     //Add a recipient
            $mail->addReplyTo('raulgodii13@gmail.com', 'Information');

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = "Confirma su correo para iniciar sesion";
            $mail->Body    = "Hola $nombre! Dale click a este enlace para confirmar su correo electronico:
                <a href='http://localhost/API-RESTful-PHP/confirmarCorreo/" . $token . "'>Confirmar</a>
            ";

            $mail->send();
        } catch (Exception $e) {
            echo "Error al enviar el correo: {$mail->ErrorInfo}";
        }
    }

    /**
     * Crea un nuevo usuario en la base de datos.
     *
     * @return bool True si la creación fue exitosa, False si ocurrió un error.
     */
    public function crear(): bool
    {
        $id = NULL;
        $nombre = $this->getNombre();
        $email = $this->getEmail();
        $password = $this->getPassword();

        try {
            $ins = $this->db->prepare("INSERT INTO usuarios (id, nombre, email, password) values (:id, :nombre, :email, :password)");

            $ins->bindValue(':id', $id, PDO::PARAM_INT);
            $ins->bindValue(':nombre', $nombre, PDO::PARAM_STR);
            $ins->bindValue(':email', $email, PDO::PARAM_STR);
            $ins->bindValue(':password', $password, PDO::PARAM_STR);

            $ins->execute();

            $result = true;
        } catch (PDOException $error) {
            $result = false;
        }

        $ins->closeCursor();
        $ins = null;
        $this->db->close();

        return $result;
    }

    /**
     * Realiza el proceso de inicio de sesión para el usuario.
     *
     * @return mixed Devuelve el objeto Usuario si el inicio de sesión fue exitoso, False si no fue exitoso.
     */
    public function login(): mixed
    {
        $email = $this->getEmail();
        $password = $this->getPassword();

        try {
            $datosUsuario = $this->buscaMail($email);

            if ($datosUsuario) {
                $verify = password_verify($password, $datosUsuario->contrasena);

                if ($verify) {
                    $result = $datosUsuario;
                } else {
                    $result = false;
                }
            } else {
                $result = false;
            }
        } catch (PDOException $error) {
            $result = false;
        }

        return $result;
    }

    /**
     * Busca un usuario en la base de datos por su email.
     *
     * @param string $email Email del usuario a buscar.
     *
     * @return mixed Devuelve el objeto Usuario si se encuentra, False si no se encuentra.
     */
    public function buscaMail(string $email): mixed
    {
        try {
            $select = $this->db->prepare("SELECT * FROM usuarios WHERE correo=:email");
            $select->bindValue(':email', $email, PDO::PARAM_STR);
            $select->execute();
            if ($select && $select->rowCount() == 1) {
                $result = $select->fetch(PDO::FETCH_OBJ);
            } else {

                $result = false;
            }
        } catch (PDOException $err) {

            $result = false;
        }
        return $result;
    }

    /**
     * Valida los datos del usuario durante el proceso de registro.
     *
     * @return array|bool Array de errores si los hay, True si no hay errores.
     */
    public function validarRegistro(): array|bool
    {
        // Sanear datos
        $this->nombre = filter_var($this->nombre, FILTER_SANITIZE_SPECIAL_CHARS);
        $this->email = filter_var($this->email, FILTER_SANITIZE_EMAIL);
        $this->password = filter_var($this->password, FILTER_SANITIZE_SPECIAL_CHARS);

        $errores = [];

        // Validación del nombre
        if (empty($this->nombre)) {
            $errores['nombre'] = 'El nombre es obligatorio.';
        } elseif (!preg_match('/^[a-zA-ZáéíóúüñÁÉÍÓÚÜÑ\s]+$/', $this->nombre)) {
            $errores['nombre'] = 'El nombre contiene caracteres no permitidos.';
        }

        // Validación del email
        if (empty($this->email)) {
            $errores['email'] = 'El email es obligatorio.';
        } elseif (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $errores['email'] = 'El formato del email no es válido.';
        } elseif ($this->buscaMail($this->email) !== false) {
            $errores['email'] = 'Este correo ya ha sido registrado.';

            if (!$this->usuarioConfirmado($this->email) && $this->tokenExpirado($this->email)) {
                $errores['expirado'] = '';
            }
        }

        // Validación de la contraseña
        if (empty($this->password)) {
            $errores['password'] = 'La contraseña es obligatoria.';
        } elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/', $this->password)) {
            $errores['password'] = 'La contraseña debe contener al menos una letra mayúscula, una letra minúscula y un número, y tener al menos 8 caracteres.';
        }

        // Devuelve el array de errores si los hay, o true si no hay errores
        return empty($errores) ? true : $errores;
    }

    function tokenExpirado($correo)
    {
        try {
            // Obtener la fecha de expiración del token de la base de datos
            $select = $this->db->prepare("SELECT token FROM usuarios WHERE correo = :correo");
            $select->bindValue(':correo', $correo, PDO::PARAM_STR);
            $select->execute();

            if ($select && $select->rowCount() == 1) {
                $token = $select->fetch(PDO::FETCH_OBJ)->token;

                try {
                    Security::descrifrarToken($token);
                    // El token es válido y no ha expirado
                    return false;
                } catch (ExpiredException $e) {
                    // El token ha expirado, manejar aquí la lógica correspondiente
                    return true;
                } catch (Exception $e) {
                    // Otras excepciones
                    return false;
                }
            } else {
                return false;
            }
        } catch (PDOException $err) {
            // Manejar el error si ocurre una excepción
            return false;
        }
    }


    /**
     * Valida los datos del usuario durante el proceso de inicio de sesión.
     *
     * @return array|bool Array de errores si los hay, True si no hay errores.
     */
    public function validarLogin(): array|bool
    {
        $this->email = filter_var($this->email, FILTER_SANITIZE_EMAIL);
        $this->password = filter_var($this->password, FILTER_SANITIZE_SPECIAL_CHARS);

        $errores = [];

        // Validación del email
        if (empty($this->email)) {
            $errores['email'] = 'El email es obligatorio.';
        } elseif (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $errores['email'] = 'El formato del email no es válido.';
        } elseif (!$this->buscaMail($this->email)) {
            $errores['email'] = 'Este correo no pertenece a ninguna cuenta.';
        } elseif (!$this->usuarioConfirmado($this->email)) {
            $errores['confirmado'] = 'Acción necesaria: confirmar correo';
        }

        // Validación de la contraseña
        if (empty($this->password)) {
            $errores['password'] = 'La contraseña es obligatoria.';
        } elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/', $this->password)) {
            $errores['password'] = 'La contraseña debe contener al menos una letra mayúscula, una letra minúscula y un número, y tener al menos 8 caracteres.';
        }

        // Devuelve el array de errores si los hay, o true si no hay errores
        return empty($errores) ? true : $errores;
    }

    public function guardaToken($token)
    {
        try {
            $fechaExpiracion = strtotime("now") + 1800;

            // Actualizar el campo 'confirmado' a true para el usuario con el correo especificado
            $update = $this->db->prepare("UPDATE usuarios SET confirmado = true, fecha_expiracion_token = :fechaExpiracion, token = :token WHERE correo = :correo");
            $update->bindValue(':correo', $_SESSION['login']->correo, PDO::PARAM_STR);
            $update->bindValue(':fechaExpiracion', $fechaExpiracion, PDO::PARAM_STR);
            $update->bindValue(':token', $token, PDO::PARAM_STR);


            $update->execute();

            // Verificar si la actualización fue exitosa
            $result = true;
        } catch (PDOException $err) {
            // Manejar el error si ocurre una excepción
            $result = false;
        }

        return $result;
    }
}
