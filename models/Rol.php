<?php

require_once('Model.php');
require_once('ModelInterface.php');

class Rol extends Model implements ModelInterface
{
    private $_id;
    private $_descripcion;

    public function __construct($id = null,$descripcion = null)
    {
        $this->_id = $id;
        $this->_descripcion=$descripcion;
    }

    public function save()
    {
        if(is_null($this->_id))
        {
            $query = "INSERT INTO rol(descripcion) VALUES ('$this->_descripcion');";
            $rs = parent::query($query);
        }
        else
        {
            $query = "UPDATE rol SET descripcion = '$this->_descripcion' WHERE id = $this->_id;";
            $rs = parent::query($query);
        }

        return $rs;
        
    }

    public function getRol()
    {
        $query = "SELECT id,descripcion FROM rol WHERE id = $this->_id;";
        $row = parent::query($query);
        return $row;
    }

    public function getRoles()
    {
        $query = "SELECT id,descripcion FROM rol;";
        $rows = parent::query($query);
        return $rows;
    }

    public function removeRol()
    {
        $query = "DELETE FROM rol WHERE id = $this->_id;";
        $rs = parent::query($query);

        if($rs) 
        {
            header('location: index.php?page=roles');
            die;
        }
    }
   
}



?>
