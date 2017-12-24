<?php

namespace Controladores;

use Config\Request;
use Modelos;
use DAOs\BDEnvase;
use Vistas;

class EnvaseControlador {

    private $datoEnvase;

    public function __construct()
    {
        $this->datoEnvase = BDEnvase::getInstance();
    }

    public function MoverImagen(){
        $imageDirectory = 'images/';

        if(!file_exists($imageDirectory)){

            mkdir($imageDirectory);
        }
        //print_r($_FILES);
        //exit;

        if($_FILES and $_FILES['imagen']['size']>0){
            
            if((isset($_FILES['imagen'])) && ($_FILES['imagen']['name'] != '')){
                
                $file = $imageDirectory . basename($_FILES['imagen']['name']);
                
                if(!file_exists($file)){
                    
                    move_uploaded_file($_FILES["imagen"]["tmp_name"], $file);
                }

                return $file;
            }
        }else{
            return null;
        }
    }

    public function darDeAlta($volumen, $factor, $descripcion)
    {
        try {            
            
            $this->datoEnvase = BDEnvase::getInstance();   

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

                    header("Location: ../administrador/listarEnvases");
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
                header("Location: ../administrador/altaEnvase");
            }
        } catch (\Exception $exception) {
            echo '<script> alert("'.$exception->getMessage().'"); </script>';
            require_once "Vistas/Administrador.php";
        }
    }

    public function getListaEnvases()
    {
        return $this->datoEnvase->getLista();
    }

    public function buscarEnvase($idEnvase)
    {
        return $this->datoEnvase->buscar($idEnvase);
    }

    public function guardarCambios($idEnvase, $parametros)
    {
        $request = new Request();
        $parametros = $request->getParametros();   
        $idEnvase = $parametros['id'];
        $archi = $this->MoverImagen();
        $this->datoEnvase->modificar($idEnvase, $parametros, $archi);    
        header("Location: ./administrador/listarEnvases");
    }

    public function baja($id)
    {   
        $this->datoEnvase->eliminar($id);
        header("Location: ../../administrador/listarEnvases");   
    }
}
?>