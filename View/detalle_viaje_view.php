<?php

$idViaje = Helper::isGet('idViaje');

if( empty($idViaje) )
{
    echo "Id de viaje invalido";
}

$viaje = Viaje_model::getById($idViaje);
$logViaje = LogViaje::getAllByViajeId($idViaje);
?>



<div class="content-wrapper">
    <pre>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Detalle del viaje número: <?php echo $idViaje; ?> </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Usuarios</a></li>
        </ol>

        <h1> datos del viaje: </h1>

        <p><strong>descripcion</strong> : <?php echo $viaje[0]->descripcion ;?> </p>
        <p><strong>origen</strong> : <?php echo $viaje[0]->origen ;?></p>

        <p><strong>destino</strong> : <?php echo $viaje[0]->destino ;?> </p>
        <p><strong>destino</strong> : <?php echo $viaje[0]->destino ;?> </p>
        <p><strong>fecha_inicio</strong> : <?php echo $viaje[0]->fecha_inicio ;?></p>
        <p><strong>tiempo_estimado</strong> : <?php echo $viaje[0]->tiempo_estimado ;?></p>
        <p><strong>combustible_estimado </strong> :<?php echo $viaje[0]->combustible_estimado ;?> </p>

        <h1> datos del Cleinte: </h1>

        <p><strong>nombre_cliente</strong> :<?php echo $viaje[0]->nombre_cliente ;?> </p>
        <p><strong>apellido_cliente</strong> :<?php echo $viaje[0]->apellido_cliente ;?> </p>


        <h1> datos del Chofer: </h1>

        <p><strong>nombre_chofer</strong> :<?php echo $viaje[0]->nombre_chofer ;?> </p>
        <p><strong>apellido_chofer</strong> :<?php echo $viaje[0]->apellido_chofer ;?> </p>


        <h1> datos del Vehiculo: </h1>

        <p><strong>patente</strong> :<?php echo $viaje[0]->patente ;?> </p>
        <p><strong>patente_acoplado</strong> :<?php echo $viaje[0]->patente_acoplado ;?> </p>

        <h1> Log del Vehiculo: </h1>
            <table id="tablaTipoVehiculos">
                <thead>
                    <tr>
                        <th>razon</th>
                        <th>fecha</th>
                        <th>latitud</th>
                        <th>longitud</th>
                        <th>detalle</th>
                        <th>combustible</th>
                        <th>kilometros</th>
                        <th>Precio</th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach($logViaje as $log ){ ?>
                    <tr>
                        <td><?php echo $log->razon; ?></td>
                        <td><?php echo $log->fecha; ?></td>
                        <td><?php echo $log->latitud; ?></td>
                        <td><?php echo $log->longitud; ?></td>
                        <td><?php echo $log->detalle; ?></td>
                        <td><?php echo $log->combustible; ?></td>
                        <td><?php echo $log->kilometros; ?></td>
                        <td><?php echo $log->precio; ?></td>
                    </tr>
                    <?php } ?>
</div>
