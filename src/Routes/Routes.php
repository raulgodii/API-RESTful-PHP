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
            return (new APIController())->home();
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

        Router::add('DELETE', '/competicion/:id', function($id){
            return (new APIController())->eliminar_competicion($id);
        });

        Router::add('POST', '/competicion', function(){
            return (new APIController())->crear_competicion();
        });

        Router::add('PUT', '/competicion/:id', function($id){
            return (new APIController())->modificar_competicion($id);
        });

        Router::add('GET', '/prueba/', function(){
            return (new AuthController())->pruebas();
        });

        Router::add('GET', '/iniciarSesion/', function(){
            return (new UsuarioController())->iniciarSesion();
        });

        Router::add('POST', '/iniciarSesion/', function(){
            return (new UsuarioController())->iniciarUsuario();
        });

        Router::add('GET', '/registro/', function(){
            return (new UsuarioController())->registro();
        });

        Router::add('POST', '/registro/', function(){
            return (new UsuarioController())->registrarUsuario();
        });

        Router::add('GET', '/cerrarSesion/', function(){
            return (new UsuarioController())->logout();
        });
        
        Router::dispatch();

    }
}