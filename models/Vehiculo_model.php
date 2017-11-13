<?php 

require_once 'ModelInterface.php';
require_once 'DataBase.php';

class Vehiculo_model implements ModelInterface
{
	private $_db;
	private $_id = null;
	private $_patente;
	private $_estado;
	private $_tipo;

	public function __construct()
	{
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

	public function setPatente($patente)
	{
		$this->_patente = $patente;
	}

	public function getPatente()
	{
		return $this->_patente;
	}

	public function setEstado($estado)
	{
		$this->_estado = $estado;
	}

	public function getEstado()
	{
		return $this->_estado;
	}

	public function setTipo($tipo)
	{
		$this->_tipo = $tipo;
	}

	public function getTipo()
	{
		return $this->_tipo;
	}

	private function verifyPatente()
	{
		$query = sprintf("SELECT id FROM Vehiculo WHERE patente = '%s'", $this->_patente);
		$rs = $this->_db->query($query);
		return $rs;
	}

	public function save()
	{	
		$existPatente = $this->verifyPatente();

		if( is_null($this->_id) )
		{
			//Insert	
			if(isset($existPatente[0]->id) && $existPatente[0]->id != '')
				return false;
			else
				$query = sprintf("INSERT INTO Vehiculo(patente, tipo, estado) VALUES ('%s', '%s', '%s')", $this->_patente, $this->_tipo, $this->_estado);
		}
		else
		{
			//Update
			$query = sprintf("UPDATE Vehiculo SET patente = '%s', tipo = '%s', estado = '%s' WHERE id = %s", $this->_patente, $this->_tipo, $this->_estado, $this->_id);
		}

		$rs = $this->_db->query($query);
		return $rs;
	}

	public function getAll()
	{
		$query = "SELECT id,patente,tipo,estado FROM Vehiculo";
		$rows =  $this->_db->query($query);
		return $rows;
	}

	public function delete()
	{
		$query = sprintf("DELETE FROM Vehiculo WHERE id = %s", $this->_id);
		$rs =  $this->_db->query($query);
		return $rs;
	}

}