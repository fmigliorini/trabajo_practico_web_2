<?php

abstract class Helper
{

    static public function isPage($pageName)
    {
        if( isset($_GET['page']) && $_GET['page'] === $pageName )
            return true;

        return false;
    }


    static public function isGet($name)
    {
        if( isset($_GET[$name]) && $_GET[$name] !== "" )
            return trim($_GET[$name]);

        return null;
    }

    static public function isPost($name)
    {
        if( isset($_POST[$name]) && $_POST[$name] !== "" )
            return trim($_POST[$name]);

        return null;
    }

}
