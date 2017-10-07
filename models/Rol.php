<?php

require_once('./Model.php');
require_once('./ModelInterface.php');

class Rol extends Model implements ModelInterface
{

    private $_id = null;
    private $_descripcion;

    public function __construct($descripcion)
    {
	    $this->_descripcion=$descripcion;
    }

	static public function find($id)
	{
        $select = sprintf("SELECT * FROM Rol where id = %d", 
			$id
		);
        if( $buscarRol = parent::query($select) ) {

            $rol = new static( $rol['descripcion'], $rol['id'] );

            // var_dump sirve para debuf y muestra el contenido de una variable
            var_dump($rol);
        }
    }

    public function save()
    {
        if ( $this->_id  ) {
            $update = sprintf("UPDATE Rol SET descripcion = '%s' WHERE id = '%d';",
               	$this->_descripcion,
				$this->_id
            );
           if ( parent::query($update) ) {
                echo "ROL ACTUALIZADO CORRECTAMENTE";
           }
        } else {
           	$insert = sprintf("INESRT Rol (descripcion) VALUES (%s);",
				$this->_descripcion
			);
            if( $id = parent::query($insert) ) {
                echo $id;
            }
		}
    }

}



?>
