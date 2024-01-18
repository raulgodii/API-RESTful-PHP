<?php
namespace Controllers;
use Lib\Pages;
use Models\Ponente;

class APIponenteController{
    private Pages $pages;
    private Ponente $model;
    function __construct(){
        $this->pages = new Pages();
        $this->model = new Ponente();
    }

    public function mostrar_ponentes(){
        $body = $this->model->mostrar_ponentes();
        $this->pages->render("ponentes/mostrar_ponentes", ["body"=>$body]);
    }
    
}