<?php 

Class Model {
	private $_mysqli ;
	const  HOST;
	const USUARIO;
	const PASSWORD;
	const DB;
	
	private function _connect(){
		
		$this->_mysqli = mysqli_connect(HOST,USUARIO,PASSWORD,DB,3306);
	}
	
	private function _close(){
		$this->_mysqli->disconnect();
	}
	
	private function execQuery($query){
		$this->_connect();
		$res= $this->_mysqli->query($query);
		$this->_close();
		return  $res ;
	}
}

?>