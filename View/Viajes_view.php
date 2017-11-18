
<?php
$viaje = new Viaje_model();

if($_SERVER['REQUEST_METHOD'] === "POST")
{
    $descripcion = Helper::isPost('descripcion');
    $origen = Helper::isPost('origen');
    $destino = Helper::isPost('destino');
    $fecha_inicio = Helper::isPost('fecha_inicio');
    $tiempo_estimado = Helper::isPost('tiempo_estimado');
    $combustible_estimado = Helper::isPost('combustible_estimado');
    $idCliente = Helper::isPost('idCliente');
    $idVehiculo = Helper::isPost('idVehiculo');
    $idVehiculoAcoplado = (isset($_POST['idVehiculoAcoplado']) ? $_POST['idVehiculoAcoplado'] : NULL);
    $idChofer = Helper::isPost('idChofer');
    $idChofer2 = Helper::isPost('idChofer2');

    $guardar = Helper::isPost('guardar');
    $editar = Helper::isPost('editar');
    $eliminar = Helper::isPost('eliminar');

    $viaje->set_descripcion($descripcion);
    $viaje->set_origen($origen);
    $viaje->set_destino($destino);
    $viaje->set_fechaInicio($fecha_inicio);
    $viaje->set_tiempoEstimado($tiempo_estimado);
    $viaje->set_combustibleEstimado($combustible_estimado);
    $viaje->set_idCliente($idCliente);
    $viaje->set_idVehiculo($idVehiculo);
    $viaje->set_idVehiculoAcoplado($idVehiculoAcoplado);
    $viaje->set_idChofer($idChofer);
    $viaje->set_idChofer2($idChofer2);

    if($guardar)
    {
        $idViaje = $viaje->save();
        require_once 'libs/phpqrcode/qrlib.php';
        QRcode::png('http://localhost/TP-PW2/LogViaje?idViaje='.$idViaje ,
                        'qrImages/qrViaje_' . $idViaje . '.png');

    }

    if($editar || $eliminar)
    {
        $id = Helper::isPost('idViaje');
        $viaje->set_Id($id);

        if($editar)
            $rs = $viaje->save();
        else
            $rs = $viaje->delete();
    }


    if( (isset($rs) AND $rs == true) OR (isset($idViaje) AND $idViaje == true) )
    {
        echo "<script>
            window.location.href = 'index.php?page=viajes';
        </script>";
        die;
    }
}

