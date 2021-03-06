<?php

$listMantenimiento = Vehiculo_model::getReporteKilometrosRecorridos();
?>

<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Kilometros Recorridos de un Vehiculo </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Mantenimiento</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

     <a href="libs/reportes-kilometrosRecorridos_pdf.php" class="btn btn-default">Exportar PDF</a>


        <table id="tablaMantenimiento">
          <thead>
                <tr>
                  <th>Id Vehiculo</th>
                  <th>Marca</th>
                  <th>Patente</th>
                  <th>Fecha de fabricacion</th>
                  <th>Kilometros Recorridos</th>

                </tr>
            </thead>

            <tbody>
            <?php
                if ( !empty($listMantenimiento) ){
                    foreach($listMantenimiento as $mantenimiento) {  ?>
                    <tr>
                      <td><?php echo $mantenimiento->id?></td>
                      <td><?php echo $mantenimiento->marca?></td>
                      <td><?php echo $mantenimiento->patente?></td>
                        <td><?php echo $mantenimiento->fecha_fabricacion?></td>
                      <td><?php echo $mantenimiento->KilometrosRecorridos?></td>

                    </tr>

            <?php
                    }
                }
            ?>

            </tbody>

        </table>

    </section><!-- /.content -->
</div>
