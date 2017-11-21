<?php

require_once "models/LogViaje_model.php";
$viajes = new LogViaje();
$logViaje = LogViaje::getAllByViajeId($_GET['idViaje']);
echo json_encode($logViaje);
