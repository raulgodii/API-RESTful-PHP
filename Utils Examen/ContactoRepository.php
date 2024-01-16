<?php

namespace Repositories;

use Lib\DataBase;
use PDO;
use PDOException;

class ContactoRepository
{
    private BaseDatos $conexion;

    function __construct()
    {
        $this->conexion = new BaseDatos();
    }

    public function findAll()
    {
        $this->conexion->consulta("SELECT * FROM contactos");
        return $this->extractAll();
    }

    public function extractAll()
    {
        $contactos = [];
        $contactosData = $this->conexion->extraer_todos();

        foreach ($contactosData as $contactoData) {
            $contactos[] = Contacto::fromArray($contactoData);
        }

        return $contactos;
    }

    private function extraer_registro(){
        return ($Contacto = $this->conexion->extraer_registro())?Contacto::fromArray($Contacto):null;
    }

    public function read(int $id){
        $consulta = "SELECT id, nombre, apellidos FROM contactos WHERE id= :id";
        $stmt = $this->conexion->prepara($consulta);

        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $stmt->closeCursor();

        $stmt=null;

        return $this->extraer_registro();
    }

    public function save(array $contacto):void {

    }
}