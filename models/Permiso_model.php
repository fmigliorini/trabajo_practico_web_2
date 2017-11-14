<?php

require_once 'DataBase.php';
require_once 'ModelInterface.php';

class Perimisos implements ModelInterface
{
    private $_id;
    private $_id_Rol;
    private $_id_Modulo;
    private $_db;

    public function __construct($id_Rol = null,$id_Modulo = null,$id = null)
    {
        $this->_id =id;
        $this->_id_Rol =id_Rol;
        $this->_id_Modulo=id_Modulo;
        $this->_db = DataBase::getInstance();
    }

    public function save()
    {
        if(is_null($this->_id_Modulo)) {
            $query = "INSERT INTO Perimisos(id_Rol , id_Modulo) VALUES ('$this->_id_Rol','$this->_id_Modulo');";
        } else {
            $query = "UPDATE Perimisos SET id_Rol = '$this->_id_Rol' AND id_Modulo = '$this->_id_Modulo' WHERE id = $this->_id;";
        }
        $rs = $this->_db->query($query);

        return $rs;

    }

    public function getPerimiso()
    {
        $query = "SELECT id_Rol,id_Modulo FROM Perimisos WHERE id = $this->_id;";
        $row = $this->_db->query($query);
        return $row;
    }

    public function getPerimisos()
    {
        $query = "SELECT id_Rol,id_Modulo FROM Perimisos;";
        $rows = $this->_db->query($query);
        return $rows;
    }
//Query que Elimina todos los modulos
    public function removePerimiso()
    {
        $query = "DELETE FROM Perimisos WHERE id = $this->_id;";
        $rs = $this->_db->query($query);
        return $rs;
    }

//Query que Trae todos los modulos (id , id)
    static public function getAll()
    {
        $db = DataBase::getInstance();
        $query = "SELECT * FROM Perimisos";
        return $db->query($query);
    }

}

?>
