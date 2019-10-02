<?php

namespace models;

class Cine
{
	private $id;
	private $nombre;
	private $direccion;
	private $capacidad;
	private $valor_Entrada;

	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function  getNombre()
	{
		return $this->nombre;
	}

	public function  setNombre($nombre)
	{
		$this->nombre = $nombre;
	}

	public function  getDireccion()
	{
		return $this->direccion;
	}

	public function  setDireccion($direccion)
	{
		$this->direccion = $direccion;
	}

	public function getCapacidad()
	{
		return $this->capacidad;
	}

	public function setCapacidad($capacidad)
	{
		$this->capacidad = $capacidad;
	}

	public function getValor_Entrada()
	{
		return $this->valor_Entrada;
	}

	public function setValor_Entrada($valor_Entrada)
	{
		$this->valor_Entrada = $valor_Entrada;
	}
}
