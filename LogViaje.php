<?php

require_once "templates/head.php";
require_once "Helper.php";


require_once "models/LogViaje_model.php";
require_once "models/Viaje_model.php";

$idViaje = Helper::isGet('idViaje');
if ( empty($idViaje ) || !Viaje_model::existe($idViaje) || !Viaje_model::activo($idViaje) ){
        echo "<span style='text-align:center;'> Viaje no disponible o finalizado </span>"; exit;
}

session_start();
if ( isset( $_SESSION['authenticate'] ) && $_SESSION['authenticate'] === true
        && isset( $_SESSION['id'] ) && $_SESSION['id'] !== "" ) {
            $idChofer = $_SESSION['id'];
}else{
    header('Location: login.php?callback=LogViaje.php?idViaje='.$idViaje);
    exit;
}

if( $_SERVER['REQUEST_METHOD'] === "POST" ) {
    switch( $_POST["work"] ){
        case 'create':
            $logViaje = new LogViaje();
            $logViaje->setRazon(Helper::isPost('razon'));
            $logViaje->setFecha(Helper::isPost('fecha'));
            $logViaje->setLatitud(Helper::isPost('latitud'));
            $logViaje->setLongitud(Helper::isPost('longitud'));
            $logViaje->setdetalle(Helper::isPost('detalle'));
            $logViaje->setCombustible(Helper::isPost('combustible'));
            $logViaje->setKilometros(Helper::isPost('kilometros'));
            $logViaje->setPrecio(Helper::isPost('precio'));
            $logViaje->setIdViaje(Helper::isPost('idViaje'));
            $logViaje->setIdChofer(Helper::isPost('idChofer'));
            $logViaje->save();
            break;
        case 'finalizar':
            if ( Viaje_model::finalizar($idViaje) ) {
                echo "Viaje Finalizado"; exit;
            }

            break;

    }
}
?>


    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1> Log Viaje </h1>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

        <form method="POST">
            <input type="hidden" name="work" value="create">
            <input type="hidden" name="idViaje" value="<?php echo $idViaje; ?>">
            <input type="hidden" name="idChofer" value="<?php echo $idChofer; ?>">
            <input type="hidden" name="fecha" value="<?php echo date('Y-m-d H:i:s'); ?>">
            <input type="hidden" id="latitud" name="latitud" value=""> <!-- se carga con js -->
            <input type="hidden" id="longitud" name="longitud" value=""> <!-- se carga con js -->

            <div class="modal-body">
                <legend>Reportar de Viaje</legend>
                <div class="form-group">
                    <div id="mapa"></div>
                </div>
                <div class="form-group">
                    <label for="surname">Razon</label>
                    <select name="razon" id="razon" class="form-control">
                        <option value="Siniestro">Siniestro</option>
                        <option value="Desvio">Desvio</option>
                        <option value="averia">Problemas con el vehiculo</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="kilometros">Kilometros</label>
                    <input type="text" name="kilometros" id="kilometros" class="form-control" >
                </div>
                <div class="form-group">
                    <label for="combustible">Combustible</label>
                    <input type="text" name="combustible" id="combustible" class="form-control" >
                </div>
                <div class="form-group">
                    <label for="precio">Precio</label>
                    <input type="number" min="1" name="precio" id="precio" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="detalle">Detalle</label>
                    <input type="text" name="detalle" id="detalle" class="form-control" required>
                </div>
            </div>
            <div class="modal-footer">  <!-- Footer -->
                <input type="submit" name="Crear" class="btn btn-success">
            </div>
        </form>

    </section><!-- /.content -->

    <!-- Content Header (Page header) -->

    <section class="content-header">
        <h1> Finalizar Viaje </h1>

        <div class="form-group">
            <form method="POST">
                <input type="hidden" name="work" value="finalizar">
                <input type="hidden" name="idViaje" value="<?php echo $idViaje; ?>">
                <input type="hidden" name="fecha" value="<?php echo date('Y-m-d H:i:s'); ?>">
                <input type="submit" value="FINALIZAR VIAJE" class="btn btn-danger col-xs-12">
            </form>
        </div>
        <p><strong> Advertencia: una vez finalizado el viaje, no podra volver a cargar datos </strong></p>
    </section>

<?php require_once "templates/footer.php"; ?>
<script src="https://maps.google.com/maps/api/js?key=AIzaSyAm142j63X1B_Dn7YZHM5cnHi5XpI4qYAY"></script>
<style> #mapa { width: 100%; height: 250px; } </style>
<script src="public/js/logViaje.js"></script>
