<?php

namespace Repositories;

use Lib\DataBase;
use PDO;
use PDOException;

class TemplateRepository extends DataBase{
    private DataBase $connection;

    public function __construct()
    {
        $this->connection = new DataBase();
    }

    public function consulta($param1,$param2){
        try {
            // Query
            $stmt=$this->prepare('INSERT INTO BD (param1, param2) VALUES (:param1, :param2)');

            // Values
            $stmt->bindValue(':param1', $param1, PDO::PARAM_INT);
            $stmt->bindValue(':param2', $param2, PDO::PARAM_STR);

            // Ejecutar query
            $stmt->execute();

            // Extraer registros
            $datos=$stmt->fetch();

            // Cerrar
            $stmt->closeCursor();

            return true;
        } catch (PDOException $e){
            return false;
        }
    }
}