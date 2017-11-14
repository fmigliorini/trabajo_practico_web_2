<?php

require_once 'DataBase.php';
require_once 'ModelInterface.php';

class Modulo implements ModelInterface
{
    private $_id;
    private $_descripcion;
    private $_db;

    public function __construct($id = null,$descripcion = null)
    {
        $this->_id = $id;
        $this->_descripcion=$descripcion;
        $this->_db = DataBase::getInstance();
    }

    public function save()
    {
        if(is_null($this->_id)) {
            $query = "INSERT INTO Modulo(descripcion) VALUES ('$this->_descripcion');";
        } else {
            $query = "UPDATE Rol SET descripcion = '$this->_descripcion' WHERE id = $this->_id;";
        }
        $rs = $this->_db->query($query);

        return $rs;

    }

    public function getModulo()
    {
        $query = "SELECT id,descripcion FROM Modulo WHERE id = $this->_id;";
        $row = $this->_db->query($query);
        return $row;
    }

    public function getModulos()
    {
        $query = "SELECT id,descripcion FROM Modulo;";
        $rows = $this->_db->query($query);
        return $rows;
    }
//Query que Elimina todos los modulos
    public function removeModulo()
    {
        $query = "DELETE FROM Modulo WHERE id = $this->_id;";
        $rs = $this->_db->query($query);
        return $rs;
    }

//Query que Trae todos los modulos
    static public function getAll()
    {
        $db = DataBase::getInstance();
        $query = "SELECT * FROM Modulo";
        return $db->query($query);
    }

}

?>
