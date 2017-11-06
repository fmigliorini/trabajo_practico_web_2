<?php
require_once 'middleware/requiereLogin.php';
require_once "Helper.php";
require_once "templates/head.php";
require_once "templates/header.php";
require_once "templates/menu.php";

if(isset($_GET['page']) && !empty($_GET['page']))
{
    switch ($_GET['page']) {
        case 'home':
            require_once 'home.php';
        break;
        case 'roles':
            require_once 'roles.php';
        break;
        case 'usuario':
            require_once 'Usuario.php';
            break;
        default:
            header('location: index.php?page=home');
            die;
        break;
    }
} else {
    header('location: login.php');
    die;
}


require_once "templates/footer.php";
