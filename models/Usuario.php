<?php 

class Usuario extends model
{

    private $_id;
    private $_usuario;
    private $_password;
    //private $_idRol;
    
    public function __construct($usuario ,$password, $id=null){
	
    	$this->_usuario=$usuario;
    	$this->_password=$password;
    }


    public function save (){
	
    	if( is_null($this->_id) {
    	    
        }else{
	    
        }
    }

}

?>
