<?php
if( $_SERVER['REQUEST_METHOD'] === "POST" ) {
  $fechaInicio= Helper::isPost('fechaInicio');
  $horaInicio= Helper::isPost('horaInicio');
  $fechaFin= Helper::isPost('fechaFin');
  $horaFin= Helper::isPost('horaFin');
  $costo= Helper::isPost('costo');
  $kilometros= Helper::isPost('kilometros');
  $id_servicio = Helper::isPost('id_servicio');
  $id_vehiculo= Helper::isPost('id_vehiculo');
  $mecanico = Helper::isPost('mecanico');
  $repuestoCambiado= Helper::isPost('repuestoCambiado');
  $externo= Helper::isPost('externo');
  $idMantenimiento = Helper::isPost('id');
  $mantenimiento = Mantenimiento::getById($idMantenimiento);

  $mantenimiento = new Mantenimiento();
  $mantenimiento->setFechaFin($fechaFin);
  $mantenimiento->setHoraFin($horaFin);
  $mantenimiento->setCosto($costo);
  $mantenimiento->setMecanico($mecanico);
  $mantenimiento->setRepuestoCambiado($repuestoCambiado);
  $mantenimiento->setId($idMantenimiento);


    switch( $_POST["work"] ){
        case 'create':
          $mantenimiento->setFechaInicio($fechaInicio);
          $mantenimiento->sethoraInicio($horaInicio);
          $mantenimiento->setKilometros($kilometros);
          $mantenimiento->setIdServicio($id_servicio );
          $mantenimiento->setIdVehiculo($id_vehiculo);
          $mantenimiento->setExterno((int)$externo);
          $mantenimiento->setRepuestoCambiado($repuestoCambiado);
            if ( $mantenimiento->save() ) {
            }
            break;
        case 'edit':
            if ( $mantenimiento ) {
                if ( $mantenimiento->save() ) {
                    // all ok
                }
            }
            break;
        case 'delete':
          $mantenimiento = new Mantenimiento();
          $mantenimiento->setId($idMantenimiento);
          $mantenimiento->removeMantenimiento();
          break;
        default:
            echo "EMPTY";
            break;
    }

}


