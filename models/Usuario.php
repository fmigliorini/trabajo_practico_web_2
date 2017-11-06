<?php
require_once 'DataBase.php';
require_once 'ModelInterface.php';

class Usuario implements ModelInterface
{

    private $_id;
    private $_username;
    private $_password;
    private $_idEmployed;
    private $_idRol;
    private $_db;

    public function __construct( $id, $username, $password, $idEmployed, $idRol){
        $this->_db = DataBase::getInstance();
        $this->_id = $id;
        $this->_usuario = $username;
        $this->_password = $password;
        $this->_idEmployed = $idEmployed;
        $this->_idRol = $idRol;
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
        if(is_null($this->_id)) {
            $query = sprintf("INSERT INTO Usuario (usuario, password, id_empleado, id_rol) VALUES ('%s','%s','%s','%s')",
                            $this->_usuario,
                            md5($this->_password),
                            $this->_idEmployed,
                            $this->_idRol
                        );
        } else {
            $query = sprintf("UPDATE Usuario SET usuario = '%s, nombre = '%s', idRol = '%s' WHERE id = '%s'",
                            $this->_usuario,
                            $this->_nombre,
                            $this->_idRol,
                            $this->_id
                        );
        }
        echo $query;
        return  $this->_db->query($query);

    }

    /**
     * El cambio de clave no se va a hacer cunado se update el usuario
    **/
    static public function cambiarClave()
    {

    }

    // Creo que va a se mejor usar getters y setters porque sino se va a ser re vueltero todo :(
}

?>
