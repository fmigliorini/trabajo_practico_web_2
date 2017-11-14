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
				$query = sprintf("INSERT INTO Vehiculo(patente, id_tipoVehiculo, id_estadoVehiculo) VALUES ('%s', '%s', '%s')", $this->_patente, $this->_tipo, $this->_estado);
		}
		else
		{
			//Update
			$query = sprintf("UPDATE Vehiculo SET patente = '%s', id_tipoVehiculo = '%s', id_estadoVehiculo = '%s' WHERE id = %s", $this->_patente, $this->_tipo, $this->_estado, $this->_id);
		}

		$rs = $this->_db->query($query);
		return $rs;
	}

	public function getAll()
	{
		$query = "SELECT v.id,v.patente,v.id_estadoVehiculo, v.id_tipoVehiculo,e.estado as estado, t.tipo as tipo
				FROM Vehiculo v
				JOIN estadoVehiculo e ON v.id_estadoVehiculo = e.id_estado
				JOIN tipoVehiculo t ON v.id_tipoVehiculo = t.id_tipo";
		$rows =  $this->_db->query($query);
		return $rows;
	}

	public function delete()
	{
		$query = sprintf("DELETE FROM Vehiculo WHERE id = %s", $this->_id);
		$rs =  $this->_db->query($query);
		return $rs;
	}

	public function getTipoVehiculo()
	{
		$query = "SELECT id_tipo,tipo FROM tipoVehiculo";
		$rows =  $this->_db->query($query);
		return $rows;
	}

	public function getEstadoVehiculo()
	{
		$query = "SELECT id_estado,estado FROM estadoVehiculo";
		$rows =  $this->_db->query($query);
		return $rows;
	}

}