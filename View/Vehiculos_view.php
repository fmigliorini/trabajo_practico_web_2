
<?php
$vehiculo = new Vehiculo_model();
$msgError = '';

if($_SERVER['REQUEST_METHOD'] === "POST")
{
    $patente = Helper::isPost('patente');
    $estado = Helper::isPost('estado');
    $marca = Helper::isPost('marca');
    $nro_chasis = Helper::isPost('nro_chasis');
    $nro_motor = Helper::isPost('nro_motor');
    $fecha_fabricacion = Helper::isPost('fecha_fabricacion');
    $tipo = Helper::isPost('tipo');

    $guardar = Helper::isPost('guardar');
    $editar = Helper::isPost('editar');
    $eliminar = Helper::isPost('eliminar');

    $vehiculo->setPatente($patente);
    $vehiculo->setTipo($tipo);
    $vehiculo->setEstado($estado);
    $vehiculo->setMarca($marca);
    $vehiculo->setNroChasis($nro_chasis);
    $vehiculo->setNroMotor($nro_motor);
    $vehiculo->setFechaFabricacion($fecha_fabricacion);

    if($guardar)
    {
        $rs = $vehiculo->save();

        if($rs == false)
            $msgError = "La patente ya existe.";
    }

    if($editar || $eliminar)
    {
        $id = Helper::isPost('idVehiculo');
        $vehiculo->setId($id);

        if($editar)
            $rs = $vehiculo->save();
        else
            $rs = $vehiculo->delete();
    }


    if($rs)
    {
        echo '<script>
            window.location.href= "index.php?page=vehiculos"
        </script>';
        die;
    }
}

$tiposVehiculo = $vehiculo->getTipoVehiculo();
$estadosVehiculo = $vehiculo->getEstadoVehiculo();

?>
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Bienvenido a Vehiculos </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Vehiculos</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <?php if(isset($msgError) && $msgError != '') : ?>
            <div class="alert alert-danger">
                <strong>Error!</strong> <?php echo $msgError; ?>
            </div>
        <?php endif; ?>

        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalVehiculo">Agregar</button>

        <div id="modalVehiculo" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Agregar Vehiculo</h4>
                    </div>

                    <div class="modal-body">

                        <form action="" method="POST">

                            <div class="form-group">
                                <label for="patente">Patente</label>
                                <input type="text" name="patente" id="patente" class="form-control" required autocomplete="off">
                            </div>

                            <div class="form-group">
                                <label for="marca">Marca</label>
                                <input type="text" name="marca" id="marca" class="form-control" required autocomplete="off">
                            </div>

                            <div class="form-group">
                                <label for="nro_chasis">Nro. Chasis</label>
                                <input type="text" name="nro_chasis" id="nro_chasis" class="form-control" required autocomplete="off">
                            </div>

                            <div class="form-group">
                                <label for="nro_motor">Nro. Motor</label>
                                <input type="text" name="nro_motor" id="nro_motor" class="form-control" required autocomplete="off">
                            </div>

                            <div class="form-group">
                                <label for="fecha_fabricacion">Fecha de Fabricación</label>
                                <input type="date" name="fecha_fabricacion" id="fecha_fabricacion" class="form-control" required autocomplete="off">
                            </div>

                            <div class="form-group">
                                <label for="tipo">Tipo del Vehículo:</label>
                                <select name="tipo" id="tipo" class="form-control" required>
                                    <option value="">Seleccione el tipo de Vehiculo</option>
                                    <?php foreach($tiposVehiculo as $tipo) : ?>
                                        <option value="<?php echo $tipo->id_tipo; ?>"><?php echo $tipo->tipo; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="estado">Estado del Vehículo:</label>
                                <select name="estado" id="estado" class="form-control" required>
                                    <option value="">Seleccione el estado de Vehiculo</option>
                                    <?php foreach($estadosVehiculo as $estado) : ?>
                                        <option value="<?php echo $estado->id_estado; ?>"><?php echo $estado->estado; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="modal-footer">  <!-- Footer -->
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                <input type="submit" name="guardar" class="btn btn-success">
                            </div>

                        </form>

                    </div> <!-- End modal-body -->

                </div>
            </div>
        </div>

        <table id="tablaTipoVehiculos">

            <thead>
                <tr>
                    <th>Patente</th>
                    <th>Tipo</th>
                    <th>Estado</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>

            <?php 
            $datos = $vehiculo->getAll();
            ?>

            <tbody>

                <?php foreach($datos as $dato) : ?>
            
                <tr>
                    <td><?php echo $dato->patente; ?></td>
                    <td><?php echo $dato->tipo; ?></td>
                    <td><?php echo $dato->estado; ?></td>
                    <td>
                        <a class="btn-modal-edit-vehiculo" href="#" data-toggle="modal"
                            data-target="#modalEdit"
                            data-id="<?php echo $dato->id; ?>"
                            data-patente="<?php echo $dato->patente; ?>"
                            data-tipo="<?php echo $dato->tipo ; ?>"
                            data-id_tipo="<?php echo $dato->id_tipoVehiculo ; ?>"
                            data-estado="<?php echo $dato->estado ; ?>"
                            data-id_estado="<?php echo $dato->id_estadoVehiculo ; ?>"
                            data-marca="<?php echo $dato->marca ; ?>"
                            data-nro_chasis="<?php echo $dato->nro_chasis ; ?>"
                            data-nro_motor="<?php echo $dato->nro_motor ; ?>"
                            data-fecha_fabricacion="<?php echo $dato->fecha_fabricacion ; ?>">
                            <i class="fa fa-pencil" aria-hidden="true"></i></a>
                    </td>
                    <td>
                        <a class="btn-modal-delete-vehiculo" href="#" data-toggle="modal"
                            data-target="#modalDelete"
                            data-id="<?php echo $dato->id; ?>"
                            data-patente="<?php echo $dato->patente; ?>">
                            <i class="fa fa-trash" aria-hidden="true"></i></a>
                    </td>
                </tr>

                <?php endforeach; ?>

            </tbody>

        </table>

    </section><!-- /.content -->
