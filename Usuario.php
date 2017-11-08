<?php

require_once "models/Usuario.php";
require_once "models/Rol.php";
require_once "models/Empleado.php";

if( $_SERVER['REQUEST_METHOD'] === "POST" ) {
    switch( $_POST["work"] ){
        case 'create':
            // EMPLEADO DATA
            $name = Helper::isPost('name');
            $surname = Helper::isPost('surname');
            $phone = Helper::isPost('phone');
            $dni = Helper::isPost('dni');

            // USUARIO DATA
            $username = Helper::isPost('username');
            $password = Helper::isPost('password');
            $idRol = Helper::isPost('idRol');

            $employed = new Empleado(null,$name,$surname,$dni,$phone);
            $idEmployed = $employed->save();
            var_dump($idEmployed);
            $user = new Usuario(null,$username,$password,$idEmployed,$idRol);
            $user->save();
            break;
        case 'edit':
            // EMPLEADO DATA
            $idEmpleado = Helper::isPost('idEmpleado');
            $name = Helper::isPost('name');
            $surname = Helper::isPost('surname');
            $phone = Helper::isPost('phone');
            $dni = Helper::isPost('dni');

            // USUARIO DATA
            $idUser = Helper::isPost('idUser');
            $username = Helper::isPost('username');
            $password = Helper::isPost('password');
            $idRol = Helper::isPost('idRol');

            $employed = new Empleado(null,$name,$surname,$dni,$phone);
            $idEmployed = $employed->save();
            var_dump($idEmployed);
            $user = new Usuario(null,$username,$password,$idEmployed,$idRol);
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

        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalRol">Agregar</button>

        <div id="modalRol" class="modal fade" role="dialog">
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
                        <div class="modal-body">
                            <legend>Datos Usuario</legend>
                            <div class="form-group">
                                <label for="username">Usuario</label>
                                <input type="text" name="username" id="username" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Clave</label>
                                <input type="text" name="password" id="password" class="form-control" required>
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

        <table id="tablaRoles">

            <thead>
                <tr>
                    <th>Usuario</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Numero Documento</th>
                    <th>teléfono</th>
                    <th>Rol</th>
                    <th>editar</th>
                    <th>Borrar</th>

                </tr>
            </thead>

            <tbody>
            <?php

                foreach($listUsuarios as $usuario) {  ?>

                    <tr>
                        <td><?php echo $usuario->usuario ; ?></td>
                        <td><?php echo $usuario->nombre ; ?></td>
                        <td><?php echo $usuario->apellido ; ?></td>
                        <td><?php echo $usuario->telefono ; ?></td>
                        <td><?php echo $usuario->numeroDocumento ; ?></td>
                        <td><?php echo $usuario->descripcion ; ?></td>
                        
                        <td>
                            <a href="#" data-toggle="modal" data-target="#modalEditRol<?php echo $usuario->id; ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>

                            <div id="modalEditRol<?php echo $dato->id; ?>" class="modal fade" role="dialog">
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
                                        <div class="modal-body">
                                            <legend>Datos Usuario</legend>
                                            <div class="form-group">
                                                <label for="username">Usuario</label>
                                                <input type="text" name="username" id="username" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="password">Clave</label>
                                                <input type="text" name="password" id="password" class="form-control" required>
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

                        </td>

                        <td>
                            <a href="#" data-toggle="modal" data-target="#modalDeleteRol<?php echo $dato->id; ?>"><i class="fa fa-trash" aria-hidden="true"></i></a>  <!-- Acuerdense que el nombre del modal tiene que ser UNICO. Por eso le paso el id del rol al final del nombre. -->

                            <div id="modalDeleteRol<?php echo $dato->id; ?>" class="modal fade" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Eliminar Rol</h4>
                                        </div>

                                        <div class="modal-body">

                                            <p>Desea eliminar el rol <?php echo $dato->descripcion; ?> ? </p>

                                        </div> <!-- End modal-body -->

                                        <div class="modal-footer">  <!-- Footer -->
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                            <input type="button" class="btn btn-danger" value="Eliminar" onclick="window.location.href = 'index.php?page=roles&delete=<?php echo $dato->id; ?>';">
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>

                <?php } ?>

            </tbody>

        </table>

    </section><!-- /.content -->
</div>
