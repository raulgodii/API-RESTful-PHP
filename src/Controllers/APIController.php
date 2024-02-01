<?php

namespace Controllers;

use Lib\Pages;
use Models\Competicion;

class APIController
{
    private Pages $pages;
    private Competicion $model;
    function __construct()
    {
        $this->pages = new Pages();
        $this->model = new Competicion();
    }

    public function mostrar_competiciones()
    {
        $body = $this->model->mostrar_competiciones();
        $this->pages->render("competiciones/mostrar_competiciones", ["body" => $body]);
    }

    public function mostrar_competicion($id)
    {
        $body = $this->model->mostrar_competicion($id);
        $this->pages->render("competiciones/mostrar_competicion", ["body" => $body]);
    }

    public function eliminar_competicion($id)
    {
        $rowCount = $this->model->eliminar_competicion($id);
        $this->pages->render("competiciones/eliminar_competicion", ["rowCount" => $rowCount]);
    }

    public function crear_competicion()
    {
        $data = json_decode(file_get_contents("php://input"), true);

        $rowCount = $this->model->crear_competicion($data);
        $this->pages->render("competiciones/crear_competicion", ["rowCount" => $rowCount]);
    }

    public function modificar_competicion($id)
    {
        $data = json_decode(file_get_contents("php://input"), true);

        $rowCount = $this->model->modificar_competicion($id, $data);
        $this->pages->render("competiciones/modificar_competicion", ["rowCount" => $rowCount]);
    }

    public function home(){
        $this->pages->render("layout/home");
    }
}
