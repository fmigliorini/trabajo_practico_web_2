<?php

if(isset($_GET['page']) && !empty($_GET['page']))
{
    require_once 'middleware/requiereLogin.php';
    require_once "Helper.php";
    require_once "templates/head.php";
    require_once "templates/header.php";
    require_once "templates/menu.php";

    switch ($_GET['page']) {
        case 'home':
            require_once 'home.php';
        break;
        case 'roles':
            require_once "models/Rol_model.php";
            require_once 'View/Roles_view.php';
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
            require_once 'View/Vehiculos_view.php';
            break;
        case 'clientes':
            require_once "models/Cliente_model.php";
            require_once 'View/Clientes_view.php';
            break;
        case 'vehiculos':
            require_once "models/Vehiculo_model.php";
            require_once 'View/Vehiculos_view.php';
            break;
        case 'viajes':
            require_once "models/Viaje_model.php";
            require_once 'View/Viajes_view.php';
            break;
        case 'permisos':
                require_once "models/Permiso_model.php";
                require_once "models/Modulo_model.php";
                require_once "models/Rol_model.php";
                require_once 'View/Permisos_view.php';
                break;
        default:
            header('location: index.php?page=home');
            die;
        break;
    }
} else {
    header('location: login.php');
}


require_once "templates/footer.php";
