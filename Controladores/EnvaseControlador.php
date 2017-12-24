<?php

namespace Controladores;

use Config\Request;
use Modelos;
use DAOs\BDEnvase;
use Vistas;

class EnvaseControlador extends ControladorComun {

    private $datoEnvase;

    public function __construct()
    {
        $this->datoEnvase = BDEnvase::getInstance();
    }

    public function listar()
    {
        require_once('Vistas/Administrador.php');
        require_once('Vistas/AdministradorListarEnvases.php');    
    }

    public function alta()
    {
        require_once 'Vistas/Administrador.php';
        require_once 'Vistas/AdministradorAltaEnvase.php';  
    }

    public function darDeAlta($volumen, $factor, $descripcion)
    {
        try {            
            
            $envase = $this->datoEnvase->buscarPorVolumen($volumen);
            
            if ($envase) {

                if ($envase->getActivo() == 1) {
                    throw new \Exception('Ese envase ya existe');    
                } else {

                    $imagen = $this->MoverImagen();

                    $this->datoEnvase->modificar(
                        $envase->getId(),
                        [
                            'volumen' => $volumen,
                            'factor' => $factor,
                            'descripcion' => $descripcion,
                            'activo' => 1
                        ],
                        $imagen
                    );

                    header("Location: ".HOST."/envase/listar");
                }

            } else {

                $envase = new Modelos\Envase();
                $envase->setVolumen($volumen);
                $envase->setFactor($factor);
                $envase->setDescripcion($descripcion);
                $envase->setActivo(1);

                $imagen = $this->MoverImagen();
                if (!is_null($imagen)){
                    $envase->setImagen($imagen);
                }

                $this->datoEnvase->agregar($envase);
                header("Location: ".HOST."/envase/listar");
            }
        } catch (\Exception $exception) {
            echo '<script> alert("'.$exception->getMessage().'"); </script>';
            require_once "Vistas/Administrador.php";
        }
    }

    public function modificar($idEnvase)
    {
        $envase = $this->datoEnvase->buscar($idEnvase);
        require_once('Vistas/Administrador.php');
        require_once 'Vistas/AdministradorModificarEnvases.php';  
    }

    public function guardarCambios($idEnvase, $parametros)
    {
        $request = new Request();
        $parametros = $request->getParametros();   
        $idEnvase = $parametros['id'];
        $archi = $this->MoverImagen();
        $this->datoEnvase->modificar($idEnvase, $parametros, $archi);    
        header("Location: ".HOST."/envase/listar");
    }

    public function getListaEnvases()
    {
        return $this->datoEnvase->getLista();
    }

    public function buscarEnvase($idEnvase)
    {
        return $this->datoEnvase->buscar($idEnvase);
    }

    public function baja($id)
    {   
        $this->datoEnvase->eliminar($id);
        header("Location: ".HOST."/envase/listar");   
    }
}
