<?php

session_start();
if ( !isset( $_SESSION['authenticate'] ) || $_SESSION['authenticate'] !== true ){
    header('Location: login.php');
    exit;
}else {
    $autorize = true; //Autorize retorna true cuando existe una sesion. (Hay persona logueada)
}
