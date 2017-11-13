<?php 

require_once 'ModelInterface.php';
require_once 'DataBase.php';

class Viaje_model implements ModelInterface
{
	private $_db;
	private $_id;
	private $_descripcion;
	private $_origen;
	private $_destino;
	private $_fechaInicio;
	private $_fechaFin;
	private $_tiempoEstimado;
	private $_tiempoReal;
	private $_desviacion;
	private $_combustibleEstimado;
	private $_idCliente;
	private $_idChofer;
	private $_idVehiculo;

	public function __construct(){
		$this->_db = DataBase::getInstance();
	}

	public function get_id(){
		return $this->_id;
	}

	public function set_id($_id){
		$this->_id = $_id;
	}

	public function get_descripcion(){
		return $this->_descripcion;
	}

	public function set_descripcion($_descripcion){
		$this->_descripcion = $_descripcion;
	}

	public function get_origen(){
		return $this->_origen;
	}

	public function set_origen($_origen){
		$this->_origen = $_origen;
	}

	public function get_destino(){
		return $this->_destino;
	}

	public function set_destino($_destino){
		$this->_destino = $_destino;
	}

	public function get_fechaInicio(){
		return $this->_fechaInicio;
	}

	public function set_fechaInicio($_fechaInicio){
		$this->_fechaInicio = $_fechaInicio;
	}

	public function get_fechaFin(){
		return $this->_fechaFin;
	}

	public function set_fechaFin($_fechaFin){
		$this->_fechaFin = $_fechaFin;
	}

	public function get_tiempoEstimado(){
		return $this->_tiempoEstimado;
	}

	public function set_tiempoEstimado($_tiempoEstimado){
		$this->_tiempoEstimado = $_tiempoEstimado;
	}

	public function get_desviacion(){
		return $this->_desviacion;
	}

	public function set_desviacion($_desviacion){
		$this->_desviacion = $_desviacion;
	}

	public function get_tiempoReal(){
		return $this->_tiempoReal;
	}

	public function set_tiempoReal($_tiempoReal){
		$this->_tiempoReal = $_tiempoReal;
	}

	public function get_combustibleEstimado(){
		return $this->_combustibleEstimado;
	}

	public function set_combustibleEstimado($_combustibleEstimado){
		$this->_combustibleEstimado = $_combustibleEstimado;
	}

	public function get_idCliente(){
		return $this->_idCliente;
	}

	public function set_idCliente($_idCliente){
		$this->_idCliente = $_idCliente;
	}

	public function get_idChofer(){
		return $this->_idChofer;
	}

	public function set_idChofer($_idChofer){
		$this->_idChofer = $_idChofer;
	}

	public function get_idVehiculo(){
		return $this->_idVehiculo;
	}

	public function set_idVehiculo($_idVehiculo){
		$this->_idVehiculo = $_idVehiculo;
	}

    public function getChoferes()
    {
    	$query = "SELECT id,nombre,apellido FROM Empleado WHERE id IN (SELECT id_empleado
    																		FROM Usuario
    																		WHERE estado = 'activo'
    																		AND id_rol = (SELECT id
    																						FROM Rol
    																						WHERE descripcion = 'Chofer'));";
    	$rows = $this->_db->query($query);
    	return $rows;
    }

    public function getClientes()
    {
    	$query = "SELECT id,nombre,apellido,compania FROM Cliente";
    	$rows = $this->_db->query($query);
    	return $rows;
    }

    public function getVehiculos()
    {
    	$query = "SELECT id,patente FROM Vehiculo";
    	$rows = $this->_db->query($query);
    	return $rows;
    }

	public function save (){
		
		if( is_null($this->_id) )
		{
			$query = sprintf("INSERT INTO viaje(descripcion,origen,destino,fecha_inicio,fecha_fin,tiempo_estimado,tiempo_real,desviacion,combustible_estimado,id_cliente,id_vehiculo,id_chofer) 
							VALUES ('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s')", $this->_descripcion, $this->_origen, $this->_destino, $this->_fechaInicio, $this->_fechaFin, $this->_tiempoEstimado, $this->_tiempoReal, $this->_desviacion, $this->_combustibleEstimado,$this->_idCliente, $this->_idVehiculo, $this->_idChofer);		
		}
		else
		{
		  $query = sprintf("UPDATE viaje SET descripcion = '%s',origen= '%s',destino= '%s',fecha_inicio= '%s',fecha_fin= '%s',tiempo_estimado= '%s',tiempo_real= '%s',desviacion= '%s',combustible_estimado= '%s',id_cliente= '%s',id_vehiculo= '%s',id_chofer= '%s' WHERE id = '%s'", $this->_descripcion, $this->_origen, $this->_destino, $this->_fechaInicio, $this->_fechaFin, $this->_tiempoEstimado, $this->_tiempoReal, $this->_desviacion, $this->_combustibleEstimado,$this->_idCliente, $this->_idVehiculo, $this->_idChofer, $this->_id);	
		}

		$rs = $this->_db->query($query);
		return $rs;
	}

	public function getAll()
	{
		$query = "SELECT v.id,descripcion,origen,destino,fecha_inicio,fecha_fin,tiempo_estimado,tiempo_real,desviacion,combustible_estimado,id_cliente,id_vehiculo,id_chofer, c.nombre as nombre_cliente, c.apellido as apellido_cliente,e.nombre as nombre_chofer,e.apellido as apellido_chofer, vh.patente
		FROM viaje v
		JOIN cliente c ON c.id = v.id_cliente
		JOIN empleado e ON e.id = v.id_chofer
		JOIN vehiculo vh ON vh.id = v.id_vehiculo;";

		$rows = $this->_db->query($query);
		return $rows;
	}

	public function delete()
	{
		$query = sprintf("DELETE FROM viaje WHERE id = %s", $this->_id);
		$rs =  $this->_db->query($query);
		return $rs;
	}

}
