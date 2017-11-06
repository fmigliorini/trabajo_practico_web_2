<?php

require_once 'ModelInterface.php';
require_once 'Database.php';

class Empleado implements ModelInterface
{
	private $_db;
	private $_id;
	private $_name;
	private $_surname;
	private $_dni;
	private $_phone;

	public function __construct($id=null, $name, $surname, $dni, $phone )
	{
		$this->_db = DataBase::getInstance();
		$this->_id = $id;
		$this->_name = $name;
		$this->_surname = $surname;
		$this->_dni = $dni;
		$this->_phone = $phone;
	}


	public function save()
    {
        if(is_null($this->_id)) {
            $query = sprintf("INSERT INTO Empleado (nombre,apellido,dni,telefono) VALUES ('%s','%s','%s','%s')",
                            $this->_name,
                            $this->_surname,
                            $this->_dni,
							$this->_phone
                        );
        } else {
            $query = sprintf("UPDATE Usuario SET nombre = '%s, apellido = '%s', dni = '%s', telefono = '%s' WHERE id = '%s'",
                            $this->_nombre,
                            $this->_apellido,
                            $this->_dni,
							$this->_phone,
							$this->_id
                        );
        }
        return  $this->_db->query($query);
    }

}

?>
