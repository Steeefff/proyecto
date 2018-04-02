<?php
session_start();
if(empty($_SESSION['id_usuario'])) {
  header("Location: ../index.php");
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
    <title>Perfil</title>

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
            <a class="navbar-brand" href="#">Info Jobs</a>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">     
            <ul class="nav navbar-nav navbar-right">
              <li><a href="perfil.php">Perfil</a></li>
              <li><a href="../cerrar_sesion.php">Cerrar sesión</a></li>
            </ul>
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
      </nav>
    </header>

    <section>
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-md-offset-3 well">
          <h2 class="text-center">Profile</h2>
            <form method="post" action="actualizar_perfil.php">
            <?php

            $sql = "SELECT * FROM usuarios WHERE id_usuario='$_SESSION[id_usuario]'";
            $result = $conn->query($sql);

            if($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
            ?>
              <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" value="<?php echo $row['nombre']; ?>" required="">
              </div>
              <div class="form-group">
                <label for="apellido">Apellido</label>
                <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellido" value="<?php echo $row['apellido']; ?>" required="">
              </div>
              <div class="form-group">
                <label for="correo">Correo</label>
                <input type="email" class="form-control" id="correo" placeholder="Correo" value="<?php echo $row['correo']; ?>" readonly>
              </div>
              <div class="form-group">
                <label for="direccion">Dirección</label>
                <textarea id="direccion" name="direccion" class="form-control" rows="5" placeholder="Dirección"><?php echo $row['direccion']; ?></textarea>
              </div>
              <div class="form-group">
                <label for="provincia">Provincia</label>
                <input type="text" class="form-control" id="provincia" name="provincia" placeholder="Provincia" value="<?php echo $row['provincia']; ?>">
              </div>
              <div class="form-group">
                <label for="ciudad">Ciudad</label>
                <input type="text" class="form-control" id="ciudad" name="ciudad" value="<?php echo $row['ciudad']; ?>" placeholder="Ciudad">
              </div>
              <div class="form-group">
                <label for="contactno">Numero de Contacto</label>
                <input type="text" class="form-control" id="contactno" name="contactno" placeholder="Número de contacto" value="<?php echo $row['contactno']; ?>">
              </div>
              <div class="form-group">
                <label for="calificacion">Calificación más alta</label>
                <input type="text" class="form-control" id="calificacion" name="calificacion" placeholder="Calificación más alta" value="<?php echo $row['calificacion']; ?>">
              </div>
              <div class="form-group">
                <label for="anoPasa">Año que pasa</label>
                <input type="date" class="form-control" id="anoPasa" name="anoPasa" placeholder="Año que pasa" value="<?php echo $row['anoPasa']; ?>">
              </div>
              <div class="form-group">
                <label for="fechaNacimiento">Fecha de nacimiento</label>
                <input type="date" class="form-control" id="fechaNacimiento" name="fechaNacimiento" placeholder="Fecha de Nacimiento" value="<?php echo $row['fechaNacimiento']; ?>">
              </div>
              <div class="form-group">
                <label for="edad">Edad</label>
                <input type="text" class="form-control" id="edad" name="edad" placeholder="Edad" value="<?php echo $row['edad']; ?>">
              </div>
              <div class="form-group">
                <label for="ocupacion">Ocupación</label>
                <input type="text" class="form-control" id="ocupacion" name="ocupacion" placeholder="Ocupación" value="<?php echo $row['ocupacion']; ?>">
              </div>
              <div class="text-center">
                <button type="submit" class="btn btn-success">Actualizar</button>
              </div>
            <?php
                }
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