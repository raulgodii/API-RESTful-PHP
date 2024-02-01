<?php

namespace Models;

/**
 * Clase que representa la entidad de usuario (Usuario).
 */
class Usuario
{
    private string|null $id;
    private bool $cuentaBloqueada;
    private string $usuario;
    private string $dni;
    private string $nombre;
    private string $apellido1;
    private string $apellido2;
    private string $email;
    private string $rol;
    private string $contrasena;

    public function __construct(?string $id, bool $cuentaBloqueada, string $usuario, string $dni, string $nombre, string $apellido1, string $apellido2, string $email, string $rol, string $contrasena)
    {
        $this->id = $id;
        $this->cuentaBloqueada = $cuentaBloqueada;
        $this->usuario = $usuario;
        $this->dni = $dni;
        $this->nombre = $nombre;
        $this->apellido1 = $apellido1;
        $this->apellido2 = $apellido2;
        $this->email = $email;
        $this->rol = $rol;
        $this->contrasena = $contrasena;
    }

    /**
     * Crea una instancia de Usuario a partir de un array de datos.
     *
     * @param array $data Datos del usuario.
     * @return Usuario Instancia de la clase Usuario.
     */
    public static function fromArray(array $data): Usuario
    {
        return new Usuario(
            $data['id'] ?? null,
            $data['cuentaBloqueada'] ?? false,
            $data['usuario'] ?? '',
            $data['dni'] ?? '',
            $data['nombre'] ?? '',
            $data['apellido1'] ?? '',
            $data['apellido2'] ?? '',
            $data['email'] ?? '',
            $data['rol'] ?? '',
            $data['contrasena'] ?? ''
        );
    }

    /**
     * Valida y sanitiza los datos de un usuario.
     *
     * @param array $data Datos del usuario a validar y sanitizar.
     * @return array Datos del usuario validados y sanitizados.
     */
    public static function validSanitizeUsuario(array $data): array
    {
        // Reglas de validación y sanitización
        $rules = array(
            'usuario' => array('filter' => FILTER_VALIDATE_REGEXP, 'options' => array('regexp' => '/^[a-zA-Z0-9]+$/')),
            'dni' => array('filter' => FILTER_VALIDATE_REGEXP, 'options' => array('regexp' => '/^[a-zA-Z0-9]+$/')),
            'nombre' => array('filter' => FILTER_VALIDATE_REGEXP, 'options' => array('regexp' => '/^[a-zA-Z]+$/')),
            'apellido1' => array('filter' => FILTER_VALIDATE_REGEXP, 'options' => array('regexp' => '/^[a-zA-Z]+$/')),
            'apellido2' => array('filter' => FILTER_VALIDATE_REGEXP, 'options' => array('regexp' => '/^[a-zA-Z]+$/')),
            'email' => FILTER_VALIDATE_EMAIL,
            'contrasena' => array(
                'filter' => FILTER_VALIDATE_REGEXP,
                'options' => array('regexp' => '/^(?=.*[A-Z])(?=.*\d)(?=.*[#!@*$])[A-Za-z\d#!@*$]{7,}$/')
            )
        );

        $validData = filter_var_array($data, $rules);

        // Devuelve los datos válidos y sanitizados
        return $validData;
    }
}
