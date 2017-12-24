<?php

namespace Controladores;

class ControladorComun {

    public function MoverImagen(){
        $imageDirectory = 'images/';

        if(!file_exists($imageDirectory)){

            mkdir($imageDirectory);
        }

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

    protected function mostrarError(\Exception $exception)
    {
        echo '<script> alert("'.$exception->getMessage().'"); </script>';
        require_once "Vistas/Administrador.php";
    }
}