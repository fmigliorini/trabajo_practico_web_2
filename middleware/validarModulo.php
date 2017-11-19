<?php
require_once 'models/Modulo_model.php';

if ( ! Modulo::existe($_GET['page']) ){
    header('Location: index.php?page=pageNotFound');
}
