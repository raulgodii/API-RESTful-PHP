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

        Router::add('GET', '/login/', function(){
            return (new UsuarioController())->login();
        });

        Router::add('POST', '/login/', function(){
            return (new UsuarioController())->login();
        });

        Router::add('GET', '/registro/', function(){
            return (new UsuarioController())->register();
        });

        Router::add('POST', '/registro/', function(){
            return (new UsuarioController())->register();
        });

        Router::add('GET', '/logout/', function(){
            return (new UsuarioController())->logout();
        });


        Router::add('GET', '/error/', function(){
            return (new ErrorController())->error404();
        });

        Router::dispatch();

    }
}