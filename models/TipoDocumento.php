<?php 

class TipoDocumento extends model
{

private $_id;
private $_descripcion;

public function __construct($descripcion, $id=null){
	
	$this->_descripcion=$descripcion;
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