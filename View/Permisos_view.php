<?php
print_r($_POST);
if($_SERVER['REQUEST_METHOD'] === "POST") {
    echo "ENTRE";
    switch( $_POST["work"] ){
        case 'create':
            $idModulo = Helper::isPost('id_Modulo');
            $idRol = Helper::isPost('id_Rol');
            $permiso = new Permiso();
            $permiso->setIdModulo($idModulo);
            $permiso->setIdRol($idRol);
            $permiso->save();
            break;
        case 'delete':
            $idPermiso = Helper::isPost('id_permiso');
            Permiso::delete($idPermiso);
            break;
    }
}

$listaRoles = Rol::getAll();
$listaModulos = Modulo::getAll();
$listPermisos = Permiso::getAll();
?>

<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Bienvenido a Permiso </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Permisos</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalRol">Agregar</button>

        <table>
            <thead>
                <tr>
                    <th>Descripcion del Rol</th>
                    <th>Descripcion del Modulo</th>
                    <th>borrar</th>
                </tr>
            </thead>
        <tbody>
            <?php foreach($listPermisos as $permiso) { ?>
                <tr>
                    <td><?php echo $permiso->rolDescripcion ; ?></td>
                    <td><?php echo $permiso->moduloDescripcion ; ?></td>
                    <td>
                        <a class="btn-modal-delete-permiso" href="#" data-toggle="modal"
                            data-target="#modalDelete"
                            data-id="<?php echo $permiso->id; ?>">
                            <i class="fa fa-trash" aria-hidden="true"></i></a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>

    </section><!-- /.content -->
</div>


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
                    <input type="hidden" name="work" value="create">

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
                <input type="hidden" name="idPermiso" id="idPermiso" value="">
                <div class="modal-body">
                    <p>Esta seguro que desea eliminar este permiso??</p>
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
