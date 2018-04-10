<?php
session_start();
require_once("conexion.php");
?>


<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="css/style.css" type="text/css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Las 3 meta etiquetas anteriores *deben* ser lo primero en la cabeza; cualquier otro contenido principal debe venir *después* de estas etiquetas -->
    <title>BuscoEmpleo.com</title>


    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel= "stylesheet" type="text/css" href="css/carrusel.css">


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
            <a class="navbar-brand" href="index.php">BuscoEmpleo.com</a>
          </div>

          <!--David-->
          <div class="flipkart-navbar-search smallsearch col-sm-5 col-xs-8">
                <div class="row">
                  <form  method="post" action="panelBusqueda.php">
                    <input class="flipkart-navbar-input col-xs-11" type="text" placeholder="Buscar trabajo" name="buscarCaracteristicas">
                    <input type="submit" class="flipkart-navbar-button col-xs-1">
                    </input>
                  </form>
                </div>
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

              <!-- https://bootsnipp.com/tags/search -->

            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Ultimos trabajos -->
    <section>
      <div class="container">
        <div class="row">
          <h2 class="text-center">Ultimos trabajos registrados</h2>


          <!--Include the above in your HEAD tag -->

            <div id="myCarousels" class="carousel slide" data-ride="carousel">
                  <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#myCarousels" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousels" data-slide-to="1"></li>
                    <li data-target="#myCarousels" data-slide-to="2"></li>
                    <li data-target="#myCarousels" data-slide-to="3"></li>
                    <li data-target="#myCarousels" data-slide-to="4"></li>
                </ol>
                <!-- Wrapper for slides -->
                <div class="carousel-inner">
        
                  <?php 
                   //CONSULTAR LOS ULTIMOS 5 PUESTOS PUBLICADOS
                    $sql = "SELECT * FROM puestos WHERE `privado`=0 && `estadoPuesto`=1 ORDER BY `idPuesto` DESC Limit 5 ";//puesto_trabajo es la tabla
                    $result = $conn->query($sql); //result es como un vector que guarda la cantidad de filas consultadas, si es una consulta
                    if($result->num_rows > 0) {

                      $primero=1;
                      while($row = $result->fetch_assoc()) //fetch pasa el valor siguiente y lo guarda en row funciona como un ++
                      //Devuelve un array (las lineas del query)  que corresponde a la fila recuperada y mueve el puntero de datos interno hacia adelante(++)
                      {

                        if($primero==1)
                          echo "<div class='item active'>";
                        else
                          echo "<div class='item'>";
                    ?>
                
                          <img src="images/1.jpg" alt="Second slide">
                          <!-- Static Header -->
                                  <div class="header-text text-center hidden-xs">
                                     <div class="main_title ">
                                    <h2><?php echo $row['nombrePuesto'];?></h2>
                                    <p><?php echo $row['descripcion'];?></p>
                                   </div>  
                                        <div class="">
                                              <a class="btn btn-lg btn-primary site-btn" href="#">Ver Empleo</a>
                                          </div>
                                  </div><!-- /header-text -->
                        </div>
                <?php
                    $primero=0;
                    }//fin de while
                  }//fin de if
                ?>


                </div><!--cierre de carousel-inner-->

            <!-- Controls -->
            <a class="left carousel-control" href="#myCarousels" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
            </a>
            <a class="right carousel-control" href="#myCarousels" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
            </a>
          </div><!-- /carousel -->

        </div><!--cierre de row-->
      </div><!--cierre de container-->
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

    <script src="js/carrusel.js"></script>

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