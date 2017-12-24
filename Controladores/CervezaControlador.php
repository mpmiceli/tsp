<?php

namespace Controladores;

use Config\Request;
use Modelos;
use Controladores;
use DAOs\DAOCerveza;
use DAOs\BDCerveza;
use DAOs\BDEnvase;
use Vistas;

class CervezaControlador extends ControladorComun
{
    private $datoCerveza;
    private $datoEnvase;

    public function __construct()
    {
        $this->datoCerveza = BDCerveza::getInstance();
        $this->datoEnvase = BDEnvase::getInstance();
    }

    public function listar()
    {
        require_once 'Vistas/Administrador.php';
        require_once 'Vistas/AdministradorListarCervezas.php';    
    }

    public function modificar($idCerveza)
    {
        $cerveza = $this->buscarCerveza($idCerveza);
        $envases = $this->datoEnvase->getLista();

        $envasesCerveza = $this->datoCerveza->listarEnvases($idCerveza);

        $ids_envases = array();
        foreach ($envasesCerveza as $envase) {
            array_push($ids_envases, $envase->getId());
        }

        require_once 'Vistas/Administrador.php';
        require_once 'Vistas/AdministradorModificarCervezas.php';  
    }

    public function alta()
    {
        $datos = new Controladores\EnvaseControlador();
        $envases = $datos->getListaEnvases();
        require_once 'Vistas/Administrador.php';
        require_once 'Vistas/AdministradorAltaCerveza.php';  
    }

    public function darDeAlta($nombre, $descripcion, $precio, $envases)
    {
        try {

            $cerveza = $this->datoCerveza->buscarXnombre($nombre);

            if ($cerveza->getNombre() == $nombre) {

                if ($cerveza->getActivo() == 1) {
                    throw new \Exception('Esa cerveza ya existe');
                } else {

                    $imagen = $this->MoverImagen();

                    $this->datoCerveza->modificar(
                        $cerveza->getId(),
                        [
                            'nombre' => $cerveza->getNombre(),
                            'descripcion' => $descripcion,
                            'precio' => $precio,
                            'activo' => 1,
                            'envases' => $envases
                        ],
                        $imagen
                    );

                    header("Location: ../cerveza/listar");
                }             

            } else {
                $cerveza = new Modelos\Cerveza();
                
                $cerveza->setNombre($nombre);
                $cerveza->setDescripcion($descripcion);
                $cerveza->setPrecio($precio);
                $cerveza->setActivo(1);

                $imagen = $this->MoverImagen();
                if(!is_null($imagen)){
                    $cerveza->setImagen($imagen);
                }

                $envasesC = array();
                foreach ($envases as $idEnvase) {
                    $dato = $this->datoEnvase->buscar($idEnvase);
                    array_push($envasesC, $dato);
                }
                
                $cerveza->setEnvases($envasesC);

                $this->datoCerveza->agregar($cerveza);
                
                header("Location: ../cerveza/listar");
            }

        } catch (\Exception $exception) {
            echo '<script> alert("'.$exception->getMessage().'"); </script>';
            require_once "Vistas/Administrador.php";
        }
    }

    public function baja($id)
    {   
        $this->datoCerveza->eliminar($id);
        header("Location: ../../cerveza/listar");
    }

    public function getListaCervezas()
    {
        return $this->datoCerveza->getLista();
    }

    public function buscarCerveza($idCerveza)
    {
        return $this->datoCerveza->buscar($idCerveza);
    }

    public function litros($fecha, $fechados)
    {
        return $this->datoCerveza->litrosVendidos($fecha, $fechados);
    }    

    public function guardarCambios($idCerveza, $parametros)
    {
        $request = new Request();
        $parametros = $request->getParametros();   
        $idCerveza = $parametros['id'];
        $parametros['activo'] = 1;
        $archi = $this->MoverImagen();

        $this->datoCerveza->modificar($idCerveza, $parametros, $archi);
        header("Location: ../cerveza/listar");
    }
}
