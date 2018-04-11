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
    <title>Info Empleo</title>
    <!-- Bootstrap -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
   
    <link rel="stylesheet" href="css/carrusel.css" type="text/css">
    <link rel="stylesheet" href="css/custom.css" type="text/css">
  </head>
  <body>
    
    <!-- NAVIGATION BAR (MENU)-->
    <header>
      <nav class="navbar navbar-inverse" >
        <div class="container-fluid">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Info Empleo</a>
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
            <li><a href="cerrar_sesion.php"><span class="glyphicon glyphicon-log-in"></span> Cerrar sesión</a></li>

            <?php } else { 
              ?>
              <li><a href="empresa.php">Empresa</a></li>
              <li><a href="registro.php">Registro</a></li>
              <li><a href="#ancla" id="a">Acera de nosotros</a></li>
              <li><a href="login.php"><span class="glyphicon glyphicon-user"></span> Inicio de sesión</a></li>
            <?php } ?>
            </ul>
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
      </nav>
    </header>
<!-- FIN DE MENU -->
    <div class="content-wrapper" style="margin-left: 0px;">
        <section class="content-header bg-main">
          <div class="container">
            <div class="row">
              <div class="col-md-12 text-center index-head">
                <h1>Info Empleo</h1>
                  <p>Encuentre su trabajo soñado</p>
                <!--David-->
                    <nav class="navbar navbar-light bg-light">
                      <form class="form-inline" method="post" action="panelBusqueda.php">
                        <input class="form-control mr-sm-2" type="search" placeholder="Buscar trabajo"  name="buscarCaracteristicas" aria-label="Search">
                        <button class="btn btn-info"  type="submit">Buscar</button>
                      </form>
                    </nav>
              </div>
            </div>
          </div>
        </div>
        </section>



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
                                              <a class="btn btn-info" href="#">Ver Empleo</a>
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
<br>
</div>

   <section id="about" class="content-header">
    <a name="ancla"></a>
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center" >
            <h1>Acerca de nosotros</h1>                      
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <img src="images/acerca.png" class="img-responsive">
          </div>
          <div class="col-md-6 about-text margin-bottom-20">
            <h4>La página Info Empleo posibilita la vinculación entre personas en busca de empleo y empresas o personas con requerimientos de personal, considerando aspectos como ocupación, experiencia, grado académico, entre otros. 
            </h4>
            <h4>
              En el caso de las empresas, al momento de realizar la vinculación, el sistema automáticamente muestra la lista de personas que cumplen el perfil requerido y, simultáneamente, remite un correo electrónico a esas personas informando que existe una vacante de acuerdo a su perfil.
            </h4>
          </div>
        </div>
      </div>
    </section>

  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer" style="margin-left: 0px;">
    <div class="text-center">
      <strong> 2018 - Info Empleo</a>.</strong> 
    </div>
  </footer>



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