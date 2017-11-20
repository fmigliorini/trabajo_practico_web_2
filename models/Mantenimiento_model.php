<?php
require_once 'ModelInterface.php';
require_once 'DataBase.php';
class Mantenimiento implements ModelInterface
{
private $_db;
private $_id;
private $_fechaInicio;
private $_horaInicio;
private $_horaFin;
private $_fechaFin;
private $_costo;
private $_kilometros;
private $_id_servicio ;
private $_id_vehiculo;
private $_mecanico ;
private $_repuestoCambiado;
private $_externo ;


public function __construct( ){
		$this->_db = DataBase::getInstance();
}


public function save()
{
	if(is_null($this->_id)) {
	$query = sprintf("INSERT INTO Mantenimiento(fecha_inicio, hora_inicio,kilometros, costo , id_servicio,id_vehiculo, mecanico, repuestoCambiado, externo)
    										VALUES ('%s','%s','%d','%d','%s','%s','%s','%s','%s')",
    		$this->_fechaInicio,
    		$this->_horaInicio,
    		$this->_kilometros,
    		$this->_costo,
    		$this->_id_servicio ,
    		$this->_id_vehiculo,
    		$this->_mecanico,
    		$this->_repuestoCambiado,
    		$this->_externo);
		} else {
				$query = sprintf("UPDATE Mantenimiento SET fecha_fin= '%s',hora_fin= '%s', costo= '%d' , mecanico= '%s', repuestoCambiado = '%s' WHERE id = '%s'",
				$this->_fechaFin,
				$this->_horaFin,
				$this->_costo,
				$this->_mecanico,
				$this->_repuestoCambiado,
				$this->_id
			);
		}
        echo $query;
		$res = $this->_db->query($query);
		return $res;

}

static public function getById($id)
{
		// buscar en db;
		$db = DataBase::getInstance();
		$query = "SELECT * FROM Mantenimiento WHERE id = '$id'";
		$res = $db->query($query);

		return $res;
}

//Query que Trae todos los mantenimientos
    static public function getAll()
    {
        $db = DataBase::getInstance();
        $query = "SELECT * FROM Mantenimiento";
        return $db->query($query);
    }
public function removeMantenimiento()
{
		$query = "DELETE FROM Mantenimiento WHERE id = $this->_id;";
		$rs = $this->_db->query($query);
		return $rs;
}
/**
 * Get the value of Db
 *
 * @return mixed
 */
public function getDb()
{
		return $this->_db;
}

/**
 * Set the value of Db
 *
 * @param mixed _db
 *
 * @return self
 */
public function setDb($_db)
{
		$this->_db = $_db;

		return $this;
}

/**
 * Get the value of Id
 *
 * @return mixed
 */
public function getId()
{
		return $this->_id;
}

/**
 * Set the value of Id
 *
 * @param mixed _id
 *
 * @return self
 */
public function setId($_id)
{
		$this->_id = $_id;

		return $this;
}



public function getFechaInicio()
{
		return $this->_fechaInicio;
}

/**
 * Set the value of Id
 *
 * @param mixed _id
 *
 * @return self
 */
public function setFechaInicio($_fechaInicio)
{
		$this->_fechaInicio = $_fechaInicio;

		return $this;
}


public function getHoraInicio()
{
		return $this->_horaInicio;
}

/**
 * Set the value of Id
 *
 * @param mixed _id
 *
 * @return self
 */
public function setHoraInicio($_horaInicio)
{
		$this->_horaInicio = $_horaInicio;

		return $this;
}


public function getFechaFin()
{
		return $this->_fechaFin;
}

/**
 * Set the value of Id
 *
 * @param mixed _id
 *
 * @return self
 */
public function setFechaFin($_fechaFin)
{
		$this->_fechaFin = $_fechaFin;

		return $this;
}
public function getHoraFin()
{
		return $this->_horaFin;
}

/**
 * Set the value of Id
 *
 * @param mixed _id
 *
 * @return self
 */
public function setHoraFin($_horaFin)
{
		$this->_horaFin = $_horaFin;
		return $this;
}



public function getCosto()
{
		return $this->_costo;
}

/**
 * Set the value of Id
 *
 * @param mixed _id
 *
 * @return self
 */
public function setCosto($_costo)
{
		$this->_costo = $_costo;

		return $this;
}




public function getKilometros()
{
		return $this->_kilometros;
}

/**
 * Set the value of Id
 *
 * @param mixed _id
 *
 * @return self
 */
public function setKilometros($_kilometros)
{
		$this->_kilometros = $_kilometros;

		return $this;
}


public function getIdServicio()
{
		return $this->_id_servicio;
}

/**
 * Set the value of Id
 *
 * @param mixed _id
 *
 * @return self
 */
public function setIdServicio($_id_servicio)
{
		$this->_id_servicio = $_id_servicio;

		return $this;
}


public function getIdVehiculo()
{
		return $this->_id_vehiculo;
}

/**
 * Set the value of vehiculo
 *
 * @param mixed _id_vehiculo
 *
 * @return self
 */
public function setIdVehiculo($_id_vehiculo)
{
		$this->_id_vehiculo = $_id_vehiculo;

		return $this;
}



public function getMecanico()
{
		return $this->_mecanico;
}

/**
 * Set the value of Id
 *
 * @param mixed _id
 *
 * @return self
 */
public function setMecanico($_mecanico)
{
		$this->_mecanico = $_mecanico;

		return $this;
}




public function getRepuestoCambiado()
{
		return $this->_repuestoCambiado;
}

/**
 * Set the value of repuestoCambiado
 *
 * @param mixed _repuestoCambiado
 *
 * @return self
 */
public function setRepuestoCambiado($_repuestoCambiado)
{
		$this->_repuestoCambiado = $_repuestoCambiado;

		return $this;
}


public function getExterno()
{
		return $this->_externo;
}

/**
 * Set the value of repuestoCambiado
 *
 * @param mixed _repuestoCambiado
 *
 * @return self
 */
public function setExterno($_externo)
{
		$this->_externo = $_externo;

		return $this;
}
}
?>
