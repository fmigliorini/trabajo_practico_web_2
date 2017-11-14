<?php

require_once 'ModelInterface.php';
require_once 'DataBase.php';

class LogViaje implements ModelInterface
{
	private $_db;
	private $_id;
    private $_fecha;
    private $_razon;
    private $_latitud;
    private $_longitud;
	private $_detalle;
    private $_combustible;
    private $_kilometros;
	private $_precio;
    private $_idViaje;
    private $_idChofer;

	public function __construct()
	{
		$this->_db = DataBase::getInstance();
	}

	public function save()
    {
        // Precio debería ser siempre > 0;
        if(is_null($this->_id)) {
            $query = sprintf("INSERT INTO ViajeLog (fecha,razon,latitud,longitud,detalle,combustible,precio,id_viaje,id_chofer)
                                VALUES ('%s','%s','%s','%d'",
                                $this->_fecha,
                                $this->_razon,
                                $this->_latitud,
                                $this->_longitud,
                                $this->_detalle,
                                $this->_combustible,
                                $this->_precio,
                                $this->_idViaje,
                                $this->_idChofer
                    );
        }
        // No update.
        return  $this->_db->query($query);
    }

    static public function getAllByViajeId($idViaje)
    {
        $db = DataBase::getInstance();
        $query = "SELECT * FROM ViajeLog where idViaje = $id";
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
     * Get the value of Fecha
     *
     * @return mixed
     */
    public function getFecha()
    {
        return $this->_fecha;
    }

    /**
     * Set the value of Fecha
     *
     * @param mixed _fecha
     *
     * @return self
     */
    public function setFecha($_fecha)
    {
        $this->_fecha = $_fecha;

        return $this;
    }

    /**
     * Get the value of Razon
     *
     * @return mixed
     */
    public function getRazon()
    {
        return $this->_razon;
    }

    /**
     * Set the value of Razon
     *
     * @param mixed _razon
     *
     * @return self
     */
    public function setRazon($_razon)
    {
        $this->_razon = $_razon;

        return $this;
    }

    /**
     * Get the value of Latitud
     *
     * @return mixed
     */
    public function getLatitud()
    {
        return $this->_latitud;
    }

    /**
     * Set the value of Latitud
     *
     * @param mixed _latitud
     *
     * @return self
     */
    public function setLatitud($_latitud)
    {
        $this->_latitud = $_latitud;

        return $this;
    }

    /**
     * Get the value of Longitud
     *
     * @return mixed
     */
    public function getLongitud()
    {
        return $this->_longitud;
    }

    /**
     * Set the value of Longitud
     *
     * @param mixed _longitud
     *
     * @return self
     */
    public function setLongitud($_longitud)
    {
        $this->_longitud = $_longitud;

        return $this;
    }

    /**
     * Get the value of Detalle
     *
     * @return mixed
     */
    public function getDetalle()
    {
        return $this->_detalle;
    }

    /**
     * Set the value of Detalle
     *
     * @param mixed _detalle
     *
     * @return self
     */
    public function setDetalle($_detalle)
    {
        $this->_detalle = $_detalle;

        return $this;
    }

    /**
     * Get the value of Combustible
     *
     * @return mixed
     */
    public function getCombustible()
    {
        return $this->_combustible;
    }

    /**
     * Set the value of Combustible
     *
     * @param mixed _combustible
     *
     * @return self
     */
    public function setCombustible($_combustible)
    {
        $this->_combustible = $_combustible;

        return $this;
    }

    /**
     * Get the value of Kilometros
     *
     * @return mixed
     */
    public function getKilometros()
    {
        return $this->_kilometros;
    }

    /**
     * Set the value of Kilometros
     *
     * @param mixed _kilometros
     *
     * @return self
     */
    public function setKilometros($_kilometros)
    {
        $this->_kilometros = $_kilometros;

        return $this;
    }

    /**
     * Get the value of Precio
     *
     * @return mixed
     */
    public function getPrecio()
    {
        return $this->_precio;
    }

    /**
     * Set the value of Precio
     *
     * @param mixed _precio
     *
     * @return self
     */
    public function setPrecio($_precio)
    {
        $this->_precio = $_precio;

        return $this;
    }

    /**
     * Get the value of Id Viaje
     *
     * @return mixed
     */
    public function getIdViaje()
    {
        return $this->_idViaje;
    }

    /**
     * Set the value of Id Viaje
     *
     * @param mixed _idViaje
     *
     * @return self
     */
    public function setIdViaje($_idViaje)
    {
        $this->_idViaje = $_idViaje;

        return $this;
    }

    /**
     * Get the value of Id Chofer
     *
     * @return mixed
     */
    public function getIdChofer()
    {
        return $this->_idChofer;
    }

    /**
     * Set the value of Id Chofer
     *
     * @param mixed _idChofer
     *
     * @return self
     */
    public function setIdChofer($_idChofer)
    {
        $this->_idChofer = $_idChofer;

        return $this;
    }

}
