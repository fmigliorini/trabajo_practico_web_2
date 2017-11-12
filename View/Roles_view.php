<!-- Content Wrapper. Contains page content -->

<?php require_once "models/Rol_model.php";
if($_SERVER['REQUEST_METHOD'] === "POST") :

    $descripcion = trim($_POST['rol']);

    if(isset($_POST['guardar']) && $descripcion != ''):

        $rol = new Rol(null, $descripcion);
        $rs = $rol->save();

    endif;

    if(isset($_POST['editar']) && $descripcion != '') :

        $rol = new Rol($_POST['id'], $descripcion);
        $rs = $rol->save();

    endif;

    if($rs)
    {
        header('location: index.php?page=roles');
        die;
    }

endif;


if(isset($_GET['delete'])) :

    $rol = new Rol($_GET['delete'], null);
    $rol->removeRol();

endif;

?>

<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Bienvenido a Roles </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Roles</a></li>
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
                        <h4 class="modal-title">Agregar Rol</h4>
                    </div>

                    <div class="modal-body">

                        <form action="" method="POST">

                            <div class="form-group">
                                <label for="rol">Nombre del rol:</label>
                                <input type="text" name="rol" id="rol" class="form-control" required>
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

        <table id="tablaRoles">

            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>

            <tbody>
            <?php
                $rol = new Rol();
                $datos = $rol->getRoles();

                foreach($datos as $dato) : ?>

                    <tr>
                        <td><?php echo $dato->descripcion ; ?></td>
                        <td>
                            <a href="#" data-toggle="modal" data-target="#modalEditRol<?php echo $dato->id; ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>

                            <div id="modalEditRol<?php echo $dato->id; ?>" class="modal fade" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Editar Rol</h4>
                                        </div>

                                        <div class="modal-body">

                                            <?php
                                                $rol = new Rol($dato->id, null);
                                                $row = $rol->getRol();
                                                //echo json_encode($row[0]);
                                            ?>

                                            <form action="" method="POST">

                                                <div class="form-group">
                                                    <label for="rol">Nombre del rol:</label>
                                                    <input type="text" name="rol" id="rol" class="form-control" value="<?php echo $row[0]->descripcion; ?>" required>
                                                </div>

                                                <div class="modal-footer">  <!-- Footer -->
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                                    <input type="hidden" name="id" value="<?php echo $row[0]->id; ?>">
                                                    <input type="submit" name="editar" class="btn btn-success" value="Editar">
                                                </div>

                                            </form>

                                        </div> <!-- End modal-body -->

                                    </div>
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

                <?php endforeach ?>

            </tbody>

        </table>

    </section><!-- /.content -->
</div>