// obtener mantenimientos
$listVehiculos = Vehiculo_model::getAllStatic();
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
                  <th>Nº</th>
                  <th>Fecha Inicio</th>
                  <th>Hora Inicio</th>
                  <th>Fecha Fin</th>
                  <th>Hora Fin</th>
                  <th>Costo</th>
                  <th>Km.</th>
                  <th>Servicio</th>
                  <th>Vehiculo</th>
                  <th>Mecanico </th>
                  <th>Repuesto Cambiado</th>
                  <th>Externo</th>
                  <th>Actualizar</th>
                  <th>Eliminar</th>
                </tr>
            </thead>

            <tbody>
            <?php
                if ( !empty($listMantenimiento) ){
                    foreach($listMantenimiento as $mantenimiento) :  ?>
                    <tr>
                      <td><?php echo $mantenimiento->id?></td>
                      <td><?php echo $mantenimiento->fecha_inicio?></td>
                      <td><?php echo $mantenimiento->hora_inicio?></td>
                      <td><?php echo $mantenimiento->fecha_fin?></td>
                      <td><?php echo $mantenimiento->hora_fin?></td>
                      <td><?php echo $mantenimiento->costo?></td>
                      <td><?php echo $mantenimiento->kilometros?></td>
                      <td><?php echo $mantenimiento->id_servicio?></td>
                      <td><?php echo $mantenimiento->id_vehiculo?></td>
                      <td><?php echo $mantenimiento->mecanico?></td>
                      <td><?php echo $mantenimiento->repuestoCambiado?></td>
                      <td><?php echo $mantenimiento->externo?></td>
                        <td>
                            <a class="btn-modal-edit-mantenimiento" href="#"
                                data-toggle="modal"
                                data-target="#modalEdit"
                                data-id  =  "<?php echo $mantenimiento->id?>"
                                data-fechaInicio  ="<?php echo $mantenimiento->fecha_inicio?>"
                                data-horaInicio  ="<?php echo $mantenimiento->hora_inicio?>"
                                data-fechaFin ="<?php echo $mantenimiento->fecha_fin?>"
                                data-horaFin ="<?php echo $mantenimiento->hora_fin?>"
                                data-costo  ="<?php echo $mantenimiento->costo?>"
                                data-kilometros  ="<?php echo $mantenimiento->kilometros?>"
                                data-id_servicio ="<?php echo $mantenimiento->id_servicio?>"
                                data-id_vehiculo ="<?php echo $mantenimiento->id_vehiculo?>"
                                data-mecanico  ="<?php echo $mantenimiento->mecanico?>"
                                data-repuestoCambiado  ="<?php echo $mantenimiento->repuestoCambiado?>"
                                data-externo  ="<?php echo $mantenimiento->externo?>">
                                <i class="fa fa-pencil"
                                aria-hidden="true"
                                ></i></a>
                        </td>
                        <td>
                            <a class="btn-modal-delete-mantenimiento" href="#"
                                data-toggle="modal"
                                data-target="#modalDelete"
                                data-id  ="<?php echo$mantenimiento->id?>"
                                data-nombre  ="<?php echo$mantenimiento->id?>"
                                >
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </a><!-- modal delete -->
                        </td>
                    </tr>

              <?php endforeach; ?>
              <?php  }  ?>

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
                        <input type="date" name="fechaInicio" id="fechaInicio" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="fechaInicio">Hora de inicio</label>
                        <input type="time" name="horaInicio" id="horaInicio" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="kilometros">Kilometros</label>
                        <input type="text" name="kilometros" id="kilometros" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="externo">Externo</label>
                        <select id="externo" name="externo" class="form-control" required="required">
                          <option value=""> Seleccione si el servicio es externo </option>
                          <option value="1"> Si </option>
                          <option value="0"> No </option>
                        </select>
                    </div>

                    <div class="form-group">
                      <label for="servicio">Servicio</label>
                      <select name="id_servicio" id="id_servicio" class="form-control" required="required">
                          <option value=""> Seleccione un Servicio </<option>
                          <?php foreach( $listServicios as $servicio ) { ?>
                              <option value="<?php echo $servicio->id; ?>">
                                 <?php echo $servicio->id; ?> - <?php echo $servicio->descripcion;?>
                              </option>
                          <?php } ?>
                      </select>

                    </div>


                    <div class="form-group">
                      <label for="vehiculo">Vehiculo</label>
                      <select name="id_vehiculo" id="id_vehiculo" class="form-control" required="required">
                          <option value=""> Seleccione un Vehiculo </option>
                          <?php foreach( $listVehiculos as $vehiculo ) { ?>
                              <option value="<?php echo $vehiculo->id; ?>">
                                 <?php echo $vehiculo->id; ?> - <?php echo $vehiculo->marca;?> - <?php echo $vehiculo->patente;?>
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
                <h4 class="modal-title">Mantenimiento</h4>
            </div>
            <form id="form-edit" method="POST">
                <input type="hidden" name="work" value="edit">
                <input type="hidden" name="id" id="idEdit" value="">
                <div class="modal-body">
                    <legend>Actualizar Mantenimiento</legend>

                        <div class="form-group">
                            <label for="fechaFin">Fecha de Finalizacion</label>
                            <input type="date" name="fechaFin" id="fechaFinEdit" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="fechaInicio">Hora de Finalizacion</label>
                            <input type="time" name="horaFin" id="horaFinEdit" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="costo">Costo</label>
                            <input type="text" name="costo" id="costoEdit" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="mecanico">Mecanico</label>
                            <input type="text" name="mecanico" id="mecanicoEdit" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="repuestoCambiado">Repuesto Cambiado</label>
                            <input type="text" name="repuestoCambiado" id="repuestoCambiadoEdit" class="form-control" required>
                        </div>

                        <div class="modal-footer">  <!-- Footer -->
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                            <input type="submit" name="Guardar" class="btn btn-success">
                        </div>
                    </div>
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
                <input type="hidden" name="id" id="idBorrar" value="">
                <div class="modal-body">
                    <p>Desea eliminar el Mantenimiento : <span id="nombreBorrar"></span></p>
                </div> <!-- End modal-body -->
                <div class="modal-footer">  <!-- Footer -->
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <input type="submit" class="btn btn-danger" value="Eliminar">
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End-Modal-Delete-Empleado -->
