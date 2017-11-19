<?php
require_once 'DataBase.php';
require_once 'ModelInterface.php';

class Servicio  implements ModelInterface
{

	private $_id;
	private $_descripcion;

	public function __construct($descripcion, $id=null){
	$this->_descripcion=$descripcion;
	}

	public function save (){
		if( is_null($this->_id))
		{
			insert();
		}
		else
		{
	  	update();
		}
	}

	static public function getAll(){
		$db = DataBase::getInstance();
		$query = "select * from Servicio";
		return $db->query($query);
	}

}

?>
