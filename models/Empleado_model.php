<?php

require_once 'ModelInterface.php';
require_once 'DataBase.php';

class Empleado implements ModelInterface
{
	private $_db;
	private $_id;
	private $_nombre;
	private $_apellido;
	private $_dni;
	private $_telefono;

	public function __construct()
	{
		$this->_db = DataBase::getInstance();
	}


	public function save()
    {
        if(is_null($this->_id)) {
            $query = sprintf("INSERT INTO Empleado (nombre,apellido,numeroDocumento,telefono) VALUES ('%s','%s','%s','%s')",
                            $this->_nombre,
                            $this->_apellido,
                            $this->_dni,
							$this->_telefono
                        );
        } else {
            $query = sprintf("UPDATE Empleado SET nombre = '%s', apellido = '%s', numeroDocumento = '%s', telefono = '%s' WHERE id = '%s'",
                            $this->_nombre,
                            $this->_apellido,
                            $this->_dni,
							$this->_telefono,
							$this->_id
                        );

        }
        return  $this->_db->query($query);
    }


    static public function getById($id)
    {
        // buscar en db;
        $db = DataBase::getInstance();
        $query = "SELECT * FROM Empleado WHERE id = '$id'";
        $res = $db->query($query);
        if ( count($res) === 1 ) {
            $empleado = new Empleado();
            $empleado->setId($res[0]->id);
            $empleado->setNombre($res[0]->nombre);
            $empleado->setApellido($res[0]->apellido);
            $empleado->setDni($res[0]->numeroDocumento);
            $empleado->setTelefono($res[0]->telefono);
            return $empleado;
        }
        return false;
    }

    static public function getAll()
    {
        $db = DataBase::getInstance();
        $query = "SELECT * FROM Empleado";
        return $db->query($query);
    }

    static public function getEmpleadoSinUsuario()
    {
        $db = DataBase::getInstance();
        $query = "SELECT * FROM Empleado e LEFT JOIN Usuario u ON u.id_empleado = e.id WHERE u.id_empleado IS NULL";
        return $db->query($query);
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
    public function getNombre()
    {
        return $this->_nombre;
    }

    /**
     * Set the value of Nombre
     *
     * @param mixed _nombre
     *
     * @return self
     */
    public function setNombre($_nombre)
    {
        $this->_nombre = $_nombre;

        return $this;
    }

    /**
     * Get the value of Apellido
     *
     * @return mixed
     */
    public function getApellido()
    {
        return $this->_apellido;
    }

    /**
     * Set the value of Apellido
     *
     * @param mixed _apellido
     *
     * @return self
     */
    public function setApellido($_apellido)
    {
        $this->_apellido = $_apellido;

        return $this;
    }

    /**
     * Get the value of Dni
     *
     * @return mixed
     */
    public function getDni()
    {
        return $this->_dni;
    }

    /**
     * Set the value of Dni
     *
     * @param mixed _dni
     *
     * @return self
     */
    public function setDni($_dni)
    {
        $this->_dni = $_dni;

        return $this;
    }

    /**
     * Get the value of Telefono
     *
     * @return mixed
     */
    public function getTelefono()
    {
        return $this->_telefono;
    }

    /**
     * Set the value of Telefono
     *
     * @param mixed _telefono
     *
     * @return self
     */
    public function setTelefono($_telefono)
    {
        $this->_telefono = $_telefono;

        return $this;
    }

}

?>
