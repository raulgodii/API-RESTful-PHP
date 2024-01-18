<?php
namespace Routes;

use Controllers\APIponenteController;
use Controllers\DashboardController;
use Controllers\ErrorController;
use Controllers\UsuarioController;
Use Lib\Router;

class Routes{
    public static function index(){

        Router::add('GET', '/', function(){
            return (new ErrorController())->error404();
        });

        Router::add('GET', '/error/', function(){
            return (new ErrorController())->error404();
        });

        Router::add('GET', '/ponentes/', function(){
            return (new APIponenteController())->mostrar_ponentes();
        });

        Router::dispatch();

    }
}