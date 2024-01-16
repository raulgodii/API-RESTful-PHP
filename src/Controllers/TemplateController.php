<?php
namespace Controllers;
use Lib\Pages;
use Models\Template;

class TemplateController{
   
    private Pages $pages;
    private Template $model;
    
    function __construct(){
        $this->pages = new Pages();
        $this->model = new Template;
    }

    public function accion($param1,$param2){
        $this->model->consulta($param1,$param2);
    }
}
