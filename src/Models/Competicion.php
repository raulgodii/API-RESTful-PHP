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
}
