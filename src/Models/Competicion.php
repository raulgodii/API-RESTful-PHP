<?php

namespace Models;

use Lib\DataBase;
use PDOException;
use PDO;

class Competicion
{

    private DataBase $connection;

    public function __construct()
    {
        $this->connection = new DataBase();
    }

    public function mostrar_competiciones()
    {
        $body = [];
        try {
            // Query
            $stmt = $this->connection->prepare('SELECT * FROM competiciones');

            // Ejecutar query
            $stmt->execute();

            // Extraer registros
            $body = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($body == false) {
                $body = [];
            }

            // Cerrar
            $stmt->closeCursor();

            return $body;
        } catch (PDOException $e) {
            return $body;
        }
    }
    public function mostrar_competicion($id)
    {
        $body = [];
        try {
            // Query
            $stmt = $this->connection->prepare('SELECT * FROM competiciones WHERE id=:id');

            $stmt->bindValue(':id', $id, PDO::PARAM_INT);

            // Ejecutar query
            $stmt->execute();

            // Extraer registros
            $body = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($body == false) {
                $body = [];
            }

            // Cerrar
            $stmt->closeCursor();

            return $body;
        } catch (PDOException $e) {
            return $body;
        }
    }

    public function eliminar_competicion($id)
    {
        $rowCount = 0;
        try {
            // Query
            $stmt = $this->connection->prepare('DELETE FROM competiciones WHERE id=:id');

            $stmt->bindValue(':id', $id, PDO::PARAM_INT);

            // Ejecutar query
            $stmt->execute();

            // Obtener el número de filas afectadas
            $rowCount = $stmt->rowCount();

            // Cerrar
            $stmt->closeCursor();

            return $rowCount;
        } catch (PDOException $e) {
            return $rowCount;
        }
    }

    public function crear_competicion($data)
    {
        $rowCount = 0;

        // Comprobar que se han enviado y recibido los datos
        if (!isset($data['nombre'], $data['fecha'], $data['ubicacion'], $data['organizador'], $data['nivel'], $data['division'])) {
            return $rowCount; // No se han enviado todos los datos
        }

        // Validar y sanear datos
        $nombre = filter_var($data['nombre'], FILTER_SANITIZE_SPECIAL_CHARS);
        $fecha = filter_var($data['fecha'], FILTER_SANITIZE_SPECIAL_CHARS);
        $ubicacion = filter_var($data['ubicacion'], FILTER_SANITIZE_SPECIAL_CHARS);
        $organizador = filter_var($data['organizador'], FILTER_SANITIZE_SPECIAL_CHARS);
        $nivel = filter_var($data['nivel'], FILTER_SANITIZE_SPECIAL_CHARS);
        $division = filter_var($data['division'], FILTER_SANITIZE_SPECIAL_CHARS);

        // Comprobar que no hay campos vacíos después de la validación y saneamiento
        if (empty($nombre) || empty($fecha) || empty($ubicacion) || empty($organizador) || empty($nivel) || empty($division)) {
            return $rowCount; // Algunos datos no son válidos después de la validación y saneamiento
        }

        try {
            // Query
            $stmt = $this->connection->prepare('INSERT INTO competiciones (nombre, fecha, ubicacion, organizador, nivel, division) VALUES (:nombre, :fecha, :ubicacion, :organizador, :nivel, :division)');

            $stmt->bindValue(':nombre', $nombre, PDO::PARAM_STR);
            $stmt->bindValue(':fecha', $fecha, PDO::PARAM_STR);
            $stmt->bindValue(':ubicacion', $ubicacion, PDO::PARAM_STR);
            $stmt->bindValue(':organizador', $organizador, PDO::PARAM_STR);
            $stmt->bindValue(':nivel', $nivel, PDO::PARAM_STR);
            $stmt->bindValue(':division', $division, PDO::PARAM_STR);

            // Ejecutar query
            $stmt->execute();

            // Obtener el número de filas afectadas
            $rowCount = $stmt->rowCount();

            // Cerrar
            $stmt->closeCursor();

            return $rowCount;
        } catch (PDOException $e) {
            return $rowCount; // No se pudo insertar
        }
    }

    public function modificar_competicion($id, $data)
    {
        $rowCount = 0;

        // Comprobar que se han enviado y recibido los datos y el ID
        if (!isset($data['nombre'], $data['fecha'], $data['ubicacion'], $data['organizador'], $data['nivel'], $data['division'], $id)) {
            return $rowCount; // No se han enviado todos los datos o el ID
        }

        // Validar y sanear datos
        $nombre = filter_var($data['nombre'], FILTER_SANITIZE_SPECIAL_CHARS);
        $fecha = filter_var($data['fecha'], FILTER_SANITIZE_SPECIAL_CHARS);
        $ubicacion = filter_var($data['ubicacion'], FILTER_SANITIZE_SPECIAL_CHARS);
        $organizador = filter_var($data['organizador'], FILTER_SANITIZE_SPECIAL_CHARS);
        $nivel = filter_var($data['nivel'], FILTER_SANITIZE_SPECIAL_CHARS);
        $division = filter_var($data['division'], FILTER_SANITIZE_SPECIAL_CHARS);

        // Comprobar que no hay campos vacíos después de la validación y saneamiento
        if (empty($nombre) || empty($fecha) || empty($ubicacion) || empty($organizador) || empty($nivel) || empty($division)) {
            return $rowCount; // Algunos datos no son válidos después de la validación y saneamiento
        }

        try {
            // Query
            $stmt = $this->connection->prepare('UPDATE competiciones SET nombre = :nombre, fecha = :fecha, ubicacion = :ubicacion, organizador = :organizador, nivel = :nivel, division = :division WHERE id = :id');

            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->bindValue(':nombre', $nombre, PDO::PARAM_STR);
            $stmt->bindValue(':fecha', $fecha, PDO::PARAM_STR);
            $stmt->bindValue(':ubicacion', $ubicacion, PDO::PARAM_STR);
            $stmt->bindValue(':organizador', $organizador, PDO::PARAM_STR);
            $stmt->bindValue(':nivel', $nivel, PDO::PARAM_STR);
            $stmt->bindValue(':division', $division, PDO::PARAM_STR);

            // Ejecutar query
            $stmt->execute();

            // Obtener el número de filas afectadas
            $rowCount = $stmt->rowCount();

            // Cerrar
            $stmt->closeCursor();

            return $rowCount;
        } catch (PDOException $e) {
            return $rowCount; // No se pudo modificar
        }
    }
}
