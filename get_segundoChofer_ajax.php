<?php

require_once "models/Viaje_model.php";

$viajes = new Viaje_model();
$viajes->set_id($_GET['id_chofer']);

$rows = $viajes->getChoferesAjax();

echo json_encode($rows);
