<?php
session_start();
if(isset($_SESSION['id_usuario'])) {
    header("Location: oferente/panel.php");
    exit();
  }

require_once("conexion.php");

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Registro</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <link rel="stylesheet" href="css/bootstrap-select.min.css">


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

          <?php 
              if(isset($_SESSION['errorCurriculum'])) {
                ?>
                <div>
                  <p class="text-center">Error al ingresar curriculum, Intente de nuevo</p>
                </div>
              <?php
               unset($_SESSION['errorCurriculum']); }
              ?>     

          <div class="col-md-4 col-md-offset-4 well">
          <h2 class="text-center">Registrar</h2>
            <form method="post" action="agregar_usuario.php" enctype="multipart/form-data">

               <div class="form-group">
                 <label for="idOferente">ID</label>
                <input type="text" class="form-control" id="idOferente" name="idOferente" placeholder="Digite un numero de identificación" required="">
              </div>

              <div class="form-group">
                 <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" required="">
              </div>

              <div class="form-group">
                <label for="apellido">Apellido</label>
                <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellido" required="">
              </div>
              <div class="form-group">
                <label for="correo">Correo</label>
                <input type="email" class="form-control" id="correo" name="correo" aria-describedby="emailHelp" placeholder="Escriba su correo" required="">
                <small id="emailHelp" class="form-text text-muted">Nunca compartiremos su correo electrónico con nadie más.
                </small>
              </div>

               <div class="form-group">
                 <label for="nacionalidad">Nacionalidad</label>
                <input type="text" class="form-control" id="nacionalidad" name="nacionalidad" placeholder="Nacionalidad" required="">
              </div>

               <div class="form-group">
                 <label for="telefono">Teléfono</label>
                <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Digite un numero de teléfono" required="">
              </div>

               <div class="form-group">
                 <label for="residencia">Lugar de Residencia</label>
                <input type="text" class="form-control" id="residencia" name="residencia" placeholder="Lugar de residencia" required="">
              </div>

              <div class="form-group">
                 <label for="contraseña">Contraseña</label>
                <input type="password" class="form-control" id="contraseña" name="contraseña" placeholder="Contraseña" required="">
              </div>

              <div class="form-group">
                 <label for="clave">Adjunte su Curriculum Vitae en forma de PDF</label>
                  <input type="file" name="archivo" id="archivo">
              </div>

              <div class="form-group">
                 <label for="tipo">Tipo de Caracteristica</label><br>
                 <select required id='tipo' name="tipo" class="form-control selectpicker" data-live-search="true" title="Seleccione las caracteristicas" data-selected-text-format="count > 3" data-size="3" onchange="cargarCaracteristicas(this.value)">
                 <?php 
                  $sql = "SELECT * FROM tipo_caracteristicas";
                  $result = $conn->query($sql);
                  if($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) 
                    {
                  ?>
                    <option value='<?php echo $row['idTipoCaracteristica']; ?>'><?php echo $row['nombre']; ?></option>
                  <?php
                    }//cierre de while
                    }//cierre de if          
                  ?> 
                </select>
              </div>

              <div class="form-group">
                <label>Lista de Caracteristicas</label>
                      <select name="caracteristica" id="caracteristica" class="form-control selectpicker comboCar" data-live-search="true"  data-selected-text-format="count > 3" data-size="3" onchange="agregarToList()" disabled>
                      </select>
              </div>


              <!-- TABLA DE CARACTERISTICAS SELECCIONADAS-->
              <div class="form-group">
                <table id="tabla" class="table width=30 table-striped table-bordered table-condensed table-hover">
                  <thead style="background-color:#A9D0F5">
                      <th>ID</th>
                      <th>Caracteristica</th>
                  </thead>
                      <tfoot>
                        
                      </tfoot>
                      <tbody>
                        
                      </tbody>
                    </table>
              </div>  


              <br>
              <br>
             
             <div class="text-center">
                <button type="submit" class="btn btn-success">Registrar</button>
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


   <script language="JavaScript" SRC="js/caracteristicas.js"></script>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="js/bootstrap-select.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>

  </body>
</html>