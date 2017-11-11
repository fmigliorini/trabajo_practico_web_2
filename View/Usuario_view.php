<?php

if( $_SERVER['REQUEST_METHOD'] === "POST" ) {

    $idUsuario = Helper::isPost('idUser');
    $usuario = Helper::isPost('usuario');
    $clave = Helper::isPost('clave');
    $idRol = Helper::isPost('idRol');
    $idEmpleado = Helper::isPost('idEmpleado');

    switch( $_POST["work"] ){
        case 'create':
            $usuario = new Usuario($username,$password,$idEmployed,$idRol);
            $usuario->setUsuario($usuario);
            $usuario->setClave($clave);
            $usuario->setIdEmpleado($idEmpleado);
            $usuario->setIdRol($idRol);
            $user->save();
            break;
        case 'edit':
            $usuario = Usuario::getById($idUsuario);
            $usuario->setUsuario($usuario);
            $usuario->setIdRol($idRol);
            $user->save();
            break;
        default:
            echo "EMPTY";
            break;
    }

}


// obtener roles
$listaRoles = Rol::getAll();
$listUsuarios = Usuario::getAll();
$empleadoSinUsuario = Empleado::getEmpleadoSinUsuario();
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
                    <th>Usuario</th>
                    <th>Rol</th>
                    <th>Estado</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>DNI</th>
                    <th>editar</th>
                    <th>Borrar</th>

                </tr>
            </thead>

            <tbody>
            <?php

                foreach($listUsuarios as $usuario) {  ?>

                    <tr>
                        <td><?php echo $usuario->usuario ; ?></td>
                        <td><?php echo $usuario->rol_descripcion ; ?></td>
                        <td><?php echo $usuario->estado; ?></td>
                        <td><?php echo $usuario->empleado_nombre; ?></td>
                        <td><?php echo $usuario->empleado_apellido; ?></td>
                        <td><?php echo $usuario->empleado_numero_documento; ?></td>
                        <td>
                            <a href="#" data-toggle="modal"
                                data-target="#modalEdit">
                                <i class="fa fa-pencil" aria-hidden="true"></i></a>
                        </td>
                        <td>
                            <a href="#" data-toggle="modal"
                                data-target="#modalDelete">
                                <i class="fa fa-trash" aria-hidden="true"></i></a>
                        </td>
                    </tr>

                <?php } ?>

            </tbody>

        </table>

    </section><!-- /.content -->
</div>


<!-- Agregar nuevo usuario -->
<div id="modalCreate" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Generar Usuario</h4>
            </div
            <?php if (count($empleadoSinUsuario) > 0){?>
                <form method="POST">
                    <input type="hidden" name="work" value="create">
                    <div class="modal-body">
                        <legend>Datos Usuario</legend>
                        <div class="form-group">
                            <label for="rol">Empleado</label>
                            <select name="idEmpleado" class="form-control" required="required">
                                <option value=""> Seleccione un Empleado </<option>
                                <?php foreach( $empleadoSinUsuario as $empleado ) { ?>
                                    <option value="<?php echo $empleado->id; ?>">
                                        <?php echo $empleado->apellido;?>, <?php echo $empleado->nombre; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="usuario">Usuario</label>
                            <input type="text" name="usuario" id="usuario" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="clave">Clave</label>
                            <input type="text" name="clave" id="clave" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="rol">Rol</label>
                            <select name="idRol" class="form-control" required>
                                <option value=""> Seleccione un Rol </<option>
                                <?php foreach( $listaRoles as $rol ) { ?>
                                    <option value="<?php echo $rol->id; ?>"><?php echo $rol->descripcion;?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="modal-footer">  <!-- Footer -->
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            <input type="submit" name="guardar" class="btn btn-success">
                        </div>
                    </div> <!-- End modal-body -->
                </form>
            <?php } else{ ?>
                <div class="modal-body">
                    <p>Actualmente todos sus empleados ya poseen un usuario </p>
                </div>
                <div class="modal-footer">  <!-- Footer -->
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            <?php } ?>

        </div>
    </div>
</div>
<!-- Final Agregar nuevo usuario -->

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
                <input type="hidden" name="work" value="edit">
                <input type="hidden" name="idUsuario" id="idUsuario" value="">
                <div class="modal-body">
                    <legend>Datos Usuario</legend>
                    <div class="form-group">
                        <label for="usuario">Usuario</label>
                        <input type="text" name="usuario" id="usuario" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="rol">Rol</label>
                        <select name="idRol" class="form-control" required>
                            <option value=""> Seleccione un Rol </<option>
                            <?php foreach( $listaRoles as $rol ) { ?>
                                <option value="<?php echo $rol->id; ?>"><?php echo $rol->descripcion;?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="modal-footer">  <!-- Footer -->
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <input type="submit" name="guardar" class="btn btn-success">
                    </div>
                </div> <!-- End modal-body -->
            </form>
        </div>
    </div>
</div>
<!-- End-Modal-Edit-Usuario -->

<!-- Modal-Delete-Usuario -->
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
                <input type="hidden" name="idUsuario" id="idUsuario" value="">
                <div class="modal-body">
                    <p>Desactivar usuario : <span id="usuario"></span></p>
                </div> <!-- End modal-body -->
                <div class="modal-footer">  <!-- Footer -->
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <input type="button" class="btn btn-danger" value="Eliminar">
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End-Modal-Delete-Usuario -->
