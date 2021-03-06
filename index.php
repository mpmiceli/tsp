<?php

require('Config/Autoload.php');
require('Config/Config.php');

use Config\Autoload;
use Config\Request;
use Config\Router;

Autoload::start();

$request = new Request();
$router = new Router();

if (empty(session_id())) {
    session_start();    
}

if (
    ($request->getControlador() != 'Login' && $request->getMetodo() != 'index')
    && ($request->getControlador() != 'Usuario' && $request->getMetodo() != 'darDeAlta')
) {
    $usuario = \Controladores\LoginControlador::getUsuarioLogueado();
    if (is_null($usuario)) {
        header("Location: ".HOST);
        exit;
    }    
}
 
$router->direccionar($request);

