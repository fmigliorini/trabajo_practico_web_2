<?php

class Usuario extends Model
{

    private $_id;
    private $_usuario;
    private $_password;
    private $_nombre;
    private $_apellido;
    //private $_idRol;

    public function __construct($usuario ,$password, $nombre, $apellido, $id=null){

    	$this->_usuario = $usuario;
    	$this->_password = $password;
        $this->_nombre = $nombre;
        $this->_apellido = $apellido;
    }

    /**
    * Esta función busca si existe un usuario y clave
    **/
    static public function login ($usuario, $clave){


    }

    public function save (){

    	if( is_null($this->_id) {

        }else{

        }
    }

}

?>
