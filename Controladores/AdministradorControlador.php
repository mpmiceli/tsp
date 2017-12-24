<?php

namespace Controladores;

use Controladores;

class AdministradorControlador
{
    
    public function menu(){
        require_once 'Vistas/Administrador.php';
    }

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
    
}
