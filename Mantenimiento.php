<?php 

class Mantenimiento extends model
{

private $_id;
private $_fechaInicio;
private $_fechaFin;
private $_costo;
//private $_idServicio;
//private $_idVehiculo;

public function __construct($fechaInicio,$fechaFin, $costo , $id=null){
	
	$this->_fechaInicio=$fechaInicio;
    $this->_fechaFin=$fechaFin;
	$this->_costo=$costo;
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