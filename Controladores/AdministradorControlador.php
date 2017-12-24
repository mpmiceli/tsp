<?php

namespace Controladores;

use Controladores;

class AdministradorControlador
{
    
    public function menu(){
        require_once 'Vistas/Administrador.php';
    }


    ///////////CERVEZAS////////////////

    

    

    public function botonLitrosFechas(){
        require_once 'Vistas/Administrador.php';
        require_once 'Vistas/AdministradorAltaFechas.php';
    }

    public function cervezasXlitro($fecha, $fechados){
        $datos = new Controladores\CervezaControlador();
        $arreglo = $datos->litros($fecha, $fechados);
        $cervezas = array();
        $cervezas = $arreglo[0];
        $litros = array();
        $litros = $arreglo[1];
        require_once 'Vistas/Administrador.php';
        require_once 'Vistas/AdministradorListarLitrosEntreFechas.php';

    }

    ///////////USUARIOS////////////////

    public function listarUsuarios()
    {
        $datos = new Controladores\UsuarioControlador();
        require_once('Vistas/Administrador.php');
        require_once('Vistas/AdministradorListarUsuarios.php');    
    }

    public function altaUsuario()
    {
        require_once 'Vistas/Administrador.php';
        require_once 'Vistas/AdministradorAltaUsuario.php';  
    }

    public function modificarUsuario($idUsuario)
    {
        $datos = new Controladores\UsuarioControlador();
        $usuarioM = $datos->buscarUsuario($idUsuario);
        require_once('Vistas/Administrador.php');
        require_once 'Vistas/AdministradorModificarUsuarios.php';  
    }

    ///////////USUARIOS////////////////

    public function listarPedidos()
    {
        $datosSucursal = new Controladores\SucursalControlador();
        $sucursales = $datosSucursal->getListaSucursales();
        require_once('Vistas/Administrador.php');
        require_once 'Vistas/AdministradorPedido.php';
    }
}

?>