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
    
   <!------INCLUYENDO EL MENU -------->
    <?php include("../menu.php"); ?>
    <!---------------------------------->


    <section>
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-md-offset-3 well">
          <h2 class="text-center">Perfil de Oferente</h2>
            <form method="post" action="actualizar_perfil.php">
            <?php

            $sql = "SELECT * FROM oferentes WHERE idOferente='$_SESSION[id_usuario]'";
            $result = $conn->query($sql);

            if($result->num_rows > 0) {
              //row guarda la fila que me trajo el select  y con el fecht_assoc me va a cambiar la fila como un ++ para irle sacando los datos de nombre, apellido, correo etc...
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
                <input type="email" class="form-control" id="correo" placeholder="Correo" value="<?php echo $row['correo']; ?>">
              </div>
              
              <div class="form-group">
                <label for="provincia">nacionalidad</label>
                <input type="text" class="form-control" id="nacionalidad" name="nacionalidad" placeholder="Nacionalidad" value="<?php echo $row['nacionalidad']; ?>">
              </div>
              <div class="form-group">
                <label for="ciudad">Teléfono</label>
                <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo $row['telefono']; ?>" placeholder="Numero de Telefono">
              </div>
              <div class="form-group">
                <label for="contactno">Residencia</label>
                <input type="text" class="form-control" id="Residencia" name="residencia" placeholder="Lugar de Residencia" value="<?php echo $row['residencia']; ?>">
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