
<?php
$cliente = new Cliente_model();

if($_SERVER['REQUEST_METHOD'] === "POST")
{
    $nombre = Helper::isPost('nombre');
    $apellido = Helper::isPost('apellido');
    $compania = Helper::isPost('compania');

    $guardar = Helper::isPost('guardar');
    $editar = Helper::isPost('editar');
    $eliminar = Helper::isPost('eliminar');

    $cliente->setNombre($nombre);
    $cliente->setApellido($apellido);
    $cliente->setCompania($compania);

    if($guardar)
    {
        $rs = $cliente->save();
    }

    if($editar || $eliminar)
    {
        $id = Helper::isPost('idCliente');
        $cliente->setId($id);

        if($editar)
            $rs = $cliente->save();
        else
            $rs = $cliente->delete();
    }


    if($rs)
    {
        header('location: index.php?page=clientes');
        die;
    }
}


?>
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Bienvenido a Clientes </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Clientes</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCliente">Agregar</button>

        <div id="modalCliente" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Agregar Cliente</h4>
                    </div>

                    <div class="modal-body">

                        <form action="" method="POST">

                            <div class="form-group">
                                <label for="nombre">Nombre:</label>
                                <input type="text" name="nombre" id="nombre" class="form-control" required autocomplete="off">
                            </div>

                            <div class="form-group">
                                <label for="apellido">Apellido:</label>
                                <input type="text" name="apellido" id="apellido" class="form-control" required autocomplete="off">
                            </div>

                            <div class="form-group">
                                <label for="compania">Compania:</label>
                                <input type="text" name="compania" id="compania" class="form-control" required autocomplete="off">
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
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Compania</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>

            <?php 
            $datos = $cliente->getAll();
            ?>

            <tbody>

                <?php foreach($datos as $dato) : ?>
            
                <tr>
                    <td><?php echo $dato->nombre; ?></td>
                    <td><?php echo $dato->apellido; ?></td>
                    <td><?php echo $dato->compania; ?></td>
                    <td>
                        <a class="btn-modal-edit-cliente" href="#" data-toggle="modal"
                            data-target="#modalEdit"
                            data-id="<?php echo $dato->id; ?>"
                            data-nombre="<?php echo $dato->nombre; ?>"
                            data-apellido="<?php echo $dato->apellido ; ?>"
                            data-compania="<?php echo $dato->compania ; ?>">
                            <i class="fa fa-pencil" aria-hidden="true"></i></a>
                    </td>
                    <td>
                        <a class="btn-modal-delete-cliente" href="#" data-toggle="modal"
                            data-target="#modalDelete"
                            data-id="<?php echo $dato->id; ?>"
                            data-nombre="<?php echo $dato->nombre; ?>"
                            data-apellido="<?php echo $dato->apellido; ?>">
                            <i class="fa fa-trash" aria-hidden="true"></i></a>
                    </td>
                </tr>

                <?php endforeach; ?>

            </tbody>

        </table>

    </section><!-- /.content -->
</div>

<!-- Moda-Edit-Cliente -->
<div id="modalEdit" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Cliente</h4>
            </div>
            <form id="form-edit" method="POST">

                <div class="modal-body">
                    <legend>Datos Cliente</legend>

                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" required autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label for="apellido">Apellido:</label>
                        <input type="text" name="apellido" id="apellido" class="form-control" required autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label for="compania">Compania:</label>
                        <input type="text" name="compania" id="compania" class="form-control" required autocomplete="off">
                    </div>

                    <input type="hidden" name="idCliente" id="idCliente">

                    <div class="modal-footer">  <!-- Footer -->
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <input type="submit" name="editar" class="btn btn-success" value="Actualizar">
                    </div>

                </div> <!-- End modal-body -->
            </form>
        </div>
    </div>
</div>
<!-- End-Modal-Edit-Cliente -->

<!-- Modal-Delete-Cliente -->
<div id="modalDelete" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Eliminar Cliente</h4>
            </div>
            <form id="form-delete" method="POST">

                <input type="hidden" name="idCliente" id="idCliente">

                <div class="modal-body">
                    <p>Desea eliminar el Cliente : <span id="nombre"></span> <span id="apellido"></span> ?</p>
                </div> <!-- End modal-body -->

                <div class="modal-footer">  <!-- Footer -->
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <input type="submit" name="eliminar" class="btn btn-danger" value="Eliminar">
                </div>

            </form>
        </div>
    </div>
</div>
<!-- End-Modal-Delete-Cliente -->