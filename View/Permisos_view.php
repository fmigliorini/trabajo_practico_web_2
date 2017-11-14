<?php require_once "models/Permiso_Model.php";
if( $_SERVER['REQUEST_METHOD'] === "POST" ) {
    switch( $_POST["work"] ){
        case 'create':
            $modulo = Helper::isPost('modulo');
            $rol = Helper::isPost('rol');
            $permiso = new Permiso();
            $permiso->setModulo($modulo);
            $permiso->setRol($rol);

            if ( $empleado->save() ) {
                // ALL OK
            }
            break;
        case 'edit':
            $idPermiso = Helper::isPost('idPermiso');
            $permiso = Permiso::getById($idPermiso);
            if ( $permiso ) {
              $modulo = Helper::isPost('modulo');
              $rol = Helper::isPost('rol');
              $permiso = new Permiso();
              $permiso->setModulo($modulo);
              $permiso->setRol($rol);

              if ( $empleado->save() ) {
                  // ALL OK
              }
            }
            break;
        default:
            echo "EMPTY";
            break;
    }

}


$listaRoles = Rol::getAll();
$listaModulos= Modulo::getAll();
$listPermisos= Permiso::getAll();
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

        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCreate">Agregar</button>



        <table id="tablaPermisos">

            <thead>
                <tr>
                    <th>Rol</th>
                    <th>Modulo</th>
                    <th>editar</th>
                    <th>Borrar</th>

                </tr>
            </thead>

            <tbody>
            <?php
                if ( !empty($listPermisos) ){
                    foreach($listPermisos as $permiso) {  ?>
                    <tr>
                        <td><?php echo $permiso->id_Rol ; ?></td>
                        <td><?php echo $permiso->id_Modulo ; ?></td>
                        <td>
                            <a class="btn-modal-edit-permiso" href="#"
                                data-toggle="modal"
                                data-target="#modalEdit"
                                data-id="<?php echo $permiso->id; ?>"
                                data-nombre="<?php echo $permiso->id_Rol; ?>"
                                data-dni="<?php echo $permiso->id_Modulo; ?>">
                                <i class="fa fa-pencil"
                                aria-hidden="true"
                                ></i></a>
                        </td>
                        <td>
                            <a class="btn-modal-delete-permiso" href="#"
                                data-toggle="modal"
                                data-target="#modalDelete"
                                data-id="<?php echo $permiso->id; ?>">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </a><!-- modal delete -->
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

  <!-- Modal-alta-Permiso -->
<div id="modalCreate" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Crear Permiso</h4>
            </div>
            <form  method="POST">

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

  <!-- Modal-editar-permiso -->
<div id="modalEdit" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Editar Permiso</h4>
            </div>
            <form id="form-edit" method="POST">

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



  <!-- Modal-Delete-Usuario -->
  <div id="modalDelete" class="modal fade" role="dialog">
      <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Eliminar Empleado</h4>
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


  <!-- Modal-borrar-permiso -->
  <div id="modalDelete" class="modal fade" role="dialog">
      <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Eliminar Empleado</h4>
              </div>
              <form id="form-delete" method="POST">
                  <input type="hidden" name="work" id="work" value="delete">
                  <input type="hidden" name="idPermiso" id="idPermiso" value="">
                  <div class="modal-body">
                      <p>Eliminar Permiso : <span id="usuario"></span></p>
                  </div> <!-- End modal-body -->
                  <div class="modal-footer">  <!-- Footer -->
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                      <input type="button" class="btn btn-danger" value="Eliminar">
                  </div>
              </form>
          </div>
      </div>
  </div>
