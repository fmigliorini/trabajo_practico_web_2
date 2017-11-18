<?php
if( $_SERVER['REQUEST_METHOD'] === "POST" ) {
    switch( $_POST["work"] ){
        case 'create':


        $fechaInicio= Helper::isPost('fechaInicio');
        $fechaFin= Helper::isPost('fechaFin');
        $costo= Helper::isPost('costo');
        $kilometros= Helper::isPost('kilometros');
        $id_servicio = Helper::isPost('id_servicio');
        $id_vehiculo= Helper::isPost('id_vehiculo');
        $mecanico = Helper::isPost('mecanico');
        $repuestoCambiado= Helper::isPost('repuestoCambiado');

          $mantenimiento = new Mantenimiento();
          $mantenimiento->setFechaInicio($fechaInicio);
          $mantenimiento->setFechaFin($fechaFin);
          $mantenimiento->setCosto($costo);
          $mantenimiento->setKilometros($kilometros);
          $mantenimiento->setIdServicio($id_servicio );
          $mantenimiento->setIdVehiculo($id_vehiculo);
          $mantenimiento->setMecanico($mecanico);
          $mantenimiento->setRepuestoCambiado($repuestoCambiado);
            if ( $mantenimiento->save() ) {
                // ALL OK
            }
            break;
        case 'edit':
            $idMantenimiento = Helper::isPost('idMantenimiento ');
            $mantenimiento = Mantenimiento::getById($idMantenimiento);
            if ( $mantenimiento ) {
          //    $fechaInicio= Helper::isPost('fechaInicio');
              $fechaFin= Helper::isPost('fechaFin');
              $costo= Helper::isPost('costo');
              $kilometros= Helper::isPost('kilometros');
            //  $id_servicio = Helper::isPost('id_servicio');
              //$id_vehiculo= Helper::isPost('id_vehiculo');
              $mecanico = Helper::isPost('mecanico');
              $repuestoCambiado= Helper::isPost('repuestoCambiado');

                  $mantenimiento = new Mantenimiento();
              //    $mantenimiento->setFechaInicio($fechaInicio);
                $mantenimiento->setFechaFin($fechaFin);
                $mantenimiento->setCosto($costo);
                $mantenimiento->setKilometros($kilometros);
                //$mantenimiento->setIdServicio($id_servicio );
              //  $mantenimiento->setIdVehiculo($id_vehiculo);
                $mantenimiento->setMecanico($mecanico);
                $mantenimiento->setRepuestoCambiado($repuestoCambiado);
                if ( $mantenimiento->save() ) {
                    // all ok
                }
            }
            break;
        default:
            echo "EMPTY";
            break;
    }

}


// obtener mantenimientos
$listVehiculos = Vehiculo::getAll();
$listServicios = Servicio::getAll();
$listMantenimiento = Mantenimiento::getAll();
?>

<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Bienvenido a Mantenimiento </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Mantenimiento</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCreate">Agregar</button>



        <table id="tablaMantenimiento">
          <thead>
                <tr>
                  <th>Num. Mantenimiento</th>
                  <th>Fecha Inicio</th>
                  <th>Fecha Fin</th>
                  <th>Costo</th>
                  <th>Kilometros</th>
                  <th>Servicio</th>
                  <th>Vehiculo</th>
                  <th>Mecanico </th>
                  <th>Repuesto Cambiado</th>
                  <th>Actualizar </th>
                  <th>Eliminar</th>
                </tr>
            </thead>

            <tbody>
            <?php
                if ( !empty($listMantenimiento) ){
                    foreach($listMantenimiento as $mantenimiento) {  ?>
                    <tr>
                      <td><?php echo$mantenimiento->id            ?></td>
                      <td><?php echo $mantenimiento->fechaInicio  ?></td>
                      <td><?php echo $mantenimiento->fechaFin     ?></td>
                      <td><?php echo $mantenimiento->costo        ?></td>
                      <td><?php echo $mantenimiento->kilometros   ?></td>
                      <td><?php echo $mantenimiento->id_servicio  ?></td>
                      <td><?php echo $mantenimiento->id_vehiculo  ?></td>
                      <td><?php echo $mantenimiento->mecanico     ?></td>
                      <td><?php echo $mantenimiento->repuestoCambiado ?></td>
                        <td>
                            <a class="btn-modal-edit-empleado" href="#"
                                data-toggle="modal"
                                data-target="#modalEdit"
                                data-id  ="<?php echo$mantenimiento->id?> "
                                data-fechaInicio  ="<?php echo $mantenimiento->fechaInicio  ?>    "
                                data-fechaFin     ="<?php echo $mantenimiento->fechaFin     ?>    "
                                data-costo        ="<?php echo $mantenimiento->costo        ?>    "
                                data-kilometros   ="<?php echo $mantenimiento->kilometros   ?>    "
                                data-id_servicio  ="<?php echo $mantenimiento->id_servicio  ?>    "
                                data-id_vehiculo  ="<?php echo $mantenimiento->id_vehiculo  ?>    "
                                data-mecanico     ="<?php echo $mantenimiento->mecanico     ?>    "
                                data-repuestoCambiado  ="<?php echo $mantenimiento->repuestoCambiado ?>">
                                <i class="fa fa-pencil"
                                aria-hidden="true"
                                ></i></a>
                        </td>
                        <td>
                            <a class="btn-modal-delete-empleado" href="#"
                                data-toggle="modal"
                                data-target="#modalDelete"
                                data-id  ="<?php echo$mantenimiento->id?> "
                                >
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </a><!-- modal delete -->
                        </td>
                    </tr>

            <?php
                    }
                }
            ?>

            </tbody>

        </table>

    </section><!-- /.content -->
