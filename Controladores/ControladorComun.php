<?php

namespace Controladores;

use Modelos;

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

    protected function validarCampoNoVacio($nombre, $campo) {
        $campo = trim($campo);
        if (strlen($campo) == 0) {
            throw new \Exception("El campo '".$nombre."' esta vacio");
        }
    }

    protected function validarNumeroValido($nombre, $campo) {
        $this->validarCampoNoVacio($nombre, $campo);
        if (!is_numeric($campo)) {
            throw new \Exception("El campo '".$nombre."' no es un numero valido");   
        }
    }

    public static function getCarrito(){
        if (!isset($_SESSION['PEDIDO'])) {
            $pedido = new Modelos\Pedido();

            $cliente = $_SESSION['USUARIO-LOGUEADO'];
            $pedido->setUsuario($cliente);

            $_SESSION['PEDIDO'] = $pedido;
        }
        return $_SESSION['PEDIDO'];
    }
}