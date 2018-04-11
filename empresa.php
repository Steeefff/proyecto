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
            <a class="navbar-brand" href="index.php">Info Empleo</a>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">     
            <ul class="nav navbar-nav navbar-right">
            <?php
            if(isset($_SESSION['id_usuario']) && empty($_SESSION['empresaLogeada'])) {
              ?>
              <li><a href="oferente/panel.php">Panel</a></li>
            <li><a href="cerrar_sesion.php"><span class="glyphicon glyphicon-log-in"></span> Cerrar sesión</a></li>

              <?php
            }else if(isset($_SESSION['id_usuario']) && isset($_SESSION['empresaLogeada'])){
              ?>
              <li><a href="empresa/panel.php">Panel</a></li>
              <li><a href="cerrar_sesion.php"><span class="glyphicon glyphicon-log-in"></span> Cerrar sesión</a></li>

              <?php } else { ?>
            
              <li><a href="empresa.php">Empresa</a></li>
              <li><a href="registro.php">Registro</a></li>
              <li><a href="login.php"><span class="glyphicon glyphicon-user"></span> Inicio de sesión</a></li>
            <?php } ?>
            </ul>
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
      </nav>
    </header>
  

   <section>
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-md-offset-4 well">
            <h2 class="text-center">Empresa</h2>
            <p class="text-center" style="text-align: justify;">Aquí encuentras el mejor talento humano. Miles de empresas como la tuya ya han tenido éxito contratando los mejores profesionales a través de <strong>Info Empleo</strong>.</p><br>
            <div class="pull-left">
              <a href="registrar_empresa.php" class="btn btn-primary">Registrar Empresa</a>
            </div>
            <div class="pull-right">
              <a href="empresa_login.php" class="btn btn-primary ">Iniciar sesión</a>
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
            <h3>Encuentra fácilmente los mejores candidatos para tus vacantes</h3>
            <h5>En <strong>Info Empleo</strong> sabemos que el fundamento de cada empresa es el talento humano. Por eso innovamos para hacer los procesos de selección más rápidos y efectivos</h5>            
        
        </div>
        <div class="row">
          <div class="col-sm-3 col-md-3">
            <div class="thumbnail candidate-img">
              <img src="images/empresa1.PNG" alt="Browse Jobs">
              <div class="caption">
                <h4 class="text-center">Ahorro de tiempo y dinero</h4>
                <h5>La mejor tecnología para buscar y filtrar currículums en nuestra amplia base de datos</h5>
              </div>
            </div>
          </div>
          <div class="col-sm-3 col-md-3">
            <div class="thumbnail candidate-img">
              <img src="images/empresa2.PNG" alt="Apply & Get Interviewed">
              <div class="caption">
                <h4 class="text-center">Buscador</h4>
                <h5>Herramientas optimizadas para reducir el tiempo y costo de la selección</h5>
              </div>
            </div>
          </div>
          <div class="col-sm-3 col-md-3">
            <div class="thumbnail candidate-img">
              <img src="images/empresa3.PNG" alt="Start A Career">
              <div class="caption">
                <h4 class="text-center">Candidatos calificados</h4>
                <h5>Encuentra los candidatos que mejor se adaptan al perfil buscado</h5>
              </div>
            </div>
          </div>
               <div class="col-sm-3 col-md-3">
            <div class="thumbnail candidate-img">
              <img src="images/empresa4.PNG" alt="Start A Career">
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