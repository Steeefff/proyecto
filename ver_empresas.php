<?php
session_start();
require_once("conexion.php");
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Ver Empresas</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    

    <!--API DE GOOGLE-->
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?&language=es&region=CR&key=
AIzaSyAtkovx7YEf0xJd4GW71JgsEjjZoFMU0F4
"></script>
    <script type="text/javascript" src="js/mapEmpresas.js"></script>

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


    <?php

      $locations=array();
      $sql = "SELECT * FROM empresas where aprobado = 1";
      $result = $conn->query($sql); 
      
      if($result->num_rows > 0) {

        while($row = $result->fetch_assoc()){ 
            
          $nombre = $row['nombre'];
          
          $longitud = $row['longitud'];           
          
          $latitud = $row['latitud'];
          
          $idEmpresa=$row['idEmpresa'];
          
          /* Each row is added as a new array */
          
          $locations[]=array( 'nombre'=>$nombre, 'lat'=>$latitud, 'lng'=>$longitud, 'id'=>$idEmpresa );
        }
      }

      //echo $locations[0]['nombre'].": lat: ".$locations[0]['lat'].", lng: ".$locations[0]['lng'].".<br>";
      //echo $locations[1]['nombre'].": lat: ".$locations[1]['lat'].", lng: ".$locations[1]['lng'].".<br>";

    ?>


    <section>
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-md-offset-3 well">
          <h2 class="text-center">Buscar Empresas</h2>
          <!--
            <form method="post" action="agregar_empresa.php" onsubmit="onEnviar()">

              
              <div class="form-group">
                <label for="nombreEmpresa">Empresas cercanas a: </label>
                <select class="form-control" name="ubicacion" id="ubicacion">
                    <option value="">Seleccione el lugar</option>
                    <option value="BMW|Red">San José</option>
                    <option value="Mercedes|Black">Alajuela</option>
                </select>
              </div>
         
              <!--IDS DE LAS COORDENADAS DEL MARCADOR PARA GUARDARLAS, PERO NO SE OCUPAN MOSTRAR-->
              <!--
              <input id="longitud" name="longitud" type="hidden" />
              <input id="latitud" name="latitud" type="hidden" />

              
             <div class="text-center">
                <button type="submit" class="btn btn-success" >Buscar</button>
             </div>
                 
            </form>-->


            <div class="form-group">
                <label for="localizacion">Localización</label>
                <!--ETIQUETA DONDE SE CREARA EL MAPA-->
              <div id="map" style="width:100%;height:400px;border: 1px solid #000;"></div>

            </div>

          </div>
        </div>
      </div>
    </section>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script type="text/javascript">

//se pasan las posiciones,latitud y longitud y todo de la empresa a javaScript porque estaban en php
    var locations= <?php echo json_encode($locations); ?>;

    /*for(var i=0;i<2;i++){
        alert(locations[i]['nombre']);
    }*/

 </script>
  </body>
</html>