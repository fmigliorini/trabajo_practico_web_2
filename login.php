<?php
    var_dump($_POST);
    if($_SERVER['REQUEST_METHOD'] === "POST"){
        if( isset($_POST['user']) && isset($_POST['pass'])){

            require 'models/Usuario.php';
            $usuario = new Usuario();;
            if ( $usuario->login($_POST['user'], $_POST['pass']) ){
                session_start();
                $_SESSION['authenticate'] = true;
                header('Location: home.php');
                exit;
            } else {
                $error = "Usuario o clave invalidos";
            }

        }
    }

?>

<?php require_once "templates/head.php"; ?>

<div class="login-box">
    <div class="login-logo">
        <a href="#"><b>Viajes</b>Online</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Iniciar sessión</p>
        <form action="" method="post">
            <div class="form-group has-feedback">
                <input type="text" name="user" class="form-control" placeholder="Usuario">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" name="pass" class="form-control" placeholder="Clave">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <?php if ( isset($error) && !empty($error) ) { ?>
                    <div class="col-xs-12" style="color:red;">
                        <label class="control-label"><?php echo $error; ?></label>
                    </div>
                <?php } ?>
                <div class="col-xs-offset-8 col-xs-4">
                    <input type="submit" class="btn btn-primary btn-block btn-flat" value="Ingresar">
                </div>
            <!-- /.col -->
            </div>
        </form>

        <a href="#">Olvide mi clave</a><br>
    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<?php require_once "templates/footer.php"; ?>
