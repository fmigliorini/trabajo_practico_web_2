<?php 

require 'Helper.php';
include 'libs/phpqrcode/qrlib.php';
$idViaje = Helper::isGet('idViaje');

QRcode::png('http://localhost/TP-PW2/LogViaje?idViaje='.$idViaje , 'qrImages/qrViaje_' . $idViaje . '.png');
        