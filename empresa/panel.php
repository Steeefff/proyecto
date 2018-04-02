<?php
session_start();
header("Content-Type: text/html;charset=utf-8");
if(empty($_SESSION['id_usuario'])) {
	header("Location: ../index.php");
	exit();
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Lista</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    
    <!-- NAVIGATION BAR -->
    <header>
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="../index.php"">BuscoEmpleo.com</a>
          </div>

         <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">     
            <ul class="nav navbar-nav navbar-right">
              <li><a href="perfil.php">Perfil</a></li>
              <li><a href="../cerrar_sesion.php">Cerrar sesion</a></li>
            </ul>
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
      </nav>
    </header>
   

  <div class="container">
    <?php if(isset($_SESSION['jobPostSuccess'])) { ?>
      <div class="row">
        <div class="alert alert-success">
          Puesto de Trabajo creado exitosamente!
        </div>
      </div>
    <?php unset($_SESSION['jobPostSuccess']); } ?>

    <?php if(isset($_SESSION['jobPostUpdateSuccess'])) { ?>
      <div class="row">
        <div class="alert alert-success">
          Puesto de Trabajo actualizado exitosamente!
        </div>
      </div>
    <?php unset($_SESSION['jobPostUpdateSuccess']); } ?>

    <?php if(isset($_SESSION['jobPostDeleteSuccess'])) { ?>
      <div class="row">
        <div class="alert alert-success">
         Puesto de Trabajo borrado correctamente!
        </div>
      </div>
    <?php unset($_SESSION['jobPostDeleteSuccess']); } ?>

      <div class="row">
        <h2 class="text-center">Panel</h2>
        <div class="col-md-2">
          <a href="crear_puestoTrabajo.php" class="btn btn-success btn-block btn-lg">Crear Puesto</a>
        </div>
        <div class="col-md-2">
          <a href="ver_puestoTrabajo.php" class="btn btn-success btn-block btn-lg">Ver Puesto</a>
        </div>
      </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </body>
</html>