<?php

require './models/Usuario.php';

switch ($_POST['action']){
    case 'create':
        $usuario = new Usuario($nombre,$apellido,$usuario,$password);
        $usuario->save();
        break;
    case 'update':
        $usuario = new Usuario($nombre,$apellido,$usuario,$password,$id);
        $usuario->save();
        break;
}
