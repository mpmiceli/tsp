<?php

namespace Modelos;

class Cerveza{

    private $nombre;
    private $descripcion;
    private $imagen;
    private $precio;
    private $id;
    private $envases;
    private $activo;

    public function __construct(){
        $this->envases = array();
    }

    public function setNombre($nombre){
        $this->nombre = $nombre;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function setDescripcion($descripcion){
        $this->descripcion = $descripcion;
    }

    public function getDescripcion(){
        return $this->descripcion;
    }

    public function setImagen ($imagen){
        $this->imagen = $imagen;
    }

    public function getImagen(){
        return $this->imagen;
    }

    public function setPrecio ($precio){
        $this->precio = $precio;
    }

    public function getPrecio(){
        return $this->precio;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getId(){
        return $this->id;
    }

    public function setEnvases($envases){
        $this->envases = $envases;
    }

    public function getEnvases(){
        return $this->envases;
    }

    public function setActivo($activo){
        $this->activo = $activo;
    }

    public function getActivo(){
        return $this->activo;
    }

    public function calcularPrecio($envase) {
        return $this->getPrecio() * $envase->getFactor();
    }
}
