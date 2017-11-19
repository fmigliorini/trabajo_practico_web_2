<?php
require_once 'models/Permiso_model.php';
require_once 'models/Modulo_model.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ( $_GET['page'] !== 'requierePermiso'
        && $_GET['page'] !== 'pageNotFound'
        && $_GET['page'] !== 'home'){
    if ( ! Permiso::tieneAcceso(Modulo::getIdByPage($_GET['page']), $_SESSION['idRol']) ){
        header('Location: index.php?page=requierePermiso');
    }
}
