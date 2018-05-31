<?php

//Para manejar las variables de sesión en esta página
session_start();

// Si el usuario no ha iniciado sesión, redirija a la página de inicio.
// Esto es obligatorio si el usuario intenta ingresar dashboard.php manualmente en la URL.
if(empty($_SESSION['idAdministrador'])) {
  header("Location: index.php");
  exit();
}

// Inclusión de conexión de base de datos desde el archivo conexion.php para evitar la reescritura en todos los archivos
  
  require_once("../conexion.php");
?>
<!DOCTYPE html>
<html lang="es">
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
              <li><a href="../cerrar_sesion.php"><span class="glyphicon glyphicon-log-in"></span> Cerrar sesión</a></li>

            </ul>
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
      </nav>
    </header>

    <div class="container-fluid">
      <div class="row">
        <div class="col-md-4">
          <div class="list-group">
            <a href="panel.php" class="list-group-item">Panel</a>
            <a href="oferente.php" class="list-group-item">Oferentes</a>
            <a href="empresa.php" class="list-group-item">Empresa</a>
            <a href="puesto.php" class="list-group-item">Puestos de Trabajo</a>
            <a href="caracteristicas.php" class="list-group-item active">Caracteristicas</a>
          </div>
        </div>
        <div class="col-md-8">
       <div class="container">
          <ul class="nav nav-pills">
            <li class="active"><a data-toggle="pill" href="#caracteristicas">Caracteristicas</a></li>
            <li><a data-toggle="pill" href="#agregar">Agregar</a></li>
          </ul>
          
          <div class="tab-content">
            <div id="caracteristicas" class="tab-pane fade in active">
              <h3>Lista de caracteristicas</h3>
                  <div class="col-md-8">
                      <table class="table">
                        <thead>
                          <th>No</th>
                          <th>Tipo de caracteristica</th>
                          <th>Caracteristica</th>
                          <th>Administrador</th>
                  
                        </thead>
                        <tbody>
                          <?php
                            $sql = "SELECT tipo_caracteristicas.nombre AS tipo, caracteristicas.nombre,caracteristicas.idCaracteristica, administradores.nombre AS admin FROM caracteristicas JOIN tipo_caracteristicas on (caracteristicas.idTipoCaracteristica = tipo_caracteristicas.idTipoCaracteristica) JOIN administradores ON (caracteristicas.idAdmin = administradores.idAdministrador)";
                            $result = $conn->query($sql);
                            if($result->num_rows > 0) {
                              $i = 0;
                              while($row = $result->fetch_assoc()) {
                                ?>
                                  <tr>
                                    <td><?php echo ++$i; ?></td>
                                    <td><?php echo $row['tipo']; ?></td>
                                    <td><?php echo $row['nombre']; ?></td>
                                    <td><?php echo $row['admin']; ?></td>
                              
                                    <td><a href="borrar_caracteristica.php?id=<?php echo $row['idCaracteristica']; ?>">Borrar</a></td>
                                  </tr>
                                <?php
                              }
                            }
                          ?>
                        </tbody>
                      </table>
         
              </div>
            </div>
            <div id="agregar" class="tab-pane fade">
              <h3>Agregar una nueva caracteristica</h3>
              <section>

        <div class="row">
          <div class="col-md-4 col-md-offset-2 well">
          <h2 class="text-center">Registrar caracteristica</h2>
            <form method="post" action="agregar_caracteristica.php">

              <div class="form-group">
                 <label for="tipo">Tipo de Caracteristica</label><br>
                 <select required class="form-control" id='tipo' name="tipo">
                 <?php 
                  $sql = "SELECT * FROM tipo_caracteristicas";
                  $result = $conn->query($sql);
                  if($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) 
                    {
                  ?>
                    <option value='<?php echo $row['idTipoCaracteristica']; ?>'><?php echo $row['nombre']; ?></option>
                  <?php
                    }//cierre de while
                    }//cierre de if          
                  ?> 
                </select>
              </div>

              <div class="form-group">
                <label for="nombreCaracteristica">Nombre de la Caracteristica</label>
                <input type="text" class="form-control" id="nombreCaracteristica" name="nombreCaracteristica" placeholder="Nombre de la Caracteristica" required="">
              </div>

              
             <div class="text-center">
                <button type="submit" class="btn btn-success">Agregar</button>
             </div>
              <?php 
              if(isset($_SESSION['registerError'])) {
                ?>
                <div>
                  <p class="text-center">Ya existe</p>
                </div>
              <?php
               unset($_SESSION['registerError']); }
              ?>     
            </form>
          </div>
        </div>
      </div>
    </section>
            </div>
           
          </div>
        </div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </body>
</html>