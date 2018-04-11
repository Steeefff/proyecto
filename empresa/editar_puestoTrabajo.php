<?php
session_start();
if(empty($_SESSION['id_usuario'])) {
    header("Location: oferente/panel.php");
    exit();
  }
require_once("../conexion.php");
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Editar Puesto</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

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
      <nav class="navbar navbar-inverse">
        <div class="container-fluid">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="../index.php">Info Empleo</a>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">     
            <ul class="nav navbar-nav navbar-right">
            <?php
            if(isset($_SESSION['id_user'])) {
              ?>
              <li><a href="panel.php">Panel</a></li>
            <li><a href="../cerrar_sesion.php"><span class="glyphicon glyphicon-log-in"></span> Cerrar sesión</a></li>

            <?php
            } else { ?>
              <li><a href="company.php">Empresa</a></li>
              <li><a href="register.php">Registro</a></li>
              <li><a href="login.php">Cerrar sesion</a></li>
            <?php } ?>
            </ul>
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
      </nav>
    </header>

    <section>
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-md-offset-4 well">
          <h2 class="text-center">Actualizar puesto de Trabajo</h2>
            <form method="post" action="editar_puesto.php">
            <?php
            $sql = "SELECT * FROM puesto_trabajo WHERE id_puesto='$_GET[id]' AND id_empresa='$_SESSION[id_usuario]'";
              $result = $conn->query($sql);
              if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) 
                {
            ?>
              <div class="form-group">
                <label for="tituloTrabajo">Titulo del Trabajo</label>
                <input type="text" class="form-control" id="tituloTrabajo" name="tituloTrabajo" value="<?php echo $row['tituloTrabajo']; ?>" placeholder="Titulo del Trabajo" required="">
              </div>
              <div class="form-group">
                <label for="descripcionTrabajo">Descripcion</label>
                <textarea class="form-control" id="descripcionTrabajo" name="descripcionTrabajo" placeholder="descripcionTrabajo" required=""><?php echo $row['descripcionTrabajo']; ?></textarea>
              </div>
              <div class="form-group">
                <label for="salarioMinimo">Salario Minimo</label>
                <input type="text" class="form-control" id="salarioMinimo" value="<?php echo $row['salarioMinimo']; ?>" name="salarioMinimo" placeholder="Salario Minimo" required="">
              </div>
              <div class="form-group">
                <label for="salarioMaximo">Salario Maximo</label>
                <input type="text" class="form-control" id="salarioMaximo" name="salarioMaximo" value="<?php echo $row['salarioMaximo']; ?>" placeholder="Salario Maximo" required="">
              </div>
              <div class="form-group">
                <label for="experienciaRequerida">Experiencia Requerida</label>
                <input type="text" class="form-control" id="experienciaRequerida" name="experienciaRequerida" value="<?php echo $row['experienciaRequerida']; ?>" placeholder="Experiencia Requerida" required="">
              </div>
              <div class="form-group">
                <label for="requisitos">Requisitos</label>
                <input type="text" class="form-control" id="requisitos" name="requisitos" value="<?php echo $row['requisitos']; ?>" placeholder="Requisitos" required="">
              </div>
              <input type="hidden" name="target_id" value="<?php echo $_GET['id']; ?>">
              <div class="text-center">
                <button type="submit" class="btn btn-success">Actualizar</button>
              </div>
              <?php 
                }
              } else {
                header("Location: panel.php");
                exit();
              }
              ?>     
            </form>
          </div>
        </div>
      </div>
    </section>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </body>
</html>