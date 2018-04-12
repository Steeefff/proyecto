<?php
session_start();
header("Content-Type: text/html;charset=utf-8");
require_once("../conexion.php");
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta http-equiv="Content-Type" content="text/html; charset= ISO-8859-1" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="stylesheet" href="../css/buscador.css" type="text/css">


    <title>Panel</title>

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


    <div class="container">

      <?php if(isset($_SESSION['jobApplySuccess'])) { ?>
      <div class="row">
        <div class="col-md-12">
          <div class="alert alert-success">
            Usted a aplicado correctamente!
          </div>
        </div>
      </div>
      <?php unset($_SESSION['jobApplySuccess']); } ?>
      
      <!-- otras funciones del panel -->
      <div class="row">
        
        <div class="col-md-4 col-md-offset-1">
            <form action="" class="search-form">
                <div class="form-group has-feedback">
                <label for="search" class="sr-only">Buscar</label>
                <input type="text" class="form-control" name="search" id="buscar" placeholder="Buscar puesto">
                  <span class="glyphicon glyphicon-search form-control-feedback"></span>
              </div>
            </form>
        </div>
       </div>
      

      <!-- buscar y aplicar a los puestos de trabajo -->
      <div class="row">
        <div class="col-md-12">
          <div class="table-responsive">
            <h2 class="text-center">Trabajos Activos</h2>
            <table class="table table-striped">
              <thead>
                <th>Nombre del Trabajo</th>
                <th>Descripción </th>
                <th>Salario</th>
                <th>Vacantes</th>
                <th>Responsabilidades</th>
                <th>Fecha </th>
              </thead>
              <tbody>
                <?php 
                  $sql = "SELECT * FROM puestos";
                  //$sql = "SELECT puestos.idPuesto, puestos.nombrePuesto,puestos.salario,puestos.fecha, empresas.nombre FROM puestos JOIN empresas ON puestos.idEmpresa=empresas.idEmpresa";
                  $result = $conn->query($sql);
                  if($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) 
                    {
                      $sql1 = "SELECT * FROM postulante WHERE idPostulante='$_SESSION[id_usuario]' AND idPuesto='$row[idPuesto]'";
                      $result1 = $conn->query($sql1);
                      
                     ?>
                     <tr>
                        <td><?php echo $row['nombrePuesto']; ?></td>
                        <td><?php echo $row['descripcion']; ?></td>
                        <td><?php echo $row['salario']; ?></td>
                        <td><?php echo $row['numVacantes']; ?></td>
                        <td><?php echo $row['responsabilidades']; ?></td>
                        <td><?php echo date("d-M-Y", strtotime($row['fecha'])); ?></td>
                        <?php
                        if($result1->num_rows > 0) { 
                          ?>
                           <td><strong>Aplicado</strong></td>
                          <?php
                        } else {
                        ?>
                        <td><a href="aplicar_puestoTrabajo.php?id=<?php echo $row['idPuesto']; ?>">Aplicar</a></td>
                        <?php } ?>                        
                      </tr>
                     <?php
                    }
                  }
                  $conn->close();
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

  </body>
</html>