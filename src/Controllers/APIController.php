<?php
namespace Controllers;
use Lib\Pages;
use Models\Competicion;

class APIController{
    private Pages $pages;
    private Competicion $model;
    function __construct(){
        $this->pages = new Pages();
        $this->model = new Competicion();
    }

    public function mostrar_competiciones(){
        $body = $this->model->mostrar_competiciones();
        $this->pages->render("competiciones/mostrar_competiciones", ["body"=>$body]);
    }

    public function mostrar_competicion($id){
        $body = $this->model->mostrar_competicion($id);
        $this->pages->render("competiciones/mostrar_competicion", ["body"=>$body]);
    }

    public function eliminar_competicion($id){
        $rowCount = $this->model->eliminar_competicion($id);
        $this->pages->render("competiciones/eliminar_competicion", ["rowCount"=>$rowCount]);
    }
    
}