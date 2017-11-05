<?php
require_once 'DataBase.php';
require_once 'ModelInterface.php';

class Usuario implements ModelInterface
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
    static public function login ($usuario, $clave)
    {
        // hash password to md5??
        $hashClave = md5($clave);
        $buscarUsuario = "SELECT 1 FROM Usuario WHERE usuario = '$usuario' and password = '$hashClave'";
        $dataBase = DataBase::getInstance();

        if ( $dataBase->query($buscarUsuario) )
            return true;

        return false;
    }

    public function save()
    {
        
    }

    // Creo que va a se mejor usar getters y setters porque sino se va a ser re vueltero todo :(
}

?>
