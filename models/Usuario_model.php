<?php
require_once 'DataBase.php';
require_once 'ModelInterface.php';

class Usuario implements ModelInterface
{
    private $_db;

    private $_id;
    private $_usuario;
    private $_clave;
    private $_idEmpleado;
    private $_idRol;
    private $_estado;

    public function __construct( ){
        $this->_db = DataBase::getInstance();
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
                            md5($this->_clave),
                            $this->_idEmployed,
                            $this->_idRol
                        );
        } else {
            $query = sprintf("UPDATE Usuario SET usuario = '%s, idRol = '%s' WHERE id = '%s'",
                            $this->_usuario,
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

    static public function desactivar($id)
    {
        $db = DataBase::getInstance();
        $query = sprintf("UPDATE Usuario SET estado = 'inactivo' WHERE id = '%s' "
                        ,$id
                    );
        return  $db->query($query);
    }

    static public function activar($id)
    {
        $db = DataBase::getInstance();
        $query = sprintf("UPDATE Usuario SET estado = 'activo' WHERE id = '%s' "
                        ,$id
                    );
        return  $db->query($query);
    }

    static public function getAll()
    {
        $db = DataBase::getInstance();
        $query = "SELECT u.id, u.usuario, u.estado, r.id as rol_id, r.descripcion as rol_descripcion, e.nombre as empleado_nombre, e.apellido as empleado_apellido, e.numeroDocumento as empleado_numero_documento, e.telefono as empleado_telefono FROM Usuario u INNER JOIN Empleado e ON u.id_empleado = e.id INNER JOIN Rol r ON u.id_rol = r.id";
        return $db->query($query);
    }

    static public function getById($id)
    {
        // buscar en db;
        $db = DataBase::getInstance();
        $query = "SELECT * FROM Usuario WHERE id = '$id'";
        $res = $db->query($query);
        if ( count($res) === 1 ) {
            $usuario = new Usuario();
            $usuario->setUsername($res[0]->usuario);
            $usuario->setClave($res[0]->clave);
            $usuario->setIdEmpleado($res[0]->idEmpleado);
            $usuario->setIdRol($res[0]->idRol);
            return $usuario;
        }
        return false;;
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
     * Get the value of Usuario
     *
     * @return mixed
     */
    public function getUsuario()
    {
        return $this->_usuario;
    }

    /**
     * Set the value of Usuario
     *
     * @param mixed _usuario
     *
     * @return self
     */
    public function setUsuario($_usuario)
    {
        $this->_usuario = $_usuario;

        return $this;
    }

    /**
     * Set the value of Clave
     *
     * @param mixed _clave
     *
     * @return self
     */
    public function setClave($_clave)
    {
        $this->_clave = md5($_clave);

        return $this;
    }

    /**
     * Get the value of Id Empleado
     *
     * @return mixed
     */
    public function getIdEmpleado()
    {
        return $this->_idEmpleado;
    }

    /**
     * Set the value of Id Empleado
     *
     * @param mixed _idEmpleado
     *
     * @return self
     */
    public function setIdEmpleado($_idEmpleado)
    {
        $this->_idEmpleado = $_idEmpleado;

        return $this;
    }

    /**
     * Get the value of Id Rol
     *
     * @return mixed
     */
    public function getIdRol()
    {
        return $this->_idRol;
    }

    /**
     * Set the value of Id Rol
     *
     * @param mixed _idRol
     *
     * @return self
     */
    public function setIdRol($_idRol)
    {
        $this->_idRol = $_idRol;

        return $this;
    }

    /**
     * Get the value of Estado
     *
     * @return mixed
     */
    public function getEstado()
    {
        return $this->_estado;
    }

    /**
     * Set the value of Estado
     *
     * @param mixed _estado
     *
     * @return self
     */
    public function setEstado($_estado)
    {
        $this->_estado = $_estado;

        return $this;
    }

}

?>
