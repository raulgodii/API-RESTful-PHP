<?php

namespace Repositories;

use Lib\DataBase;
use Models\Usuario;
use PDO;
use PDOException;

class UsuarioRepository
{
    private DataBase $connection;

    /**
     * UsuarioRepository constructor.
     */
    function __construct()
    {
        $this->connection = new DataBase();
    }

    /**
     * Obtiene todos los usuarios.
     *
     * @return array
     */
    public function findAll(): array
    {
        $this->connection->query("SELECT * FROM contactos");
        return $this->extractAll();
    }

    /**
     * Extrae todos los usuarios del resultado de la consulta.
     *
     * @return array
     */
    public function extractAll(): array
    {
        $usuarios = [];
        $usuariosData = $this->connection->fetchAll();

        foreach ($usuariosData as $usuarioData) {
            $usuarios[] = Usuario::fromArray($usuarioData);
        }

        return $usuarios;
    }

    /**
     * Extrae un usuario del resultado de la consulta.
     *
     * @return mixed|null
     */
    private function extractRegister()
    {
        return ($usuario = $this->connection->extractRegister()) ? Usuario::fromArray($usuario) : null;
    }

    /**
     * Lee un usuario por su ID.
     *
     * @param int $id
     * @return mixed
     */
    public function read(int $id)
    {
        $consulta = "SELECT id, nombre, apellidos, date FROM users WHERE id= :id";
        $stmt = $this->connection->prepare($consulta);

        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $stmt->closeCursor();

        $stmt = null;

        return $this->extractRegister();
    }

    /**
     * Registra un nuevo usuario.
     *
     * @param Usuario $usuario
     * @return bool
     */
    public function registerUsuario(Usuario $usuario): bool
    {
        $id = null;
        $name = $usuario->getName();
        $last_name = $usuario->getLast_name();
        $email = $usuario->getEmail();
        $password = $usuario->getPassword();
        $date = $usuario->getDate();

        try {
            $ins = $this->connection->prepare("INSERT INTO users (id, name, last_name, email, password, date) values (:id, :name, :last_name, :email, :password, :date)");
            $ins->bindValue(':id', $id);
            $ins->bindValue(':name', $name, PDO::PARAM_STR);
            $ins->bindValue(':last_name', $last_name, PDO::PARAM_STR);
            $ins->bindValue(':email', $email, PDO::PARAM_STR);
            $ins->bindValue(':password', $password, PDO::PARAM_STR);
            $ins->bindValue(':date', $date, PDO::PARAM_STR);

            $ins->execute();

            $ins->closeCursor();

            $result = true;
        } catch (PDOException $err) {
            $result = false;
        }

        return $result;
    }

    /**
     * Busca un usuario por su correo electrónico.
     *
     * @param string $email
     * @return bool|object
     */
    public function buscaMail(string $email): bool|object
    {
        try {
            $cons = $this->connection->prepare("SELECT * FROM users WHERE email = :email");
            $cons->bindValue(':email', $email, PDO::PARAM_STR);
            $cons->execute();
            
            if ($cons && $cons->rowCount() == 1) {
                $result = $cons->fetch(PDO::FETCH_OBJ);
            } else {
                $result = false;
            }

            $cons->closeCursor();

        } catch (PDOException $err) {
            $result = false;
        }
        return $result;
    }

    /**
     * Inicia sesión de usuario.
     *
     * @param Usuario $usuario
     * @return bool|object
     */
    public function login(Usuario $usuario): bool|object
    {
        $result = false;
        $email = $usuario->getEmail();
        $password = $usuario->getPassword();

        $usuario = $this->buscaMail($email);

        if ($usuario !== false) {
            $verify = password_verify($password, $usuario->password);

            if ($verify) {
                $result = $usuario;
            } else {
                $result = false;
            }
        } else {
            $result = false;
        }
        return $result;
    }

    /**
     * Actualiza la sesión de usuario.
     *
     * @param Usuario $usuario
     * @return bool|object
     */
    public function updateLogin(Usuario $usuario): bool|object
    {
        $result = false;
        $email = $usuario->getEmail();
        $password = $usuario->getPassword();

        $usuario = $this->buscaMail($email);

        if ($usuario !== false) {

            $result = $usuario;

        } else {
            $result = false;
        }
        return $result;
    }

    /**
     * Cierra la conexión.
     */
    public function close(): void
    {
        $this->connection->close();
    }

    /**
     * Obtiene un usuario por su ID.
     *
     * @param int $usuario_id
     * @return mixed
     */
    public function getUsuarioFromId(int $usuario_id)
    {
        $this->connection->query("SELECT name FROM users WHERE id=$usuario_id");

        $usuario = $this->connection->fetchAll();
        $this->connection->close();

        return $usuario;
    }

    /**
     * Actualiza la información del usuario.
     *
     * @param array $updateUsuario
     * @return bool
     */
    public function updateUsuario(array $updateUsuario): bool
    {
        $result = true;
        try {
            $this->connection->query("UPDATE usuarios SET name='{$updateUsuario['name']}', last_name='{$updateUsuario['last_name']}', email='{$updateUsuario['email']}', date='{$updateUsuario['date']}' WHERE id='{$updateUsuario['id']}'");
            $this->connection->close();

        } catch (PDOException $err) {
            $result = false;
        }

        return $result;
    }
}
