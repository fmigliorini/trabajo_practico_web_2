<?php

require_once 'DataBase.php';
require_once 'ModelInterface.php';

class Rol implements ModelInterface
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
            $query = "INSERT INTO Rol(descripcion) VALUES ('$this->_descripcion');";
        } else {
            $query = "UPDATE Rol SET descripcion = '$this->_descripcion' WHERE id = $this->_id;";
        }
        $rs = $this->_db->query($query);

        return $rs;

    }

    public function getRol()
    {
        $query = "SELECT id,descripcion FROM Rol WHERE id = $this->_id;";
        $row = $this->_db->query($query);
        return $row;
    }

    public function getRoles()
    {
        $query = "SELECT id,descripcion FROM Rol;";
        $rows = $this->_db->query($query);
        return $rows;
    }

    public function removeRol()
    {
        $query = "DELETE FROM Rol WHERE id = $this->_id;";
        $rs = $this->_db->query($query);
        return $rs;
    }


    static public function getAll()
    {
        $db = DataBase::getInstance();
        $query = "select * from Rol";
        return $db->query($query);
    }

}



?>
