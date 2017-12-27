<?php

namespace Controladores;
use Modelos;
use Controladores;

class ClienteControlador extends ControladorComun
{
    public function menu(){        
        require_once 'Vistas/Cliente.php';
    }

    public function listarCerveza(){
        $datos = new Controladores\CervezaControlador();
        require_once('Vistas/Cliente.php');
        require_once('Vistas/ClienteListarCervezas.php');    
    }

    public function mostrarCarrito(){
    	$pedido = self::getCarrito();
        $lineas = $pedido->getLineaPedido();
        $cliente = $_SESSION['USUARIO-LOGUEADO'];
        $datosSucursal = new Controladores\SucursalControlador();
        $sucursales = $datosSucursal->getListaSucursales();
    	require_once('Vistas/Cliente.php');
        require_once('Vistas/ClienteCarrito.php'); 
    }

    public function listarPedidos(){
        $datosSucursal = new Controladores\SucursalControlador();
        $datosPedido = new Controladores\PedidoControlador();
        $listaPedidos = $datosPedido->listarPedidos(); 
        require_once('Vistas/Cliente.php');
        require_once('Vistas/ClienteListarPedidos.php');     
    }

    public function listarSucursales()
    {
        $datos = new Controladores\SucursalControlador();
        require_once('Vistas/Cliente.php');
        require_once('Vistas/ClienteListarSucursales.php');    
    }
}
