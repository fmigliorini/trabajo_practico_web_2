<?php

require_once "Helper.php";

require_once 'middleware/requiereLogin.php';

if(isset($_GET['page']) && !empty($_GET['page']))
{
    require_once 'middleware/requirePermiso.php';
    require_once 'middleware/validarModulo.php';
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
        case 'detalle_viaje':
            require_once "models/LogViaje_model.php";
            require_once "models/Viaje_model.php";
            require_once 'View/detalle_viaje_view.php';
            break;
        case 'mantenimiento':
            require_once "models/Mantenimiento_model.php";
            require_once "models/Vehiculo_model.php";
            require_once "models/Servicio_model.php";
            require_once 'View/Mantenimiento_view.php';
            break;
        case 'requierePermiso':
            require_once 'View/requierePermiso_View.php';
            break;
        case 'pageNotFound':
            require_once 'View/pageNotFound_view.php';
            break;
        case 'reportes':
              require_once "models/Vehiculo_model.php";
              require_once "View/Reporte_view.php";
              break;
        case 'reportes-kilometros':
              require_once "models/Vehiculo_model.php";
              require_once "View/Reporte-kilometros_view.php";
              break;
        case 'reportes-costo':
              require_once "models/Vehiculo_model.php";
              require_once "View/Reporte-costo_view.php";
              break;
        case 'reportes-dias':
              require_once "models/Vehiculo_model.php";
              require_once "View/Reporte-dias_view.php";
              break;
        case 'reportes-kilometrosService':
              require_once "models/Vehiculo_model.php";
              require_once "View/Reporte-kilometrosService_view.php";
              break;
        case 'graficos':
              require_once "models/Vehiculo_model.php";
              require_once "View/Graficos_view.php";
              break;
    }
}

require_once "templates/footer.php";
