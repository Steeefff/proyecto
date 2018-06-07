<?php
session_start();
header("Content-Type: text/html;charset=utf-8");
require_once("conexion.php");

if(isset($_GET['id'])){
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
    <link rel="stylesheet" href="css/buscador.css" type="text/css">


    <title>Puestos Públicados</title>

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
      
     
      

      <!-- buscar y aplicar a los puestos de trabajo -->
      <div class="row">
        <div class="col-md-12">
          <div class="table-responsive">
            <h2 class="text-center">Trabajos Publicados</h2>
            <table class="table table-striped">
              <thead>
                <th>Nombre del Trabajo</th>
                <th>Descripción </th>
                <th>Salario</th>
                <th>Vacantes</th>
                <th>Responsabilidades</th>
                <th>Requisitos</th>
                <th>Fecha </th>
                <th></th>
              </thead>
              <tbody>
                <?php 

                  if(isset($_GET['id'])){
                    $idEmpresa = mysqli_real_escape_string($conn, $_GET['id']);
                  }


                  if(isset($_SESSION['id_usuario'])){

                    $sql = "SELECT DISTINCT puestos.idPuesto,puestos.nombrePuesto,puestos.descripcion,puestos.salario,puestos.numVacantes,puestos.responsabilidades,puestos.fecha FROM caracteristicas JOIN requisitos_puesto ON caracteristicas.idCaracteristica = requisitos_puesto.idCaracteristicas JOIN puestos ON puestos.idPuesto = requisitos_puesto.idPuesto WHERE caracteristicas.nombre LIKE '%%' AND puestos.idEmpresa =".$idEmpresa."";
                  }
                  else{//si no esta registrado

                    $sql = "SELECT DISTINCT puestos.idPuesto,puestos.nombrePuesto,puestos.descripcion,puestos.salario,puestos.numVacantes,puestos.responsabilidades,puestos.fecha FROM caracteristicas JOIN requisitos_puesto ON caracteristicas.idCaracteristica = requisitos_puesto.idCaracteristicas JOIN puestos ON puestos.idPuesto = requisitos_puesto.idPuesto WHERE caracteristicas.nombre LIKE '%%' AND privado=0 AND puestos.idEmpresa =".$idEmpresa."";//seleccionar publicos
                  }


                  //$sql = "SELECT puestos.idPuesto, puestos.nombrePuesto,puestos.salario,puestos.fecha, empresas.nombre FROM puestos JOIN empresas ON puestos.idEmpresa=empresas.idEmpresa";
                  $result = $conn->query($sql);
                  if($result->num_rows > 0) {
                    //while recorre todos los puestos y los poner en el panel, asi se van cargando uno por uno 
                    while($row = $result->fetch_assoc()) 
                    {

                    $sql3="SELECT caracteristicas.nombre FROM caracteristicas JOIN requisitos_puesto ON caracteristicas.idCaracteristica = requisitos_puesto.idCaracteristicas JOIN puestos ON puestos.idPuesto = requisitos_puesto.idPuesto WHERE puestos.idPuesto = '$row[idPuesto]'";

                    $result3 = $conn->query($sql3);

                ?>
                     <tr>
                        <td><?php echo $row['nombrePuesto']; ?></td>
                        <td><?php echo $row['descripcion']; ?></td>
                        <td><?php echo $row['salario']; ?></td>
                        <td><?php echo $row['numVacantes']; ?></td>
                        <td><?php echo $row['responsabilidades']; ?></td>

                        <!-- WHILE PARA MOSTRAR TODOSO LOS REQUISITOS(CARACTERISTICAS) DE CADA PUESTO -->
                        <td>
                          <?php 
                          if($result->num_rows > 0){
                           // el result3 trae las caracteristicas fila por fila osea cada caracteristica 
                            while($row3 = $result3->fetch_assoc()){
                              echo $row3['nombre']."-"; //el guion es para separar las caracteristicas unoas de otras
                            } 
                          }
                          ?>
                        </td>
                        <!-- FIN DE WHILE-->
                        


                        <td><?php echo date("d-M-Y", strtotime($row['fecha'])); ?></td>
                        
                      <?php

                      if(isset($_SESSION['id_usuario'])){
                            $sql1 = "SELECT * FROM postulante WHERE idCandidato='$_SESSION[id_usuario]' AND idPuesto='$row[idPuesto]'";
                            $result1 = $conn->query($sql1);
                            if($result1->num_rows > 0) { 
                               echo "<td><strong>Aplicado</strong></td>";
                            } else {
                          ?>
                            <td><a href="oferente/aplicar.php?id=<?php echo $row['idPuesto']; ?>">Aplicar</a></td>
                          <?php 
                            }//cierre de else 
                      }//cierre de if $_SESSION['id_usuario']
                      ?>  
                      </tr>
                     <?php
                    }//cierre de while
                  }//
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
<?php
}

?>