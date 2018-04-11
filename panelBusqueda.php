<?php
session_start();
header("Content-Type: text/html;charset=utf-8");
if(empty($_SESSION['id_usuario'])) {
  header("Location: index.php");
  exit();
}
require_once("conexion.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Panel</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

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
            <a class="navbar-brand" href="../index.php"">Info Empleo</a>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">     
            <ul class="nav navbar-nav navbar-right">
              <li><a href="perfil.php">Perfil</a></li>
            <li><a href="cerrar_sesion.php"><span class="glyphicon glyphicon-log-in"></span> Cerrar sesión</a></li>  
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
      </nav>
    </header>

    <div class="container">

      <?php if(isset($_SESSION['jobApplySuccess'])) { ?>
      <div class="row">
        <div class="col-md-12">
          <div class="alert alert-success">
            Usted a aplicado correctamente!
          </div>
        </div>
      </div>
      <?php unset($_SESSION['jobApplySuccess']); } ?>
      
      <!-- otras funciones del panel -->
      <div class="row">
        <h2 class="text-center">Mi panel de busqueda</h2>
      </div>

      <!-- buscar y aplicar a los puestos de trabajo -->
      <div class="row">
        <div class="col-md-12">
          <div class="table-responsive">
            <h2 class="text-center">Resultados de los trabajos</h2>
            <table class="table table-striped">
              <thead>
                <th>Nombre del Trabajo</th>
                <th>Descripción </th>
                <th>Salario</th>
                <th>Vacantes</th>
                <th>Estado Puesto</th>
                <th>Responsabilidades</th>
                <th>Fecha </th>
                <th>Acción</th>
              </thead>
              <tbody>
                <?php 

                $buscarCaracteristicas = mysqli_real_escape_string($conn, $_POST['buscarCaracteristicas']);

                  $sql = "SELECT * FROM puestos";
                  $result = $conn->query($sql);
                  if($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) 
                    {
                    $sql2 = "SELECT * FROM puestos WHERE descripcion like '%" .$buscarCaracteristicas."%' order by idPuesto";


                      $result1 = $conn->query($sql2);
                      
                     ?>
                     <tr>
                        <td><?php echo $row['nombrePuesto']; ?></td>
                        <td><?php echo $row['descripcion']; ?></td>
                        <td><?php echo $row['salario']; ?></td>
                        <td><?php echo $row['numVacantes']; ?></td>
                        <td><?php echo $row['estadoPuesto']; ?></td>
                        <td><?php echo $row['responsabilidades']; ?></td>
                        <td><?php echo date("d-M-Y", strtotime($row['fecha'])); ?></td>
                        <?php
                        if($result1->num_rows > 0) { 
                          ?>
                           <td><strong>Aplicado</strong></td>
                          <?php
                        } else {
                        ?>
                        <td><a href="aplicar_puestoTrabajo.php?id=<?php echo $row['id_puesto']; ?>">Aplicar</a></td>
                        <?php } ?>                        
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