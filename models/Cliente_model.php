<?php

require_once 'ModelInterface.php';
require_once 'DataBase.php';

class Cliente_model implements ModelInterface
{
	private $_db;
	private $_id;
	private $_nombre;
	private $_apellido;
	private $_compania;

	public function __construct(){
		$this->_db = DataBase::getInstance();
	}

	public function setId($id)
	{
		$this->_id = $id;
	}

	public function getId()
	{
		return $this->_id;
	}

	public function setNombre($nombre)
	{
		$this->_nombre = $nombre;
	}

	public function getNombre()
	{
		return $this->_nombre;
	}

	public function setApellido($apellido)
	{
		$this->_apellido = $apellido;
	}

	public function getApellido()
	{
		return $this->_apellido;
	}

	public function setCompania($compania)
	{
		$this->_compania = $compania;
	}

	public function getCompania()
	{
		return $this->_compania;
	}

	public function save()
	{
		if( is_null($this->_id) )
		{
			//insert
			$query = sprintf("INSERT INTO Cliente(nombre, apellido, compania) VALUES ('%s', '%s', '%s')", $this->_nombre, $this->_apellido, $this->_compania);
		}
		else
		{
			//Update
			$query = sprintf("UPDATE Cliente SET nombre = '%s', apellido = '%s', compania = '%s' WHERE id = %s", $this->_nombre, $this->_apellido, $this->_compania, $this->_id);
		}

		$rs = $this->_db->query($query);
		return $rs;
	}

	public function getAll()
	{
		$query = "SELECT id,nombre,apellido,compania FROM Cliente";
		$rows =  $this->_db->query($query);
		return $rows;
	}

	public function delete()
	{
		$query = sprintf("DELETE FROM Cliente WHERE id = %s", $this->_id);
		$rs =  $this->_db->query($query);
		return $rs;
	}

}
