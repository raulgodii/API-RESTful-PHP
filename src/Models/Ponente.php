<?php
namespace Models;
use Lib\DataBase;
use PDOException;
use PDO;

class Ponente{

    private DataBase $connection;
    
    public function __construct(){
        $this->connection = new DataBase();
    }

    public function mostrar_ponentes(){
        $body = [];
        try {
            // Query
            $stmt=$this->connection->prepare('SELECT * FROM ponentes');

            // Ejecutar query
            $stmt->execute();

            // Extraer registros
            $body=$stmt->fetchAll(PDO::FETCH_ASSOC);
            if($body == false){
                $body = [];
            }

            // Cerrar
            $stmt->closeCursor();

            return $body;
        } catch (PDOException $e){
            return $body;
        }
    }
    public function mostrar_ponente($id){
        $body = [];
        try {
            // Query
            $stmt=$this->connection->prepare('SELECT * FROM ponentes WHERE id=:id');

            $stmt->bindValue(':id', $id, PDO::PARAM_INT);

            // Ejecutar query
            $stmt->execute();

            // Extraer registros
            $body=$stmt->fetchAll(PDO::FETCH_ASSOC);
            if($body == false){
                $body = [];
            }

            // Cerrar
            $stmt->closeCursor();

            return $body;
        } catch (PDOException $e){
            return $body;
        }
    }

}