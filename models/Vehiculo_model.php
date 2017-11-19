<?php

require_once 'ModelInterface.php';
require_once 'DataBase.php';

class Vehiculo_model implements ModelInterface
{
	private $_db;
	private $_id = null;
	private $_patente;
	private $_estado;
	private $_marca;
	private $_nroChasis;
	private $_nroMotor;
	private $_fechaFabricacion;
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

	public function setMarca($_marca)
	{
		$this->_marca = $_marca;
	}

	public function getMarca()
	{
		return $this->_marca;
	}

	public function setNroChasis($_nroChasis)
	{
		$this->_nroChasis = $_nroChasis;
	}

	public function getNroChasis()
	{
		return $this->_nroChasis;
	}

	public function setNroMotor($_nroMotor)
	{
		$this->_nroMotor = $_nroMotor;
	}

	public function getNroMotor()
	{
		return $this->_nroMotor;
	}

	public function setFechaFabricacion($_fechaFabricacion)
	{
		$this->_fechaFabricacion = $_fechaFabricacion;
	}

	public function getFechaFabricacion()
	{
		return $this->_fechaFabricacion;
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
				$query = sprintf("INSERT INTO Vehiculo(patente, marca, nro_chasis, nro_motor, fecha_fabricacion, id_tipoVehiculo, id_estadoVehiculo) VALUES ('%s','%s','%s','%s','%s','%s','%s')", $this->_patente, $this->_marca, $this->_nroChasis,$this->_nroMotor,$this->_fechaFabricacion, $this->_tipo, $this->_estado);
		}
		else
		{
			//Update
			$query = sprintf("UPDATE Vehiculo SET patente = '%s', marca = '%s', nro_chasis = '%s', nro_motor = '%s', fecha_fabricacion = '%s', id_tipoVehiculo = '%s', id_estadoVehiculo = '%s' WHERE id = %s", $this->_patente, $this->_marca, $this->_nroChasis,$this->_nroMotor,$this->_fechaFabricacion, $this->_tipo, $this->_estado, $this->_id);
		}

		$rs = $this->_db->query($query);
		return $rs;
	}

	public function getAll()
	{
		$query = "SELECT v.id,v.patente,v.id_estadoVehiculo, v.id_tipoVehiculo,e.estado as estado, t.tipo as tipo, v.marca, v.nro_chasis, v.nro_motor, v.fecha_fabricacion
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

		static	public function getReporteDiasFueraDeServicio()
	{
		 $db = DataBase::getInstance();
		 $query = "SELECT v.id, v.marca, v.patente, v.fecha_fabricacion, sum(DATEDIFF(m.fecha_fin,m.fecha_inicio)) AS 'DiasInactivo'
				 FROM Vehiculo v JOIN Mantenimiento m
				 ON v.id=m.id_vehiculo
				 Group BY v.id , v.marca, v.patente";
		 return $db->query($query);
	}

		static	public function getReporteCostoMantenimiento()
	{
		 $db = DataBase::getInstance();
		 $query = "SELECT v.id, v.marca, v.patente, v.fecha_fabricacion,sum(m.costo) AS 'CostoMantenimiento'
				FROM Vehiculo v JOIN Mantenimiento m
				ON v.id=m.id_vehiculo
				Group BY v.id , v.marca, v.patente";
	   return $db->query($query);
	}

		static public function getReporteKilometrosRecorridos()
	{
		   $db = DataBase::getInstance();
			 $query = "SELECT v.id, v.marca, v.patente,v.fecha_fabricacion,MAX(m.kilometros) AS 'KilometrosRecorridos'
									FROM Vehiculo v JOIN Mantenimiento m ON v.id=m.id_vehiculo
									Group BY v.id , v.marca, v.patente";
	     return $db->query($query);
	}

	static public function getAllStatic()
	{
		  $db = DataBase::getInstance();
			$query = "SELECT *
					FROM Vehiculo ";
  		return $db->query($query);
	}

}
