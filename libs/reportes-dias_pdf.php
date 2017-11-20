<?php 

require_once "../models/Vehiculo_model.php";
require_once "dompdf/dompdf_config.inc.php";

$datos = Vehiculo_model::getReporteDiasFueraDeServicio();

$codigoHTML = '
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Reporte vehiculos fuera de servicio</title>
</head>
<body>

    <h2><strong>Reporte de Vehículos fuera de servicio</strong></h2><br>';

    $i = 1;
	foreach ($datos as $key => $dato) : 
		
		$codigoHTML.= 
		($i >= 2 ? '<h3><u>Reporte '.$i.'</u></h3>' : '').'
		<p><strong>Marca:</strong> '.$dato->marca.'</p>
		<p><strong>Patente:</strong> '.$dato->patente.'</p>
		<p><strong>Fecha fabricación:</strong> '.$dato->fecha_fabricacion.'</p>
		<p><strong>Dias inactivo:</strong> '.$dato->DiasInactivo.' Días</p><br>';

		$i++;
	endforeach; 
  
$codigoHTML.= '
</table>
</body>
</html>';

$codigoHTML =  mb_convert_encoding($codigoHTML, 'HTML-ENTITIES', 'UTF-8');
$dompdf=new DOMPDF();
$dompdf->load_html($codigoHTML);
ini_set("memory_limit","128M");
$dompdf->render();
$dompdf->stream("reporte_VehiculosFueraDeServicio.pdf");

?>

