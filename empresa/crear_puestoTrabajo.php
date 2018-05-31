<?php
session_start();
require_once("../conexion.php");
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <link rel="stylesheet" href="../css/bootstrap-select.min.css">



    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    
   <!------INCLUYENDO EL MENU -------->
    <?php include("../menu.php"); ?>
    <!---------------------------------->


    <section>
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-md-offset-4 well">
          <h2 class="text-center">Crear Puesto de Trabajo</h2>
            <form method="post" action="agregar_puesto.php">

              

              <div class="form-group">
                <label for="nombrePuesto">Nombre del Puesto</label>
                <input type="text" class="form-control" id="nombrePuesto" name="nombrePuesto" placeholder="Nombre del Trabajo" required="">
              </div>
              <div class="form-group">
                <label for="descripcion">Descripción del trabajo</label>
                <textarea class="form-control" id="descripcion" name="descripcion" placeholder="Descripción del Trabajo" required=""></textarea>
              </div>
              <div class="form-group">
                <label for="fecha">Fecha de Publicacion</label>
                <input type="date" class="form-control" id="fecha" name="fecha" placeholder="Fecha de publicación del puesto" required="">
              </div>

               <div class="form-group">
                <label for="numVacantes">Numero de Vacantes</label>
                <input type="text" class="form-control" id="numVacantes" name="numVacantes" placeholder="Vacantes disponibles
                " required="">
              </div>



               <div class="form-group">
                <label for="privado">Puesto: </label>
                <select class="form-control" name="privado">
                  <option value="0">Público</option>
                  <option value="1">Privado</option>
                </select>
              </div>



              <!-- CATEGORIAS -->
              <div class="form-group">
                <label for="categoria">Categoría</label>
                <select class="form-control" name="categoria">
                 <!-- Bucle para cargar todas las categorias en el combobox-->
                  <?php
                  $sql = "SELECT * FROM categorias";
                        $result = $conn->query($sql); 
                        if($result->num_rows > 0) {

                          while($row = $result->fetch_assoc()) 
                          {
                            echo "<option value=".$row['idCategorias'].">".$row['nombre']."</option>";
                          }
                        }

                  ?>
                </select>
              </div>

              <div class="form-group">
                <label for="salario">Salario</label>
                <input type="text" class="form-control" id="salario" name="salario" placeholder="Salario" required="">
              </div>
            
              <div class="form-group">
                <label for="responsabilidades">Responsabilidades</label>
                <textarea class="form-control" rows="3" id="responsabilidades" name="responsabilidades" placeholder="Responsabilidades" required=""></textarea>
              </div>



              <!--HACER UN QUERY QUE SELECCIONE TODAS LAS CARACTERISTICAS-->

               <div class="form-group">
                 <label for="tipo">Tipo de Requisito</label><br>
                 <select required id='tipo' name="tipo" class="form-control selectpicker" data-live-search="true" title="Seleccione las caracteristicas" data-selected-text-format="count > 3" data-size="3" onchange="cargarCaracteristicas(this.value)">
                 <?php 
                  $sql = "SELECT * FROM tipo_caracteristicas";
                  $result = $conn->query($sql);
                  if($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) //i++ va pasando de fila en fila 
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
                <label>Lista de Requisitos</label>
                      <select name="caracteristica" id="caracteristica" class="form-control selectpicker comboCar" data-live-search="true"  data-selected-text-format="count > 3" data-size="3" onchange="agregarToList()" disabled>
                      </select>
              </div>

              <div class="form-group">
                <table id="tabla" class="table width=30 table-striped table-bordered table-condensed table-hover">
                  <thead style="background-color:#A9D0F5">
                      <th>ID</th>
                      <th>Requisito</th>
                  </thead>
                      <tfoot>
                        
                      </tfoot>
                      <tbody>
                        
                      </tbody>
                    </table>
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

     <script language="JavaScript" SRC="../js/caracteristica_empresa.js"></script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="../js/bootstrap-select.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>

  </body>
</html>