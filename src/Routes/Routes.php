<?php
namespace Routes;
use Controllers\DashboardController;
use Controllers\ErrorController;
use Controllers\UsuarioController;
Use Lib\Router;

class Routes{
    public static function index(){

        Router::add('GET', '/', function(){
            return (new DashboardController())->index();
        });

        Router::dispatch();

    }
}