?>
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Bienvenido a Viajes </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Viajes</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalViaje">Agregar</button>

        <div id="modalViaje" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Agregar Viaje</h4>
                    </div>

                    <div class="modal-body">

                        <form id="form-add" action="" method="POST">

                            <div class="form-group">
                                <label for="descripcion">Descripcion:</label>
                                <input type="text" name="descripcion" id="descripcion" class="form-control" required autocomplete="off">
                            </div>

                            <div class="form-group">
                                <label for="origen">Origen:</label>
                                <input type="text" name="origen" id="origen" class="form-control" required autocomplete="off">
                            </div>

                            <div class="form-group">
                                <label for="destino">Destino:</label>
                                <input type="text" name="destino" id="destino" class="form-control" required autocomplete="off">
                            </div>

                            <div class="form-group">
                                <label for="fecha_inicio">Fecha de Inicio:</label>
                                <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" required autocomplete="off">
                            </div>

                            <div class="form-group">
                                <label for="tiempo_estimado">Tiempo estimado:</label>
                                <input type="text" name="tiempo_estimado" id="tiempo_estimado" class="form-control" required autocomplete="off">
                            </div>

                            <div class="form-group">
                                <label for="combustible_estimado">Combustible estimado:</label>
                                <input type="text" name="combustible_estimado" id="combustible_estimado" class="form-control" required autocomplete="off" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                            </div>

                            <?php
                                $choferes = $viaje->getChoferes();
                                $clientes = $viaje->getClientes();
                                $vehiculos = $viaje->getVehiculos();
                                $vehiculosAcoplado = $viaje->getVehiculosAcoplado();
                            ?>

                            <div class="form-group">
                                <label for="idChofer">Chofer:</label>
                                <select name="idChofer" class="form-control" required="required" onchange="mostrar_chofer2(this.value, '#form-add')">
                                    <option value="">Seleccione un Chofer</option>
                                    <?php if (!empty ( $choferes )){ ?>
                                        <?php foreach( $choferes as $chofer ) { ?>
                                            <option value="<?php echo $chofer->id; ?>"><?php echo $chofer->apellido;?>, <?php echo $chofer->nombre; ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="idChofer2">Segundo Chofer: </label> <small> (Opcional)</small>
                                <select name="idChofer2" id="idChofer2" class="form-control">
                                    <option value="">Seleccione un segundo chofer</option>  <!-- Hacer AJAX para obtener lista de choferes diferentes al que selecciona en el select de chofer (onchange) -->
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="idCliente">Cliente:</label>
                                <select name="idCliente" class="form-control" required="required">
                                    <option value=""> Seleccione un Cliente </option>
                                    <?php foreach( $clientes as $cliente ) { ?>
                                        <option value="<?php echo $cliente->id; ?>"><?php echo $cliente->apellido;?>, <?php echo $cliente->nombre; ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="idVehiculo">Patente del Vehículo:</label>
                                <select name="idVehiculo" class="form-control" required="required">
                                    <option value=""> Seleccione un Vehículo </option>
                                    <?php foreach( $vehiculos as $vehiculo ) { ?>
                                        <option value="<?php echo $vehiculo->id; ?>">Patente: <?php echo $vehiculo->patente; ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="idVehiculoAcoplado">Patente del Vehículo Acoplado: </label><small> (Opcional)</small>
                                <select name="idVehiculoAcoplado" class="form-control">
                                    <option value=""> Seleccione un Vehículo Acoplado </option>
                                    <?php foreach( $vehiculosAcoplado as $vehiculo ) { ?>
                                        <option value="<?php echo $vehiculo->id; ?>">Patente: <?php echo $vehiculo->patente; ?></option>
                                    <?php } ?>
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

        <table id="tablaViajes">

            <thead>
                <tr>
                    <th>Descripcion</th>
                    <th>detalle</th>
                    <th>Visualizar</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>

            <?php
            $datos = $viaje->getAll();
            ?>

            <tbody>
                <?php if ( !empty($datos) ) { ?>
                    <?php foreach($datos as $dato): ?>

                    <tr>
                        <td><?php echo $dato->descripcion; ?></td>
                        <td>
                            <a href="index.php?page=detalle_viaje&idViaje=<?php echo $dato->id; ?>">
                                Detalle</a>
                        </td>
                        <td>
                            <a class="btn-modal-visualizar-viaje" href="#" data-toggle="modal"
                                data-target="#modalVisualizar"
                                data-id="<?php echo $dato->id; ?>"
                                data-descripcion="<?php echo $dato->descripcion; ?>"
                                data-origen="<?php echo $dato->origen ; ?>"
                                data-destino="<?php echo $dato->destino ; ?>"
                                data-fecha_inicio="<?php echo $dato->fecha_inicio ; ?>"
                                data-tiempo_estimado="<?php echo $dato->tiempo_estimado ; ?>"
                                data-combustible_estimado="<?php echo $dato->combustible_estimado ; ?>"
                                data-nombre_cliente="<?php echo $dato->nombre_cliente ; ?>"
                                data-apellido_cliente="<?php echo $dato->apellido_cliente ; ?>"
                                data-nombre_chofer="<?php echo $dato->nombre_chofer ; ?>"
                                data-apellido_chofer="<?php echo $dato->apellido_chofer ; ?>"
                                data-nombre_chofer2="<?php echo $dato->nombre_chofer2 ; ?>"
                                data-apellido_chofer2="<?php echo $dato->apellido_chofer2 ; ?>"
                                data-patente="<?php echo $dato->patente ; ?>"
                                data-patente_acoplado="<?php echo $dato->patente_acoplado; ?>">
                                <i class="fa fa-eye" aria-hidden="true"></i></a>
                        </td>
                        <td>
                            <a class="btn-modal-edit-viaje" href="#" data-toggle="modal"
                                data-target="#modalEdit"
                                data-id="<?php echo $dato->id; ?>"
                                data-descripcion="<?php echo $dato->descripcion; ?>"
                                data-origen="<?php echo $dato->origen ; ?>"
                                data-destino="<?php echo $dato->destino ; ?>"
                                data-fecha_inicio="<?php echo $dato->fecha_inicio ; ?>"
                                data-tiempo_estimado="<?php echo $dato->tiempo_estimado ; ?>"
                                data-combustible_estimado="<?php echo $dato->combustible_estimado ; ?>"
                                data-id_cliente="<?php echo $dato->id_cliente ; ?>"
                                data-id_chofer="<?php echo $dato->id_chofer ; ?>"
                                data-id_chofer2="<?php echo $dato->id_chofer2 ; ?>"
                                data-nombre_chofer2="<?php echo $dato->nombre_chofer2 ; ?>"
                                data-apellido_chofer2="<?php echo $dato->apellido_chofer2 ; ?>"
                                data-id_vehiculo="<?php echo $dato->id_vehiculo ; ?>"
                                data-id_vehiculo_acoplado="<?php echo $dato->id_vehiculoAcoplado ; ?>">
                                <i class="fa fa-pencil" aria-hidden="true"></i></a>
                        </td>
                        <td>
                            <a class="btn-modal-delete-viaje" href="#" data-toggle="modal"
                                data-target="#modalDelete"
                                data-id="<?php echo $dato->id; ?>">
                                <i class="fa fa-trash" aria-hidden="true"></i></a>
                        </td>
                    </tr>

                    <?php endforeach; ?>
                <?php } ?>
            </tbody>

        </table>

    </section><!-- /.content -->
</div>

<!-- Moda-Visualizar-Viaje -->
<div id="modalVisualizar" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Viaje</h4>
            </div>
            <form id="form-visualizar" method="POST">

                <div class="modal-body">
                    <legend>Datos Viaje</legend>

                    <div class="form-group">
                        <label for="descripcion">Descripcion:</label>
                        <input type="text" name="descripcion" id="descripcion" class="form-control" required autocomplete="off" readonly="readonly">
                    </div>

                    <div class="form-group">
                        <label for="origen">Origen:</label>
                        <input type="text" name="origen" id="origen" class="form-control" required autocomplete="off" readonly="readonly">
                    </div>

                    <div class="form-group">
                        <label for="destino">Destino:</label>
                        <input type="text" name="destino" id="destino" class="form-control" required autocomplete="off" readonly="readonly">
                    </div>

                    <div class="form-group">
                        <label for="fecha_inicio">Fecha de Inicio:</label>
                        <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" required autocomplete="off" readonly="readonly">
                    </div>

                    <div class="form-group">
                        <label for="tiempo_estimado">Tiempo estimado:</label>
                        <input type="text" name="tiempo_estimado" id="tiempo_estimado" class="form-control" required autocomplete="off" readonly="readonly">
                    </div>

                    <div class="form-group">
                        <label for="combustible_estimado">Combustible estimado:</label>
                        <input type="text" name="combustible_estimado" id="combustible_estimado" class="form-control" required autocomplete="off" readonly="readonly">
                    </div>

                    <div class="form-group">
                        <label for="id_cliente">Cliente:</label>
                        <input type="text" name="id_cliente" id="id_cliente" class="form-control" required autocomplete="off" readonly="readonly">
                    </div>

                    <div class="form-group">
                        <label for="id_chofer">Chofer:</label>
                        <input type="text" name="id_chofer" id="id_chofer" class="form-control" required autocomplete="off" readonly="readonly">
                    </div>

                    <div class="form-group">
                        <label for="id_chofer2">Segundo Chofer:</label>
                        <input type="text" name="id_chofer2" id="id_chofer2" class="form-control" autocomplete="off" readonly="readonly">
                    </div>

                    <div class="form-group">
                        <label for="id_vehiculo">Patente del Vehículo:</label>
                        <input type="text" name="id_vehiculo" id="id_vehiculo" class="form-control" required autocomplete="off" readonly="readonly">
                    </div>

                    <div class="form-group">
                        <label for="id_vehiculoAcoplado">Patente del Vehículo Acoplado:</label>
                        <input type="text" name="id_vehiculoAcoplado" id="id_vehiculoAcoplado" class="form-control" readonly="readonly">
                    </div>
                    <div class="form-group">
                         <label> QR </label>
                         <img id="qr" name="qr" src="">
                     </div>

                    <div class="modal-footer">  <!-- Footer -->
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>

                </div> <!-- End modal-body -->
            </form>
        </div>
    </div>
</div>
<!-- End-Modal-Visualizar-Viaje -->

<!-- Moda-Edit-Viaje -->
<div id="modalEdit" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Viaje</h4>
            </div>
            <form id="form-edit" method="POST">

                <div class="modal-body">
                    <legend>Datos Viaje</legend>

                    <div class="form-group">
                        <label for="descripcion">Descripcion:</label>
                        <input type="text" name="descripcion" id="descripcion" class="form-control" required autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label for="origen">Origen:</label>
                        <input type="text" name="origen" id="origen" class="form-control" required autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label for="destino">Destino:</label>
                        <input type="text" name="destino" id="destino" class="form-control" required autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label for="fecha_inicio">Fecha de Inicio:</label>
                        <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" required autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label for="tiempo_estimado">Tiempo estimado:</label>
                        <input type="text" name="tiempo_estimado" id="tiempo_estimado" class="form-control" required autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label for="combustible_estimado">Combustible estimado:</label>
                        <input type="text" name="combustible_estimado" id="combustible_estimado" class="form-control" required autocomplete="off" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                    </div>

                    <?php
                        $choferes = $viaje->getChoferes();
                        $clientes = $viaje->getClientes();
                        $vehiculos = $viaje->getVehiculos();
                        $vehiculosAcoplado = $viaje->getVehiculosAcoplado();
                    ?>

                   <div class="form-group">
                        <label for="idChofer">Chofer:</label>
                        <select name="idChofer" id="idChofer" class="form-control" required="required" onchange="mostrar_chofer2(this.value, '#form-edit')">
                            <option value="">Seleccione un Chofer</option>
                            <?php if (!empty ( $choferes )){ ?>
                                <?php foreach( $choferes as $chofer ) { ?>
                                    <option value="<?php echo $chofer->id; ?>"><?php echo $chofer->apellido;?>, <?php echo $chofer->nombre; ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="idChofer2">Segundo Chofer: </label> <small> (Opcional)</small>
                        <select name="idChofer2" id="idChofer2" class="form-control">
                            <option value="">Seleccione un segundo chofer</option>  <!-- Hacer AJAX para obtener lista de choferes diferentes al que selecciona en el select de chofer (onchange) -->
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="idCliente">Cliente:</label>
                        <select name="idCliente" id="idCliente" class="form-control" required="required">
                            <option value=""> Seleccione un Cliente </option>
                            <?php foreach( $clientes as $cliente ) { ?>
                                <option value="<?php echo $cliente->id; ?>"><?php echo $cliente->apellido;?>, <?php echo $cliente->nombre; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="idVehiculo">Patente del Vehículo:</label>
                        <select name="idVehiculo" id="idVehiculo" class="form-control" required="required">
                            <option value=""> Seleccione un Vehículo </option>
                            <?php foreach( $vehiculos as $vehiculo ) { ?>
                                <option value="<?php echo $vehiculo->id; ?>">Patente: <?php echo $vehiculo->patente; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="idVehiculoAcoplado">Patente del Vehículo Acoplado: </label><small> (Opcional)</small>
                        <select name="idVehiculoAcoplado" id="idVehiculoAcoplado" class="form-control">
                            <option value=""> Seleccione un Vehículo </option>
                            <?php foreach( $vehiculosAcoplado as $vehiculo ) { ?>
                                <option value="<?php echo $vehiculo->id; ?>">Patente: <?php echo $vehiculo->patente; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <input type="hidden" name="idViaje" id="idViaje">

                    <div class="modal-footer">  <!-- Footer -->
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <input type="submit" name="editar" class="btn btn-success" value="Actualizar">
                    </div>

                </div> <!-- End modal-body -->
            </form>
        </div>
    </div>
</div>
<!-- End-Modal-Edit-Viaje -->

<!-- Modal-Delete-Viaje -->
<div id="modalDelete" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Eliminar Viaje</h4>
            </div>
            <form id="form-delete" method="POST">

                <input type="hidden" name="idViaje" id="idViaje">

                <div class="modal-body">
                    <p>Desea eliminar el viaje ?</p>
                </div> <!-- End modal-body -->

                <div class="modal-footer">  <!-- Footer -->
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <input type="submit" name="eliminar" class="btn btn-danger" value="Eliminar">
                </div>

            </form>
        </div>
    </div>
</div>
<!-- End-Modal-Delete-Viaje -->
