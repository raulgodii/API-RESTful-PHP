<?php
namespace Models;
use Lib\BaseDatos;
use PDOException;
use PDO;
use Services\TemplateService;

class Template{

    private TemplateService $service;
    
    public function __construct(){
        $this->service = new TemplateService();
    }

    public function consulta($param1,$param2){
        $this->service->consulta($param1,$param2);
    }

    public static function fromArray(array $data): Doctor {
        return new Doctor(
            $data['id'],
            $data['nombre'],
            $data['apellidos'],
            $data['telefono'],
            $data['especialidad'],
            
        );
        /* Este método nos permite hacer la correspondencia o mapeo de cada
         * array de un registro obtenido de la consulta de la base de datos
         * a un objeto Doctor
         */
    }

    public function find($id): bool
    {
        try {
            $stmt=$this->prepara('Select * from pacientes where id=:id');

            $stmt->bindValue(':id', $id);

            $stmt->execute();
            $datos=$stmt->fetch();

            $stmt->closeCursor();
            if ($datos>0){
                return true;
            } else {
               return false;
            }
        } catch (PDOException){
            return false;
        }
    }

    public function update($data){
        try {
            $stmt=$this->prepara('Update pacientes SET nombre = :nombre, apellidos = :apellidos, correo = :correo, password = :password  where id = :id');

            $stmt->bindValue(':id', intval($data['id']));
            $stmt->bindValue(':nombre', $data['nombre']);
            $stmt->bindValue(':apellidos', $data['apellidos']);
            $stmt->bindValue(':correo', $data['correo']);
            $stmt->bindValue(':password', $data['password']);

            $stmt->execute();
            $stmt->closeCursor();
            return true;
        } catch (PDOException $e){
            return false;
        }
    }}