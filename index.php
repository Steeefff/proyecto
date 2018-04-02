<?php
session_start();
require_once("conexion.php");
?>


<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Las 3 meta etiquetas anteriores *deben* ser lo primero en la cabeza; cualquier otro contenido principal debe venir *después* de estas etiquetas -->
    <title>BuscoEmpleo.com</title>

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
    
    <!-- NAVIGATION BAR (MENU)-->
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
            <a class="navbar-brand" href="#">BuscoEmpleo.com</a>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">     
            <ul class="nav navbar-nav navbar-right">
            <?php
            if(isset($_SESSION['id_usuario']) && empty($_SESSION['empresaLogeada'])) {
              ?>
              <li><a href="oferente/panel.php">Panel</a></li>
              <li><a href="cerrar_sesion.php">Cerrar sesión</a></li>
            <?php
         } else if(isset($_SESSION['id_usuario']) && isset($_SESSION['empresaLogeada'])) {
            ?>
            <li><a href="empresa/panel.php">Panel</a></li>
            <li><a href="cerrar_sesion.php">Cerrar sesión</a></li>

            <?php } else { 
              ?>
            
              <li><a href="empresa.php">Empresa</a></li>
              <li><a href="registro.php">Registro</a></li>
              <li><a href="login.php">Inicio de sesión</a></li>
            <?php } ?>
            </ul>
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
      </nav>
    </header>
<!-- FIN DE MENU -->


    <section>
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="jumbotron text-center">
              <h1>BuscoEmpleo.com</h1>
              <p>Encuentre su trabajo soñado</p>
              <p><a class="btn btn-primary btn-lg" href="registro.php" role="button">Registro</a></p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Ultimos trabajos-->
    <section>
      <div class="container">
        <div class="row">
          <h2 class="text-center">Ultimos trabajos registrados</h2>
          <?php 
          //CONSULTAR LOS ULTIMOS 5 PUESTOS PUBLICADOS
          $sql = "SELECT * FROM puestos WHERE `privado`=0 && `estadoPuesto`=1 ORDER BY `idPuesto` DESC Limit 5 ";//puesto_trabajo es la tabla
          $result = $conn->query($sql); //result es como un vector que guarda la cantidad de filas consultadas, si es una consulta
          if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) //fetch pasa el valor siguiente y lo guarda en row funciona como un ++
            //Devuelve un array (las lineas del query)  que corresponde a la fila recuperada y mueve el puntero de datos interno hacia adelante(++)
            {
            ?>
            <div class="col-md-6 fixHeight">         
              <h3><?php echo $row['nombrePuesto'];?> </h3>
              <p><?php echo $row['descripcion'];?></p>
              <button class="btn btn-default">Vista</button>
            </div>
          <?php
        }
      }
      ?>
        </div>
      </div>
    </section>

    <!-- Lista de empresas -->
    <section>
      <div class="container">
        <div class="row">
          <h2 class="text-center">Lista de Empresas</h2>
          <div class="col-xs-6 col-md-3">
            <a href="#" class="thumbnail">
              <img src="..." alt="...">
            </a>
          </div>
          <div class="col-xs-6 col-md-3">
            <a href="#" class="thumbnail">
              <img src="..." alt="...">
            </a>
          </div>
          <div class="col-xs-6 col-md-3">
            <a href="#" class="thumbnail">
              <img src="..." alt="...">
            </a>
          </div>
          <div class="col-xs-6 col-md-3">
            <a href="#" class="thumbnail">
              <img src="..." alt="...">
            </a>
          </div>
        </div>
      </div>
    </section>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

   <script type="text/javascript">
      $(function() {
        var maxHeight = 0;

        $(".fixHeight").each(function() {
          maxHeight = ($(this).height() > maxHeight ? $(this).height() : maxHeight);
        });

        $(".fixHeight").height(maxHeight);
      });
    </script>
  </body>
</html>