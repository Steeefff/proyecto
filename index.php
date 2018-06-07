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
   <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/carrusel.css" type="text/css">
    <link rel="stylesheet" href="css/custom.css" type="text/css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    

  </head>
  <body>
    
    <!------INCLUYENDO EL MENU -------->
    <?php include("menu.php"); ?>
    <!---------------------------------->

    <div class="content-wrapper" style="margin-left: 0px;">
        <section class="content-header bg-main">
          <div class="container">
            <div class="row">
              <div class="col-md-12 text-center index-head">
                <h1>Info Empleo</h1>
                  <p>Encuentre su trabajo soñado</p>
                <!--David-->
                      <form class="form-inline" method="post" action="ver_puestos.php">
                        <!--<input class="form-control mr-sm-2" type="search" placeholder="Buscar trabajo"  name="buscarCaracteristicas" aria-label="Search">-->
                        <button class="btn btn-info" type="submit">Buscar</button>
                      </form>
              </div>
            </div>
          </div>
        </section>
    </div>
    
    
     
    <!-- https://bootsnipp.com/tags/search -->

    <!-- Ultimos trabajos -->
    <div style=" text-align:center; "  id="rapper">
    <section id="bloque1">   
    <section >
      <div style="position: absolute;left: 50%; top: 50%; transform: translate(-50%, -50%); -webkit-transform: translate(-50%, -50%);"class="container">
        <div class="row">
          <h2 class="text-center" style="color: #669999">Últimos trabajos registrados</h2>


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
                
                        
                          <!-- Static Header -->
                                  <div class=" style:margin-left: auto; margin-right: auto; header-text text-center hidden-xs">
                                     <div class="main_title ">
                                    <h2><?php echo $row['nombrePuesto'];?></h2>
                                    <p><?php echo $row['descripcion'];?></p>
                                   </div>  
                                        <!--<div class="">
                                              <a class="btn btn-info" href="#">Ver Empleo</a>
                                          </div>-->
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
            <a name="ancla" ><h1>Acerca de nosotros</h1>                      
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
      <div class="et_pb_column et_pb_column_4_4 et_pb_column_10    et_pb_css_mix_blend_mode_passthrough et-last-child">
        
        
        <div class="et_pb_module et_pb_image et_pb_image_1 et_always_center_on_mobile">
        
        
        <span class="et_pb_image_wrap"><img src="https://www.between.tech/wp-content/uploads/2017/08/cenefa-traingulo-rojo-ok.png" alt=""></span>
      </div>
      </div>
    </section>
<!-- About Section -->
  
  <div class="w3-row-padding w3-padding-16 w3-center">
    <div class="w3-quarter">
      <span class="glyphicon glyphicon-cog"></span>
      <h3>Soluciones Tecnológicas</h3>
      <p>Desde las oficinas técnicas de Info Empleo ofrecemos servicios en función de las necesidades de cada cliente y con la opción de desarrollar proyectos llave en mano. Disponemos de una importante capacidad de back office que se adapta a las necesidades de nuestros clientes. </p>
      <p><button class="w3-button w3-light-grey w3-block">Más info+</button></p>
    </div>
    <div class="w3-quarter">
      <span class="glyphicon glyphicon-question-sign"></span>
      <h3>Outsourcing y Consultoría</h3>
      <p>Con el servicio de Outsourcing de Info Empleo nos integramos en la estructura de nuestros clientes dando apoyo en el día a día de las actividades de la empresa. Nuestro equipo de consultores se divide por áreas de especialización, para poder lograr los objetivos.</p>
      <p><button class="w3-button w3-light-grey w3-block">Más info+</button></p>
    </div>
   <div class="w3-quarter">
      <span class="glyphicon glyphicon-pencil"></span>
      <h3>Selección Especializadas</h3>
      <p>Queremos ser el partner de RRHH de nuestros clientes. Gracias a  nuestra experiencia como empresa puntera en el sector tecnológico, conseguimos encontrar al mejor candidato, a nivel técnico como personal y de encaje con la cultura empresarial.</p>
      <p><button class="w3-button w3-light-grey w3-block">Más info+</button></p>
    </div>
  <div class="w3-quarter">
      <span class="glyphicon glyphicon-file"></span>
      <h3>Perfiles disponibles</h3>
      <p>Tenemos perfiles con disponibilidad inmediata para unirse a tu equipo. Recibe nuestra Newsletter mensual con los mejores perfiles de informática e ingeniería. Si alguno resulta de tu interés, sólo tienes que solicitarnos más información.</p>
      <p><button class="w3-button w3-light-grey w3-block">Más info+</button></p>
    </div>
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