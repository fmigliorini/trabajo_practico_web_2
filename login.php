<?php

    // print_r($_POST);
    var_dump($_SERVER);
    if($_SERVER['REQUEST_METHOD'] === "POST"){
        if( isset($_POST['user']) && isset($_POST['pass'])){
            session_start();
            echo "NETRE";
            var_dump($_SESSION);
            $_SESSION['authenticate'] = true;
            header('Location: home.php');
            exit;
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
