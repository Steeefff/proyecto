<?php
session_start();
if(empty($_SESSION['id_usuario'])) {
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
    <title>Crear Puesto</title>

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
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only">BuscoEmpleo.com</span>
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
              <li><a href="panel.php">Panel</a></li>
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
          <h2 class="text-center">Crear Puesto de Trabajo</h2>
            <form method="post" action="agregar_puesto.php">
              <div class="form-group">
                <label for="tituloTrabajo">Titulo del Trabajo</label>
                <input type="text" class="form-control" id="tituloTrabajo" name="tituloTrabajo" placeholder="Titulo del Trabajo" required="">
              </div>
              <div class="form-group">
                <label for="descripcionTrabajo">Descripción del trabajo</label>
                <textarea class="form-control" id="descripcionTrabajo" name="descripcionTrabajo" placeholder="Descripción del Trabajo" required=""></textarea>
              </div>
              <div class="form-group">
                <label for="salarioMinimo">Salario Minimo</label>
                <input type="text" class="form-control" id="salarioMinimo" name="salarioMinimo" placeholder="Salario Minimo" required="">
              </div>
              <div class="form-group">
                <label for="password">Salario Máximo</label>
                <input type="salarioMaximo" class="form-control" id="salarioMaximo" name="salarioMaximo" placeholder="Salario Máximo" required="">
              </div>
              <div class="form-group">
                <label for="experienciaRequerida">Experiencia requerida</label>
                <input type="text" class="form-control" id="experienciaRequerida" name="experienciaRequerida" placeholder="Experiencia requerida" required="">
              </div>
              <div class="form-group">
                <label for="requisitos">Requisitos</label>
                <input type="text" class="form-control" id="requisitos" name="requisitos" placeholder="Requisitos" required="">
              </div>
             <div class="text-center">
                <button type="submit" class="btn btn-success">Crear Puesto</button>
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