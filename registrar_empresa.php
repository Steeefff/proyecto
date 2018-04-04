<?php
session_start();
if(isset($_SESSION['id_usuario'])) {
    header("Location: oferente/panel.php");
    exit();
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Registar Empresa</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!--API DE GOOGLE-->
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&language=es&region=CR&key=
AIzaSyAtkovx7YEf0xJd4GW71JgsEjjZoFMU0F4
"></script>
    <script type="text/javascript" src="js/map.js"></script>

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
            if(isset($_SESSION['id_usuario'])) {
              ?>
              <li><a href="oferente/panel.php">Panel</a></li>
              <li><a href="cerrar_sesion.php">Cerrar sesión</a></li>
            <?php
            } else { ?>
            
              <li><a href="empresa.php">Empresa</a></li>
              <li><a href="registro.php">Registro</a></li>
              <li><a href="login.php">Inicio de sesión</a></li>
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
          <h2 class="text-center">Registrar Empresa</h2>
            <form method="post" action="agregar_empresa.php">

              <div class="form-group"> <!--"form-group" quita el espacio despues del label-->
                <label for="id">ID</label>
                <input type="text" class="form-control" id="idEmpresa" name="idEmpresa" placeholder="Digite su identificación" required>
              </div>
              <div class="form-group">
                <label for="nombreEmpresa">Nombre de la Empresa</label>
                <input type="text" class="form-control" id="nombreEmpresa" name="nombreEmpresa" placeholder="Nombre de la Empresa" required="">
              </div>
              <div class="form-group">
                <label for="correo">Correo Electrónico</label>
                <input type="email" class="form-control" id="correo" name="correo" placeholder="Digite el correo Electrónico" required>
              </div>
              <div class="form-group">
                <label for="numeroContacto">Numero de Contacto</label >
                <input type="number" maxlength="8" class="form-control" id="numeroContacto" name="numeroContacto" placeholder="Numero de Contacto" required>
              </div>
              <div class="form-group">
                <label for="descripcion">Descripción</label required="">
                <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Descripción de la empresa" required>
              </div>
              <div class="form-group">
                <label for="localizacion">Localización</label required="">
                <input type="text" class="form-control" id="localizacion" name="localizacion" placeholder="Localización de la empresa" required>
              </div>

              <!--ETIQUETA DONDE SE CREARA EL MAPA-->
              <div id="map" style="width:100%;height:400px;border: 1px solid #000;"></div>
             
              
             <div class="text-center">
                <button type="submit" class="btn btn-success">Entrar</button>
             </div>
              <?php 
              if(isset($_SESSION['registerError'])) {
                ?>
                <div>
                  <p class="text-center">Ya existe ese correo!</p>
                </div>
              <?php
               unset($_SESSION['registerError']); }
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