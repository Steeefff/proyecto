<?php
session_start();
header("Content-Type: text/html;charset=utf-8");

require_once("conexion.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Panel</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

  </head>
  <body>
    
   <!------INCLUYENDO EL MENU -------->
    <?php include("menu.php"); ?>
    <!---------------------------------->


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
        <h2 class="text-center">Mi panel de busqueda</h2>
      </div>

      <!-- buscar y aplicar a los puestos de trabajo -->
      <div class="row">
        <div class="col-md-12">
          <div class="table-responsive">
            <h2 class="text-center">Resultados de los trabajos</h2>
            <table class="table table-striped">
              <thead>
                <th>Nombre del Trabajo</th>
                <th>Descripción </th>
                <th>Salario</th>
                <th>Vacantes</th>
                <th>Estado Puesto</th>
                <th>Responsabilidades</th>
                <th>Fecha </th>
                <th>Acción</th>
              </thead>
              <tbody>
                <?php 

                $buscarCaracteristicas = mysqli_real_escape_string($conn, $_POST['buscarCaracteristicas']);

                  $sql = "SELECT * FROM puestos";
                  $result = $conn->query($sql);
                  if($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) 
                    {
                    $sql2 = "SELECT * FROM puestos WHERE descripcion like '%" .$buscarCaracteristicas."%' order by idPuesto";


                      $result1 = $conn->query($sql2);
                      
                     ?>
                     <tr>
                        <td><?php echo $row['nombrePuesto']; ?></td>
                        <td><?php echo $row['descripcion']; ?></td>
                        <td><?php echo $row['salario']; ?></td>
                        <td><?php echo $row['numVacantes']; ?></td>
                        <td><?php echo $row['estadoPuesto']; ?></td>
                        <td><?php echo $row['responsabilidades']; ?></td>
                        <td><?php echo date("d-M-Y", strtotime($row['fecha'])); ?></td>
                        <?php
                        if($result1->num_rows > 0) { 
                          ?>
                           <td><strong>Aplicado</strong></td>
                          <?php
                        } else {
                        ?>
                        <td><a href="aplicar_puestoTrabajo.php?id=<?php echo $row['id_puesto']; ?>">Aplicar</a></td>
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