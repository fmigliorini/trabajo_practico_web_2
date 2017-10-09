<?php
require 'Model.php';

class Usuario extends Model
{

    private $_id;
    private $_usuario;
    private $_password;
    // private $_nombre;
    // private $_apellido;
    //private $_idRol;

    public function __construct(){
        parent::__construct();
    }

    /**
    * Esta función busca si existe un usuario por usuario y clave
    * @param $usuario   String
    * @param $clave     String
    * @return   Boolean
    **/
    public function login ($usuario, $clave)
    {
        // hash password to md5??
        $hashClave = md5($clave);
        $buscarUsuario = "SELECT 1 FROM Usuario WHERE usuario = '$usuario' and password = '$hashClave'";
        if ( parent::query($buscarUsuario) )
            return true;

        return false;
    }


    // Creo que va a se mejor usar getters y setters porque sino se va a ser re vueltero todo :(
}

?>
