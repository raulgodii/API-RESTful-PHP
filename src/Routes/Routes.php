<?php
namespace Routes;

use Controllers\APIController;
use Controllers\AuthController;
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

        Router::add('GET', '/competiciones/', function(){
            return (new APIController())->mostrar_competiciones();
        });

        Router::add('GET', '/competicion/:id', function($id){
            return (new APIController())->mostrar_competicion($id);
        });

        Router::add('GET', '/prueba/', function(){
            return (new AuthController())->pruebas();
        });
        
        Router::dispatch();

    }
}