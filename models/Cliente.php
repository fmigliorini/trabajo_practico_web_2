<?php 

class Cliente extends model
{

private $_id;
private $_nombre;
private $_apellido;
private $_compania;

public function __construct($nombre ,$apellido, $compania ,$id=null){
	
	$this->_nombre=$nombre;
	$this->_apellido=$apellido;
	$this->_compania=$compania;
	
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