<?php

require_once "models/LogViaje_model.php";
$viajes = new LogViaje();
$logViaje = LogViaje::getAllByViajeId($idViaje);
echo json_encode($logViaje);
