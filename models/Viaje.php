<?php 

class Viaje extends model
{

private $_id;
private $_descripcion;
private $_origen;
private $_destino;
private $_fechaInicio;
private $_fechaFin;
private $_tiempoEstimado;
private $_desviacion;
private $_combustibleReal;
private $_combustibleEstimado;
//private $_idCliente;
//private $_idChofer;
//private $_idVehiculo;

public function __construct($descripcion , $origen, $destino , $fechaInicio,$fechaFin, $tiempoEstimado, $desviacion , $combustibleReal, $combustibleEstimado , $id=null){
	
	$this->_descripcion=$descripcion;
	$this->_origen=$origen;
	$this->_destino=$destino;
	$this->_fechaInicio=$fechaInicio;
    $this->_fechaFin=$fechaFin;
	$this->_tiempoEstimado=$tiempoEstimado;
	$this->_desviacion=$desviacion;
	$this->_combustibleEstimado=$combustibleEstimado;
	$this->_combustibleReal=$combustibleReal;
}


public function save (){
	
	if( is_null($this->_id)
	{
		insert();		
	}
else
	{
	  update();
	}
}

}

?>