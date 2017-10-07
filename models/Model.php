<?php

abstract class Model
{

    CONST DB_HOST = "192.168.10.10";
    CONST DB_NAME = "tp_web";
    CONST DB_USER = "";
    CONST DB_PASSWORD = "";

    private $_db;

    /**
    * Ejecuta una consulta en la base de datos y retorna información
    **/
    protected function query($query)
    {

        $type = explode(" ", trim($query) );
        switch ( strtolower($type[0]) ){
            case 'select':
                return $this->_select($query);  
                break;
            case 'update':
                return $this->_update($query);
                break;
            case 'delete':
                return $this->_delete($query);
                break;
        }
    }

    /**
    * Si la consulta es un select, ejecuta la query y devuelve un array.
    * @param $query String
    * @return $res  Array | Boolean
    **/
    private function _select($query)
    {
        $res = $this->_execQuery($query);

        if ( $res ) {
            while( $row = $res->fetch_object() ) {
                $return[] = $row;
            }
        }

        return $return;
    }

    /**
    * Si la consulta es un insert, guardo el campo y devuelvo el id del registro ingresado.
    * @param $query String
    * @return $res  Boolean | int
    **/
    private function _insert($query)
    {
        $res = $this->_execQuery($query);
        if( !$res )
            return false;

        return $res->insert_id;
    }

    /**
    * Si la consulta es un delete, devuelvo verdadero o falso dependiendo la respuesta.
    * @param $query String
    * @return $res  Boolean
    **/
    private function _delete($query)
    {
        $res = $this->_execQuery($query);
        if ( !$res )
            return false;

        return true;
    }

    /**
    * Ejecuto la query
    * @param $query String
    * @return $res  Object
    **/
    private function _execQuery($query)
    {
        // SANITIZAR QUERY
        $this->_connect();
        $res = $this->_db->query($query);
        $this->_close();
        return $res;
    }

    private function _connect()
    {
        $this->_db = mysqli_connect( self::DB_HOST, self::DB_USER, self::DB_PASSWORD, self::DB_HOST );
    }

    private function _close()
    {
        $this->_db->close();
    }

}
