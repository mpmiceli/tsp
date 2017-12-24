<?php

namespace Controladores;

use Config\Request;
use Modelos;
use DAOs\DAOSucursal;
use DAOs\BDSucursal;
use Vistas;

class SucursalControlador extends ControladorComun
{

    private $datoSucursal;

    public function __construct()
    {
        $this->datoSucursal = BDSucursal::getInstance();
    }

    public function listar()
    {
        require_once('Vistas/Administrador.php');
        require_once('Vistas/AdministradorListarSucursales.php');    
    }

    public function modificar($idSucursal)
    {
        $sucursal = $this->datoSucursal->buscar($idSucursal);
        require_once('Vistas/Administrador.php');
        require_once 'Vistas/AdministradorModificarSucursales.php';  
    }

    public function alta()
    {
        require_once 'Vistas/Administrador.php';
        require_once 'Vistas/AdministradorAltaSucursal.php';  
    }

    public function darDeAlta($direccion, $numero)
    {
        try {

            $sucursal = $this->datoSucursal->buscarPorDireccionCompleta($direccion, $numero);

            if ($sucursal) {

                if ($sucursal->getActivo() == 1) {
                    throw new \Exception('Esa sucursal ya existe'); 
                } else {
                    $this->datoSucursal->modificar(
                        $sucursal->getId(),
                        [
                            'direccion' => $direccion,
                            'numero' => $numero,
                            'activo' => 1
                        ]
                    );
                    header("Location: ".HOST."/sucursal/listar");
                }

            } else {

                $sucursal = new Modelos\Sucursal();

                $sucursal->setDireccion($direccion);
                $sucursal->setNumero($numero);
                
                $this->datoSucursal->agregar($sucursal);
                
                header("Location: ".HOST."/sucursal/listar");
            }

        } catch (\Exception $e) {
            $this->mostrarError($exception);
        }
    }

    public function getListaSucursales()
    {
        return $this->datoSucursal->getLista();
    }

    public function buscarSucursal($idSucursal)
    {
        return $this->datoSucursal->buscar($idSucursal);
    }

    public function guardarCambios($idSucursal, $parametros)
    {
        $request = new Request();
        $parametros = $request->getParametros();
        $parametros['activo'] = 1;   
        $idSucursal = $parametros['id'];
        $this->datoSucursal->modificar($idSucursal, $parametros);    
        header("Location: ".HOST."/sucursal/listar");
    }

    public function baja($id)
    {   
        $this->datoSucursal->eliminar($id);
        header("Location: ".HOST."/sucursal/listar");   
    }

    public function mapa()
    {
        $sucursales = $this->datoSucursal->getLista();
        require_once 'Vistas/MapaSucursales.php';
    }
}