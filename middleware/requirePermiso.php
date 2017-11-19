<?php
require_once 'models/Permiso_model.php';
require_once 'models/Modulo_model.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$page = $_GET['page'];
$rol = $_SESSION['idRol'];
if ( $page !== 'requierePermiso' && $page !== 'pageNotFound'){

    // Fix para reportes
    switch($page){
        case 'reportes-dias':
        case 'reportes-costo':
        case 'reportes-kilometros':
            $page = "reportes";
            break;
    }

    if ( ! Permiso::tieneAcceso(Modulo::getIdByPage($page), $rol) ){
        header('Location: index.php?page=requierePermiso');
    }
}
