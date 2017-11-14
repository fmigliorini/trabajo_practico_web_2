<?php

require_once 'DataBase.php';
require_once 'ModelInterface.php';

class Permiso implements ModelInterface
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
            $query = "INSERT INTO Permiso(id_Rol , id_Modulo) VALUES ('$this->_id_Rol','$this->_id_Modulo');";
        } else {
            $query = "UPDATE Permiso SET id_Rol = '$this->_id_Rol' AND id_Modulo = '$this->_id_Modulo' WHERE id = $this->_id;";
        }
        $rs = $this->_db->query($query);

        return $rs;

    }

    public function getPermiso()
    {
        $query = "SELECT id_Rol,id_Modulo FROM Permiso WHERE id = $this->_id;";
        $row = $this->_db->query($query);
        return $row;
    }

    public function getPermisos()
    {
        $query = "SELECT id_Rol,id_Modulo FROM Permiso;";
        $rows = $this->_db->query($query);
        return $rows;
    }
//Query que Elimina todos los modulos
    public function removePermiso()
    {
        $query = "DELETE FROM Permiso WHERE id = $this->_id;";
        $rs = $this->_db->query($query);
        return $rs;
    }

//Query que Trae todos los modulos (id , id)
    static public function getAll()
    {
        $db = DataBase::getInstance();
        $query = "SELECT * FROM Permiso;";
        return $db->query($query);
    }

    public function getPermiso()
    {
        $query = "SELECT id_Rol,id_Modulo FROM Permiso WHERE id = $this->_id;";
        $row = $this->_db->query($query);
        return $row;
    }
}

static public function getById($id)
{
    // buscar en db;
    $db = DataBase::getInstance();
    $query = "SELECT * FROM Permiso WHERE id = '$id'";
    $res = $db->query($query);
    return $res;
}

/**
 * Get the value of Db
 *
 * @return mixed
 */
public function getDb()
{
		return $this->_db;
}

/**
 * Set the value of Db
 *
 * @param mixed _db
 *
 * @return self
 */
public function setDb($_db)
{
		$this->_db = $_db;

		return $this;
}
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
 * Get the value of Nombre
 *
 * @return mixed
 */
public function getRol()
{
    return $this->_id_Rol;
}

/**
 * Set the value of Nombre
 *
 * @param mixed _nombre
 *
 * @return self
 */
public function setRol($_id_Rol)
{
    $this->_id_Rol = $_id_Rol;

    return $this;
}

/**
 * Get the value of Apellido
 *
 * @return mixed
 */
public function getModulo()
{
    return $this->_id_Modulo;
}

/**
 * Set the value of Apellido
 *
 * @param mixed _apellido
 *
 * @return self
 */
public function setModulo($_id_Modulo)
{
    $this->_id_Modulo = $_id_Modulo;

    return $this;
}
?>