</div>

<!-- Moda-Edit-Vehiculo -->
<div id="modalEdit" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Vehiculo</h4>
            </div>
            <form id="form-edit" method="POST">

                <div class="modal-body">
                    <legend>Datos Vehiculo</legend>

                    <div class="form-group">
                        <label for="patente">Patente</label>
                        <input type="text" name="patente" id="patente" class="form-control" required autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label for="marca">Marca</label>
                        <input type="text" name="marca" id="marca" class="form-control" required autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label for="nro_chasis">Nro. Chasis</label>
                        <input type="text" name="nro_chasis" id="nro_chasis" class="form-control" required autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label for="nro_motor">Nro. Motor</label>
                        <input type="text" name="nro_motor" id="nro_motor" class="form-control" required autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label for="fecha_fabricacion">Fecha de Fabricación</label>
                        <input type="date" name="fecha_fabricacion" id="fecha_fabricacion" class="form-control" required autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label for="tipo">Tipo del Vehículo:</label>
                        <select name="tipo" id="tipo" class="form-control" required>
                            <option value="">Seleccione el tipo de Vehiculo</option>
                            <?php foreach($tiposVehiculo as $tipo) : ?>
                                <option value="<?php echo $tipo->id_tipo; ?>"><?php echo $tipo->tipo; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="estado">Estado del Vehículo:</label>
                        <select name="estado" id="estado" class="form-control" required>
                            <option value="">Seleccione el estado de Vehiculo</option>
                            <?php foreach($estadosVehiculo as $estado) : ?>
                                <option value="<?php echo $estado->id_estado; ?>"><?php echo $estado->estado; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <input type="hidden" name="idVehiculo" id="idVehiculo">

                    <div class="modal-footer">  <!-- Footer -->
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <input type="submit" name="editar" class="btn btn-success" value="Actualizar">
                    </div>

                </div> <!-- End modal-body -->
            </form>
        </div>
    </div>
</div>
<!-- End-Modal-Edit-Vehiculo -->

<!-- Modal-Delete-Vehiculo -->
<div id="modalDelete" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Eliminar Vehiculo</h4>
            </div>
            <form id="form-delete" method="POST">

                <input type="hidden" name="idVehiculo" id="idVehiculo">

                <div class="modal-body">
                    <p>Desea eliminar el Vehiculo con la patente : <span id="patente"></span> ?</p>
                </div> <!-- End modal-body -->

                <div class="modal-footer">  <!-- Footer -->
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <input type="submit" name="eliminar" class="btn btn-danger" value="Eliminar">
                </div>

            </form>
        </div>
    </div>
</div>
<!-- End-Modal-Delete-Vehiculo -->