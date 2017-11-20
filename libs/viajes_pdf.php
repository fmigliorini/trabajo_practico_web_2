<?php 

require_once "../models/Viaje_model.php";
require_once "dompdf/dompdf_config.inc.php";

$viajes = new Viaje_model();
$datos = $viajes->getAll();

$codigoHTML = '
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Reporte viajes</title>
</head>
<body>

    <h2><strong>Reporte de Viajes</strong></h2><br>';

    $i = 1;
	foreach ($datos as $key => $dato) : 
		
		$codigoHTML.= 
		($i == 2 ? '<h3><u>Viaje '.$i.'</u></h3>' : '').'
		<p><strong>Descripción:</strong> '.$dato->descripcion.'</p>
		<p><strong>Origen:</strong> '.$dato->origen.'</p>
		<p><strong>Destino:</strong> '.$dato->destino.'</p>
		<p><strong>Fecha inicio:</strong> '.$dato->fecha_inicio.'</p>
		<p><strong>Tiempo estimado:</strong> '.$dato->tiempo_estimado.'</p>
		<p><strong>Combustible estimado:</strong> '.$dato->combustible_estimado.'</p>
		<p><strong>Kilometros estimados:</strong> '.$dato->kilometro_estimado.'</p>
		<p><strong>Estado:</strong> '.$dato->estado.'</p>
		<p><strong>Cliente:</strong> '.$dato->nombre_cliente.' '.$dato->apellido_cliente.'</p>
		<p><strong>Chofer:</strong> '.$dato->nombre_chofer.' '.$dato->apellido_chofer.'</p>
		<p><strong>Segundo Chofer:</strong> '.($dato->nombre_chofer2 != '' ? $dato->nombre_chofer2.' '.$dato->apellido_chofer2 : '-').'</p>
		<p><strong>Patente del vehículo:</strong> '.$dato->patente.'</p>
		<p><strong>Patente del vehículo acoplado:</strong> '.($dato->patente_acoplado != '' ? $dato->patente_acoplado : '-').'</p><br>';
		if($dato->razon != '') : 
			$codigoHTML.= 
			'<h3><p><i>Logs viaje: </i></p></h3><br>
			<p><strong>Razón:</strong> '.$dato->razon.'</p>
			<p><strong>Fecha Log:</strong> '.$dato->fecha_log.'</p>
			<p><strong>Latitud:</strong> '.$dato->latitud.'</p>
			<p><strong>Longitud:</strong> '.$dato->longitud.'</p>
			<p><strong>Detalle Log:</strong> '.$dato->detalle_log.'</p>
			<p><strong>Combustible:</strong> '.$dato->combustible_log.'</p>
			<p><strong>Kilometros:</strong> '.$dato->kilometros.'</p>
			<p><strong>Precio:</strong> '.$dato->precio.'</p><br>';
		endif; 

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
$dompdf->stream("reporte_viajes.pdf");

?>



?>