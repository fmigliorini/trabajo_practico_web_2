<?php 

class Vehiculo extends model
{

private $_id;
private $_patente;
//private $_idIipoVehiculo;
//private $_idEstado;

public function __construct($patente ,$id=null)
{
	$this->_patente=$patente;	
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