</div>

<!-- Modal-New-Empleado -->
<div id="modalCreate" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Mantenimiento</h4>
            </div>
            <form method="POST">
                <input type="hidden" name="work" value="create">
                <div class="modal-body">
                    <legend>Iniciar Mantenimiento</legend>
                    <div class="form-group">
                        <label for="fechaInicio">Fecha de inicio</label>
                        <input type="text" name="fechaInicio" id="fechaInicio" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="kilometros">Kilometros</label>
                        <input type="text" name="kilometros" id="kilometros" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="externo">Servicio Externo</label>
                        <input type="text" name="externo" id="externo" class="form-control" required>
                    </div>

                    <div class="form-group">
                      <label for="modulo">Servicio</label>
                      <select name="id_Modulo" class="form-control" required="required">
                          <option value=""> Seleccione un Servicio </<option>
                          <?php foreach( $listServicios as $servicio ) { ?>
                              <option value="<?php echo $servicio->id; ?>">
                                 <?php echo $servicio->id; ?> - <?php echo $servicio->descripcion;?>
                              </option>
                          <?php } ?>
                      </select>

                    </div>


                    <div class="form-group">
                      <label for="modulo">Vehiculo</label>
                      <select name="id_Modulo" class="form-control" required="required">
                          <option value=""> Seleccione un Vehiculo </<option>
                          <?php foreach( $listVehiculos as $vehiculo ) { ?>
                              <option value="<?php echo $vehiculo->id; ?>">
                                 <?php echo $vehiculo->id; ?> - <?php echo $vehiculo->marca;??> - <?php echo $vehiculo->patente;?>
                              </option>
                          <?php } ?>
                      </select>

                    </div>

                </div>
                <div class="modal-footer">  <!-- Footer -->
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    <input type="submit" name="Crear" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End-Modal-New-Empleado -->

<!-- Moda-Edit-Empledao -->
<div id="modalEdit" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Usuario</h4>
            </div>
            <form id="form-edit" method="POST">
                <input type="hidden" name="work" value="edit">
                <input type="hidden" name="idMantenimiento" id="idMantenimiento" value="">
                <div class="modal-body">
                    <legend>Actualizar Mantenimiento</legend>

                        <div class="form-group">
                            <label for="fechaFin">Fecha de Finalizacion</label>
                            <input type="text" name="fechaFin" id="fechaFin" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="costo">Costo</label>
                            <input type="text" name="costo" id="costo" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="costo">Mecanico</label>
                            <input type="text" name="costo" id="costo" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="kilometros">Repuesto Cambiado</label>
                            <input type="text" name="kilometros" id="kilometros" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">  <!-- Footer -->
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    <input type="submit" name="Crear" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End-Modal-Edit-Empleado -->

<!-- Modal-Delete-Empleado -->
<div id="modalDelete" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Eliminar Mantenimiento</h4>
            </div>
            <form id="form-delete" method="POST">
                <input type="hidden" name="work" id="work" value="delete">
                <input type="hidden" name="idMantenimiento" id="idMantenimiento" value="">
                <div class="modal-body">
                    <p>Desea eliminar el Mantenimiento : <span id="id"></span></p>
                </div> <!-- End modal-body -->
                <div class="modal-footer">  <!-- Footer -->
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <input type="button" class="btn btn-danger" value="Eliminar">
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End-Modal-Delete-Empleado -->
