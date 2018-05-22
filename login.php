<?php
  session_start(); 
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
    <!-- Las 3 meta etiquetas anteriores *deben* ser lo primero en la cabeza; cualquier otro contenido principal debe venir *después* de estas etiquetas -->
    <title>Login</title>
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
    
   <!------------------------------ NAVIGATION BAR (MENU)-------------------------------------->
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
            
            <!-----------------TODOS (PUBLICO Y PRIVADO)------------------>
            <li><a href="ver_puestos.php">Ver Puestos</a></li>

            <!-----------------LOGUEADO COMO USUARIO------------------>
            <?php
            if(isset($_SESSION['id_usuario']) && empty($_SESSION['empresaLogeada'])) {
              ?>
              <li><a href="trabajos_aplicados.php">Mis Trabajos Aplicados</a></li>
              <li><a href="oferente/panel.php">Panel</a></li>
              <li><a href="cerrar_sesion.php">Cerrar sesión</a></li>
            
            <!-----------------LOGUEADO COMO EMPRESA------------------>
            <?php
            } else if(empty($_SESSION['id_usuario']) && isset($_SESSION['empresaLogeada'])) {
            ?>
            <li><a href="empresa/panel.php">Panel</a></li>
            <li><a href="cerrar_sesion.php"><span class="glyphicon glyphicon-log-in"></span> Cerrar sesión</a></li>

            <!----------------- SOLO PARTE PUBLICA(no privada)------------------>
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
<!------------------------------------------------------- FIN DE MENU -------------------------------------------->

    <section>
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-md-offset-4 well">
          <h2 class="text-center">Iniciar sesión</h2>
            <form method="post" action="comprobar_login.php">


               <div class="form-group">
                <label>Iniciar Sesión como:</label>
                      <select name="tipoInicio" id="tipoInicio" class="form-control" title="Seleccione como iniciar sesión">
                        <option value="oferente">Oferente</option>
                        <option value="empresa">Empresa</option>
                        <option value="admin">Administrador</option>
                      </select>
              </div>

              <div class="form-group">
                <label for="correo">Correo</label>
                <input type="email" class="form-control" id="correo" name="correo" placeholder="correo" required="">
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required="">
              </div>
              <div class="text-center">
                <button type="submit" class="btn btn-success">Entrar</button>
              </div>

              <?php 
              if(isset($_SESSION['registerCompleted'])) {
                ?>
                <div>
                  <p id="successMenssage" class="text-center">Se registro exitosamente!</p>
                </div>
              <?php
               unset($_SESSION['registerCompleted']); }
              ?>   
              <?php 
              if(isset($_SESSION['msjLoginError'])) {
                ?>
                <div>
                  <p class="text-center"><?php echo $_SESSION['msjLoginError']?></p>
                </div>
              <?php
               unset($_SESSION['loginError']);
               unset($_SESSION['msjLoginError']);
               }
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

    <script type="text/javascript">
      $(function(){
        $("#successMenssage:visible").fadeOut(2000);
      });
    </script>
  </body>
</html>