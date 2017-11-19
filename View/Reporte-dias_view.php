<?php

$listMantenimiento = Vehiculo_model::getReporteDiasFueraDeServicio();
?>

<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Dias inactivos de un Vehiculo </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Mantenimiento</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCreate"><i class="glyphicon glyphicon-save-file"></i> Importar a PDF</button>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCreate"><i class="glyphicon glyphicon-tasks"></i> Ver graficos</button>


        <table id="tablaMantenimiento">
          <thead>
                <tr>
                  <th>Id Vehiculo</th>
                  <th>Marca</th>
                  <th>Patente</th>
                  <th>Fecha de fabricacion</th>
                  <th>Dias inactivo</th>

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
                      <td><?php echo $mantenimiento->DiasInactivo?></td>

                    </tr>

            <?php
                    }
                }
            ?>

            </tbody>

        </table>

    </section><!-- /.content -->
</div>
