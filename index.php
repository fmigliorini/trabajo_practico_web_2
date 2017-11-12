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
            require_once "models/Rol_model.php";
            require_once 'view/Roles_view.php';
        break;
        case 'usuario':
            require_once "models/Usuario_model.php";
            require_once "models/Empleado_model.php";
            require_once "models/Rol_model.php";
            require_once 'View/Usuario_view.php';
            break;
        case 'empleado':
            require_once "models/Empleado_model.php";
            require_once 'View/Empleado_view.php';
            break;
        case 'vehiculos':
            require_once "models/Vehiculo_model.php";
            require_once 'view/Vehiculos_view.php';
        break;
        case 'clientes':
            require_once "models/Cliente_model.php";
            require_once 'view/Clientes_view.php';
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
