<?php

namespace Lib;

use PDO;
use PDOException;

class DataBase
{

  private  $conexion;
  private mixed $resultado; //mixed novedad en PHP cualquier valor
  private string $servidor;
  private string $usuario;
  private string $pass;
  private string $base_datos;
  function __construct()
  {
    $this->servidor =  $_ENV['DB_HOST'];
    $this->usuario = $_ENV['DB_USER'];
    $this->pass = $_ENV['DB_PASS'];
    $this->base_datos = $_ENV['DB_DATABASE'];
    $this->conexion = $this->connect();
  }

  private function connect(): PDO
  {

    try {
      $opciones = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::MYSQL_ATTR_FOUND_ROWS => true
      );
      $conexion = new PDO("mysql:host={$this->servidor};dbname={$this->base_datos}", $this->usuario, $this->pass, $opciones);
      return $conexion;
    } catch (PDOException $e) {
      echo 'Ha surgido un error y no se puede conectar a la base de datos. Detalle: ' . $e->getMessage();
      exit;
    }
  }

  public function query(string $consultaSQL): void
  {
    $this->resultado = $this->conexion->query($consultaSQL);
  }

  // Extraer un registro
  public function fetch(): mixed
  {
    return ($fila = $this->resultado->fetch(PDO::FETCH_ASSOC)) ? $fila : false;
  }

  // Extraer todos los registros
  public function fetchAll(): array
  {
    return $this->resultado->fetchAll(PDO::FETCH_ASSOC);
  }

  // Numero de filas afectadas
  public function rowCount(): int
  {
    return $this->resultado->rowCount();
  }

  // Ultimo ID insertado
  public function lastInsertId(): int
  {
    return $this->conexion->lastInsertId();
  }

  // Consulta preparada
  public function prepare($pre)
  {
    return $this->conexion->prepare($pre);
  }

  // Cierra conexion
  public function close(): void
  {

    $this->conexion = null;
  }

  public function extractRegister(): mixed
  {
    return ($row = $this->resultado->fetch(PDO::FETCH_ASSOC)) ? $row : false;
  }
}
