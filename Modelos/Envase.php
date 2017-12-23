<?php

namespace Modelos;

class Envase{

	private $id;
	private $volumen;
	private $factor;
	private $descripcion;
	private $imagen;
	private $activo;

	public function setId($id){
		$this->id = $id;
	}

	public function getId(){
		return $this->id;
	}

	public function setVolumen($volumen){
		$this->volumen = $volumen;
	}

	public function getVolumen(){
		return $this->volumen;
	}

	public function setFactor ($factor){
		$this->factor = $factor;
	}

	public function getFactor(){
		return $this->factor;
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

	public function setActivo($activo) {
		$this->activo = $activo;
	}

	public function getActivo() {
		return $this->activo;
	}
}
