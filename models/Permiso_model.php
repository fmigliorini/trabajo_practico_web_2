<?php

require_once 'DataBase.php';
require_once 'ModelInterface.php';

class Permiso implements ModelInterface
{
    private $_id;
    private $_id_Rol;
    private $_id_Modulo;
    private $_db;

    public function __construct()
    {
        $this->_db = DataBase::getInstance();
    }

    public function save()
    {
        $query = "INSERT INTO Permiso(id_Rol , id_Modulo) VALUES ('$this->_id_Rol','$this->_id_Modulo');";
        echo $query;
        return $this->_db->query($query);
    }

    public function getPerimisoById ()
    {
        $query = "SELECT id_Rol,id_Modulo FROM Permiso WHERE id = $this->_id;";
        $row = $this->_db->query($query);
        return $row;
    }

    static public function removePerimiso($id)
    {
        $rs = $this->_db->query($query);
        return $rs;
    }

    static public function getAll()
    {
        $db = DataBase::getInstance();
            $query = "select p.id as id, id_modulo as moduloId, m.descripcion as moduloDescripcion, r.id as rolId, r.descripcion as rolDescripcion  from Permiso p INNER JOIN Rol r ON r.id = p.id_rol INNER JOIN Modulo m ON m.id = p.id_modulo";
        return $db->query($query);
    }



    // PERMISOS GETTERS Y SETTERS

    /**
     * Get the value of Id
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * Set the value of Id
     *
     * @param mixed _id
     *
     * @return self
     */
    public function setId($_id)
    {
        $this->_id = $_id;

        return $this;
    }

    /**
     * Get the value of Id Rol
     *
     * @return mixed
     */
    public function getIdRol()
    {
        return $this->_id_Rol;
    }

    /**
     * Set the value of Id Rol
     *
     * @param mixed _id_Rol
     *
     * @return self
     */
    public function setIdRol($_id_Rol)
    {
        $this->_id_Rol = $_id_Rol;

        return $this;
    }

    /**
     * Get the value of Id Modulo
     *
     * @return mixed
     */
    public function getIdModulo()
    {
        return $this->_id_Modulo;
    }

    /**
     * Set the value of Id Modulo
     *
     * @param mixed _id_Modulo
     *
     * @return self
     */
    public function setIdModulo($_id_Modulo)
    {
        $this->_id_Modulo = $_id_Modulo;

        return $this;
    }

}

?>
