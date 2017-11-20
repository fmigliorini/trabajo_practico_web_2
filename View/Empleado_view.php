
<?php
if( $_SERVER['REQUEST_METHOD'] === "POST" ) {
    switch( $_POST["work"] ){
        case 'create':
            $nombre = Helper::isPost('nombre');
            $apellido = Helper::isPost('apellido');
            $telefono = Helper::isPost('telefono');
            $dni = Helper::isPost('dni');
            $empleado = new Empleado();
            $empleado->setNombre($nombre);
            $empleado->setApellido($apellido);
            $empleado->setDni($dni);
            $empleado->setTelefono($telefono);
            if ( $empleado->save() ) {
                // ALL OK
            }
            break;
        case 'edit':
            $idEmpleado = Helper::isPost('idEmpleado');
            $empleado = Empleado::getById($idEmpleado);
            if ( $empleado ) {
                $nombre = Helper::isPost('nombre');
                $apellido = Helper::isPost('apellido');
                $telefono = Helper::isPost('telefono');
                $dni = Helper::isPost('dni');
                $empleado->setNombre($nombre);
                $empleado->setApellido($apellido);
                $empleado->setTelefono($telefono);
                $empleado->setDni($dni);
                if ( $empleado->save() ) {
                    // all ok
                }
            }
            break;
        default:
            echo "EMPTY";
            break;
    }

}


// obtener roles
$listEmpleado = Empleado::getAll();
?>

<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Bienvenido a Usuarios </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Usuarios</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCreate">Agregar</button>



        <table id="tablaRoles">

            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Número Documento</th>
                    <th>teléfono</th>
                    <th>editar</th>
                </tr>
            </thead>

            <tbody>
            <?php
                if ( !empty($listEmpleado) ){
                    foreach($listEmpleado as $empleado) {  ?>
                    <tr>
                        <td><?php echo $empleado->nombre ; ?></td>
                        <td><?php echo $empleado->apellido ; ?></td>
                        <td><?php echo $empleado->telefono ; ?></td>
                        <td><?php echo $empleado->numeroDocumento ; ?></td>
                        <td>
                            <a class="btn-modal-edit-empleado" href="#"
                                data-toggle="modal"
                                data-target="#modalEdit"
                                data-id="<?php echo $empleado->id; ?>"
                                data-nombre="<?php echo $empleado->nombre; ?>"
                                data-apellido="<?php echo $empleado->apellido; ?>"
                                data-telefono="<?php echo $empleado->telefono; ?>"
                                data-dni="<?php echo $empleado->numeroDocumento; ?>">
                                <i class="fa fa-pencil"
                                aria-hidden="true"
                                ></i></a>
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
                <h4 class="modal-title">Empleado</h4>
            </div>
            <form method="POST">
                <input type="hidden" name="work" value="create">
                <div class="modal-body">
                    <legend>Datos Empleado</legend>
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="surname">Apellido</label>
                        <input type="text" name="apellido" id="apellido" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Teléfono</label>
                        <input type="text" name="telefono" id="telefono" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="dni">DNI</label>
                        <input type="text" name="dni" id="dni" class="form-control" required>
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
                <input type="hidden" name="idEmpleado" id="idEmpleado" value="">
                <div class="modal-body">
                    <legend>Datos Empleado</legend>
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="surname">Apellido</label>
                        <input type="text" name="apellido" id="apellido" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Teléfono</label>
                        <input type="text" name="telefono" id="telefono" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="dni">DNI</label>
                        <input type="text" name="dni" id="dni" class="form-control" required>
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
                <h4 class="modal-title">Eliminar Empleaod</h4>
            </div>
            <form id="form-delete" method="POST">
                <input type="hidden" name="work" id="work" value="delete">
                <input type="hidden" name="idEmpleado" id="idEmpleado" value="">
                <div class="modal-body">
                    <p>Desea eliminar el Empleado : <span id="dni"></span></p>
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
