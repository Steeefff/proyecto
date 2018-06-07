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


    <title>Panel</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <link rel="stylesheet" href="../css/pdf.css">

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


    <div class="container">

    
      
      <!-- otras funciones del panel -->
      <div class="row">
        
        <div class="col-md-12 col-md-offset-0">
            <form action="calcular_coincidencia.php" method="post" class="search-form form-inline">
                <div class="form-group has-feedback">

                   <label class="label-control">Lista de Puestos</label>
                      <select name="puestos" class="form-control">
                         <?php 
                          $sql =  "SELECT `idPuesto`,`nombrePuesto` FROM `puestos` WHERE `idEmpresa`= $_SESSION[id_usuario]";
                          $result = $conn->query($sql);
                          if($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) 
                            {
                              
                                echo "<option value=".$row['idPuesto'].">".$row['nombrePuesto']."</option>";

                              
                            }
                          }
                        ?>

                      </select>

                       <label class="label-control">Grado de Coincidencia</label>
                       <select name="grados" class="form-control">
                     
                                <option value="70">70</option>
                                <option value="85">85</option>
                                <option value="95">95</option>
                                <option value="100">100</option>


                      </select>


              <button type="submit" class="btn btn-primary"></span>Buscar</button>

              </div>
            </form>
        </div>
       </div>


       <?php if(isset($_SESSION['SinCoincidencia'])) { ?>
        <div class="row">
            <div class="alert alert-danger text-center">
              <?php echo $_SESSION['SinCoincidencia'] ?>
          </div>
        </div>
      <?php unset($_SESSION['SinCoincidencia']); } ?>
      

      <div class="row">
        <div class="col-md-12">
          <div class="table-responsive">
            <h2 class="text-center">Oferentes Actuales</h2>
            <table class="table table-striped">
              <thead>
               <th>No</th>
              <th>Nombre</th>
              <th>Apellido</th>
              <th>Correo</th>
              <th>Nacionalidad</th>
              <th>Telefono</th>
              <th>Residencia</th>
              <th>Curriculum</th>
              </thead>
              <tbody>
                <?php 

              

                  if(isset($_SESSION['listafinal'])){

                    //array
                    $array = $_SESSION['listafinal'];
                    $listaIDS="";
                    for($i=0;$i<count($array);$i++){

                      if($i+1==count($array)){
                        $listaIDS.= $array[$i];
                      }
                      else{
                        $listaIDS.= $array[$i].",";
                      }

                    }

                    $sql = "SELECT * FROM `oferentes` WHERE `idOferente`IN ($listaIDS) AND `aprobado` = 1";

                    unset($_SESSION['listafinal']);
                  }
                  else{//si no esta registrado

                    $sql = "SELECT * FROM `oferentes` WHERE `aprobado`=1";//seleccionar publicos
                  }


                  //$sql = "SELECT puestos.idPuesto, puestos.nombrePuesto,puestos.salario,puestos.fecha, empresas.nombre FROM puestos JOIN empresas ON puestos.idEmpresa=empresas.idEmpresa";
                  $result = $conn->query($sql);
                  if($result->num_rows > 0) {
                    //while recorre todos los puestos y los poner en el panel, asi se van cargando uno por uno 
                    while($row = $result->fetch_assoc()) 
                    {

                ?>
                     <tr>
                        <td><?php echo $row['idOferente']; ?></td>
                        <td><?php echo $row['nombre']; ?></td>
                        <td><?php echo $row['apellido']; ?></td>
                        <td><?php echo $row['correo']; ?></td>
                        <td><?php echo $row['nacionalidad']; ?></td>
                        <td><?php echo $row['telefono']; ?></td>
                        <td><?php echo $row['residencia']; ?></td>

                        <td><a class="btn btn-primary view-pdf" href="../archivos/<?php echo $row['curriculum']; ?>">Curriculum</a></td>
                        <input id="namePDF" name="namePDF" type="hidden" value="<?php echo $row['curriculum']; ?>">
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

    <script type="text/JavaScript">
      /*
* This is the plugin
*/
(function(a){
  a.createModal=function(b){
    defaults={title:"Curriculum",message:"Your Message Goes Here!",closeButton:true,scrollable:false};
    var b=a.extend({},defaults,b);
    var c=(b.scrollable===true)?'style="max-height: 420px;overflow-y: auto;"':"";
    html='<div class="modal fade" id="myModal">';
    html+='<div class="modal-dialog">';
    html+='<div class="modal-content">';
    html+='<div class="modal-header">';html+='<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>';
    if(b.title.length>0){
      html+='<h4 class="modal-title">'+b.title+"</h4>"
    }

    html+="</div>";
    html+='<div class="modal-body" '+c+">";
    html+=b.message;html+="</div>";
    html+='<div class="modal-footer">';
    if(b.closeButton===true){
      html+='<button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>'
    }
    html+="</div>";
    html+="</div>";
    html+="</div>";
    html+="</div>";
    a("body").prepend(html);
    a("#myModal").modal().on("hidden.bs.modal",function(){
      a(this).remove()
    })
  }
})(jQuery);

/*
* Here is how you use it
*/
$(function(){    
    $('.view-pdf').on('click',function(){
        var pdf_link = $(this).attr('href');
        //var iframe = '<div class="iframe-container"><iframe src="'+pdf_link+'"></iframe></div>'
        //var iframe = '<object data="'+pdf_link+'" type="application/pdf"><embed src="'+pdf_link+'" type="application/pdf" /></object>'        
        var iframe = '<object type="application/pdf" data="'+pdf_link+'" width="100%" height="500">No Support</object>'
        $.createModal({
            title:'Curriculum',
            message: iframe,
            closeButton:true,
            scrollable:false
        });
        return false;        
    });    
})

    </script>

  </body>
</html>