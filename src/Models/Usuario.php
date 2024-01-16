<?php

namespace Models;

/**
 * Clase que representa la entidad de usuario (Usuario).
 */
class Usuario {
    private string|null $id;
    private string $name;
    private string $last_name;
    private string $email;
    private string $password;
    private string $date;

    /**
     * Constructor de la clase Usuario.
     *
     * @param string|null $id       ID del usuario (opcional).
     * @param string      $name     Nombre del usuario.
     * @param string      $last_name Apellido del usuario.
     * @param string      $email    Correo electrónico del usuario.
     * @param string      $password Contraseña del usuario.
     * @param string      $date     Fecha de creación del usuario.
     */
    public function __construct(string|null $id, string $name, string $last_name, string $email, string $password, string $date) {
        $this->id = $id;
        $this->name = $name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->password = $password;
        $this->date = $date;
    }

    /**
     * Obtiene el ID del usuario.
     *
     * @return string|null ID del usuario.
     */
    public function getId(): string|null {
        return $this->id;
    }

    /**
     * Obtiene el nombre del usuario.
     *
     * @return string Nombre del usuario.
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * Obtiene el apellido del usuario.
     *
     * @return string Apellido del usuario.
     */
    public function getLast_name(): string {
        return $this->last_name;
    }

    /**
     * Obtiene el correo electrónico del usuario.
     *
     * @return string Correo electrónico del usuario.
     */
    public function getEmail(): string {
        return $this->email;
    }

    /**
     * Obtiene la contraseña del usuario.
     *
     * @return string Contraseña del usuario.
     */
    public function getPassword(): string {
        return $this->password;
    }

    /**
     * Obtiene la fecha de creación del usuario.
     *
     * @return string Fecha de creación del usuario.
     */
    public function getDate(): string {
        return $this->date;
    }

    /**
     * Establece el ID del usuario.
     *
     * @param string $id Nuevo ID del usuario.
     */
    public function setId(string $id): void {
        $this->id = $id;
    }

    /**
     * Establece el nombre del usuario.
     *
     * @param string $name Nuevo nombre del usuario.
     */
    public function setName(string $name): void {
        $this->name = $name;
    }

    /**
     * Establece el apellido del usuario.
     *
     * @param string $last_name Nuevo apellido del usuario.
     */
    public function setLast_name(string $last_name): void {
        $this->last_name = $last_name;
    }

    /**
     * Establece el correo electrónico del usuario.
     *
     * @param string $email Nuevo correo electrónico del usuario.
     */
    public function setEmail(string $email): void {
        $this->email = $email;
    }

    /**
     * Establece la contraseña del usuario.
     *
     * @param string $password Nueva contraseña del usuario.
     */
    public function setPassword(string $password): void {
        $this->password = $password;
    }

    /**
     * Establece la fecha de creación del usuario.
     *
     * @param string $date Nueva fecha de creación del usuario.
     */
    public function setDate(string $date): void {
        $this->date = $date;
    }

    /**
     * Crea una instancia de Usuario a partir de un array de datos.
     *
     * @param array $data Datos del usuario.
     * @return Usuario Instancia de la clase Usuario.
     */
    public static function fromArray(array $data): Usuario {
        return new Usuario(
            $data['id'] ?? null,
            $data['name'] ?? '',
            $data['last_name'] ?? '',
            $data['email'] ?? '',
            $data['password'] ?? '',
            $data['date'] ?? ''
        );
    }

    /**
     * Valida y sanitiza los datos de un usuario.
     *
     * @param array $data Datos del usuario a validar y sanitizar.
     * @return array Datos del usuario validados y sanitizados.
     */
    public static function validSanitizeUsuario(array $data): array {
        // Reglas de validación
        $rules = array(
            'name' => array('filter' => FILTER_VALIDATE_REGEXP, 'options' => array('regexp' => '/^[a-zA-Z]+$/')),
            'last_name' => array('filter' => FILTER_VALIDATE_REGEXP, 'options' => array('regexp' => '/^[a-zA-Z]+$/')),
            'email' => FILTER_VALIDATE_EMAIL,
            'date' => array('filter' => FILTER_SANITIZE_FULL_SPECIAL_CHARS),
            'password' => array('filter' => FILTER_SANITIZE_FULL_SPECIAL_CHARS)
        );
    
        $validData = filter_var_array($data, $rules);
    
        // Devuelve
        // Devuelve los datos válidos y sanitizados
        return $validData;
    } 
}
