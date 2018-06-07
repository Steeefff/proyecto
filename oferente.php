<?php
session_start();
header("Content-Type: text/html;charset=utf-8");

if(isset($_SESSION['id_usuario'])) {
    header("Location: oferente/panel.php");
    exit();
  }
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Info Empleo</title>
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
    <?php include("menu.php"); ?>
    <!---------------------------------->

   <section>
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-md-offset-4 well">
            <h2 class="text-center" style="color:#0066cc">Oferente</h2>
            <p class="text-center" style="text-align: justify;"><strong>Info Empleo</strong> basa toda su estrategia y sus relaciones interpersonales en unos valores muy identificados: Orientación a las personas, Respeto, Honestidad y transparencia, y Proactividad..</p><br>
            <div class="pull-left">
              <a href="registro.php" class="btn btn-primary">Registrar</a>
            </div>
            <div class="pull-right">
              <a href="login.php" class="btn btn-primary ">Iniciar sesión</a>
            </div>
          </div>
        </div>
      </div>
    </section>

<section>
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="jumbotron text-center">
             <div class="col-md-12 text-center latest-job margin-bottom-20">
        
        </div>
        <div class="row">
          <div class="col-sm-3 col-md-3">
            <div class="thumbnail candidate-img">
              <img src="images/card4.jpg" alt="Browse Jobs">
              <div class="caption">
                <h4 class="text-center">Crea</h4>
                <h5>Creamos la mejor experiencia para nuestra comunidad, en equipo.</h5>
              </div>
            </div>
          </div>
          <div class="col-sm-3 col-md-3">
            <div class="thumbnail candidate-img">
              <img src="images/card5.jpg" alt="Apply & Get Interviewed">
              <div class="caption">
                <h4 class="text-center">Aprende</h4>
                <h5>Buscamos inspiración y conocimiento en nosotros mismos y en los demás.</h5>
              </div>
            </div>
          </div>
          <div class="col-sm-3 col-md-3">
            <div class="thumbnail candidate-img">
              <img src="images/card6.jpg" alt="Start A Career">
              <div class="caption">
                <h4 class="text-center">Juega</h4>
                <h5>La vida es lo que pasa mientras estás ocupado trabajando. Nos aseguramos de disfrutarla.</h5>
              </div>
            </div>
          </div>
               <div class="col-sm-3 col-md-3">
            <div class="thumbnail candidate-img">
              <img src="images/card4.jpg" alt="Start A Career">
              <div class="caption">
                <h4 class="text-center">Proceso fácil y rápido</h4>
                <h5>Puedes gestionar tus procesos de selección más rápido y fácil que nunca</h5>
              </div>
            </div>
          </div>

            </div>
          </div>
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