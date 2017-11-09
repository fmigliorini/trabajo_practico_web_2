    <?php

if( $_SERVER['REQUEST_METHOD'] === "POST" ) {
    switch( $_POST["work"] ){
        case 'create':
            $nombre = Helper::isPost('nombre');
            $apellido = Helper::isPost('apellido');
            $telefono = Helper::isPost('telefono');
            $dni = Helper::isPost('dni');
            $emplaedo = new Empleado($nombre, $apellido, $telefono, $dni);
            if ( $emplaedo->save() ) {
                // ALL OK
            }
            break;
        case 'edit':
            $idEmpleado = Helper::isPost('idEmpleado');
            $empleado = Empleado::getById($idEmployed);
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
                    <th>Borrar</th>

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
                            <a href="#" data-toggle="modal" data-target="#modalEdit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                        </td>
                        <td>
                            <a href="#" data-toggle="modal" data-target="#modalDelete"><i class="fa fa-trash" aria-hidden="true"></i></a><!-- modal delete -->
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
                <h4 class="modal-title">Usuario</h4>
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
            <form method="POST">
                <input type="hidden" name="work" value="create">
                <input type="hidden" name="id" value="create">
                <div class="modal-body">
                    <legend>Datos Empleado</legend>
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="surname">Apellido</label>
                        <input type="text" name="surname" id="surname" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Teléfono</label>
                        <input type="text" name="phone" id="phone" class="form-control" required>
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
<div id="modalDeleteRol<?php echo $dato->id; ?>" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Eliminar Empleaod</h4>
            </div>
            <div class="modal-body">
                <p>Desea eliminar el Empleado <span id=""></span></p>
            </div> <!-- End modal-body -->
            <form method="POST">
                <input type="hidden" name="id" id="id" value="">
                <div class="modal-footer">  <!-- Footer -->
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <input type="button" class="btn btn-danger" value="Eliminar">
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End-Modal-Delete-Empleado -->
