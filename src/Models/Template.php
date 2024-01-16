<?php
namespace Models;
use Lib\BaseDatos;
use PDOException;
use PDO;

class Ponente{

    private BaseDatos $connection;
    
    public function __construct(){
        $this->connection = new BaseDatos();
    }

    public function consulta($param1,$param2){
        $this->service->consulta($param1,$param2);
    }

}