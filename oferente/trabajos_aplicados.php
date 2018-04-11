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
    <title>Aplicados</title>
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
              <li><a href="perfil.php">Perfil</a></li>
            <li><a href="../cerrar_sesion.php"><span class="glyphicon glyphicon-log-in"></span> Cerrar sesión</a></li>

            </ul>
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
      </nav>
    </header>

    <div class="container">

      
      <!-- Search and Apply To Job Posts -->
      <div class="row">
        <div class="col-md-12">
          <div class="table-responsive">
            <h2 class="text-center">Trabajos Aplicados</h2>
            <table class="table table-striped">
              <thead>
               <th>Nombre del Trabajo</th>
                <th>Descripción </th>
                <th>Salario Mínimo</th>
                <th>Salario Máximo</th>
                <th>Experiencia</th>
                <th>Requisitos</th>
                <th>Fecha </th>
              </thead>
              <tbody>
                <?php 
                  $sql = "SELECT * FROM puesto_trabajo INNER JOIN aplicar_trabajo ON puesto_trabajo.id_puesto=aplicar_trabajo.id_puesto WHERE aplicar_trabajo.id_usuario='$_SESSION[id_usuario]'";
                  $result = $conn->query($sql);
                  if($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) 
                    {                     
                      
                     ?>
                      <tr>
                        <td><?php echo $row['tituloTrabajo']; ?></td>
                        <td><?php echo $row['descripcionTrabajo']; ?></td>
                        <td><?php echo $row['salarioMinimo']; ?></td>
                        <td><?php echo $row['salarioMaximo']; ?></td>
                        <td><?php echo $row['experienciaRequerida']; ?></td>
                        <td><?php echo $row['requisitos']; ?></td>
                        <td><?php echo date("d-M-Y", strtotime($row['fechaCreacion'])); ?></td>                                              
                      </tr>
                     <?php
                    }
                  }
                  $conn->close();
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </body>
</html>