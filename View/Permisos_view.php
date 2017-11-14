<?php require_once "models/Rol_model.php";
if($_SERVER['REQUEST_METHOD'] === "POST") :

$id_Rol = Helper::isPost('id_Rol');
$id_Modulo = Helper::isPost('id_Modulo');

    if(isset($_POST['guardar'])&& ($id_Modulo != ''&& $id_Modulo >0)&&($id_Rol != ''&& $id_Rol >0)):

        $perimiso = new Perimiso(null, $id_Modulo,$id_Rol);
        $rs = $perimiso->save();

    endif;

    if(isset($_POST['editar']) && ($id_Modulo != ''&& $id_Modulo >0)&&($id_Rol != ''&& $id_Rol >0)) :

        $perimiso = new Perimiso($_POST['id'], $id_Modulo,$id_Rol);
        $rs = $perimiso->save();

    endif;

    if($rs)
    {
        echo '<script>
            window.location.href = "index.php?page=permisos"
        </script>';
        die;
    }

endif;


if(isset($_GET['delete'])) :

    $perimiso = new Perimiso($_GET['delete'], null);
    $rs = $perimiso->removePerimiso();

    if($rs)
    {
        echo '<script>
            window.location.href = "index.php?page=permisos"
        </script>';
        die;
    }

endif;

$listaRoles = Rol::getAll();
$listaModulos= Modulo::getAll();
//$listPermisos= Permiso::getAll();
?>

<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Bienvenido a Permisos </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Permisos</a></li>
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
                        <h4 class="modal-title">Agregar Permiso</h4>
                    </div>

                    <div class="modal-body">

                        <form action="" method="POST">

                            <div class="form-group">
                              <label for="modulo">Modulo</label>
                              <select name="id_Modulo" class="form-control" required="required">
                                  <option value=""> Seleccione un Modulo </<option>
                                  <?php foreach( $listaModulos as $modulo ) { ?>
                                      <option value="<?php echo $modulo->id; ?>">
                                         <?php echo $modulo->id; ?> - <?php echo $modulo->descripcion;?>
                                      </option>
                                  <?php } ?>
                              </select>

                            </div>

                            <div class="form-group">
                              <label for="rol">Rol</label>
                              <select name="id_Rol" class="form-control" required="required">
                                  <option value=""> Seleccione un Modulo </<option>
                                  <?php foreach( $listaRoles as $rol ) { ?>
                                      <option value="<?php echo $rol->id; ?>">
                                         <?php echo $rol->id; ?> - <?php echo $rol->descripcion;?>
                                      </option>
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
  <!--    <tbody>
        <?php

            foreach($listPermisos as $permiso) {  ?>

                <tr>
                    <td><?php echo $permiso->id_Rol ; ?></td>
                    <td><?php echo $permiso->id_Modulo ; ?></td>

                    <td>
                        <a class="btn-modal-edit-permiso" href="#" data-toggle="modal"
                            data-target="#modalEdit"
                            data-modulo="<?php echo $permiso->id_Modulo; ?>"
                            data-id="<?php echo $permiso->id; ?>"
                            data-rol="<?php echo $permiso->rol_id ; ?>">
                            <i class="fa fa-pencil" aria-hidden="true"></i></a>
                    </td>
                    <td>
                        <a class="btn-modal-delete-permiso" href="#" data-toggle="modal"
                            data-target="#modalDelete"
                            data-id="<?php echo $usuario->id; ?>">
                            <i class="fa fa-trash" aria-hidden="true"></i></a>
                    </td>
                </tr>

            <?php } ?>

        </tbody> -->

    </section><!-- /.content -->
</div>
