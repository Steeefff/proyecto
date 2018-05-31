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
    
   <!------INCLUYENDO EL MENU -------->
    <?php include("menu.php"); ?>
    <!---------------------------------->

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