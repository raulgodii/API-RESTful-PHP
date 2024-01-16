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

    public function consulta($param1,$param2){
        $this->service->consulta($param1,$param2);
    }

}