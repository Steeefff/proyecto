<?php
session_start();
require_once("../conexion.php");

//If user clicked register button
if(isset($_POST)) {

	//Escape Special Characters In String First
	$idPuesto= mysqli_real_escape_string($conn, $_POST['puestos']);
	$gradoCoincidencia = mysqli_real_escape_string($conn, $_POST['grados']);
	$numCoincidencias = 0;
	$arrayOferentes = array();


	$sql = "SELECT `idCaracteristicas` FROM `requisitos_puesto` WHERE `idPuesto`=$idPuesto"; 
    $requisitosPuesto = $conn->query($sql);// conn->query ejecuta el sql, el resultado que devuelve del select se guarda en la variable $requisitosPuesto
    $totalRequisitos = $requisitosPuesto->num_rows;

    //para poder comparar con las caracteristicas de los oferentes primero necesito traerme el oferente para poderlo comparar con los requisitos obtenidos en el select anterios que se guardó en $requisitosPuesto
    $sql = "SELECT `idOferente` FROM `oferentes` WHERE `aprobado`=1"; 
    $oferentes = $conn->query($sql);// conn->query ejecuta el sql, el resultado que devuelve del select se guarda en la variable $oferentes

    if($oferentes->num_rows > 0) { //mientras que el array $oferentes tenga mas de 0 filas (osea que tenga algo) 
        while($row = $oferentes->fetch_assoc()) { //entonces recorremos fila por fila
                  $idOferente = $row['idOferente'];
                  $sql1="SELECT `idCaracteristica` FROM `lista_caracteristicas` WHERE `idOferente`= $idOferente ";
                  $caracteristicasDeOferente= $conn->query($sql1);   
                  
                  if($caracteristicasDeOferente->num_rows > 0) { //mientras que el array $caracteristicasDeOferente tenga mas de 0 filas (osea que tenga algo) 
                   		while($row1 = $caracteristicasDeOferente->fetch_assoc()) { 
                     		$idCaracteristica = $row1['idCaracteristica'];

                     		$sql3 = "SELECT `idCaracteristicas` FROM `requisitos_puesto` WHERE `idPuesto`=$idPuesto"; 
    						$requisitosPuesto = $conn->query($sql3);

                     		while ( $row2 = $requisitosPuesto->fetch_assoc()) {
                     			if($idCaracteristica == $row2['idCaracteristicas']){
                     				$numCoincidencias++;
                     			}
                     		}

                     	}//while
               	   }else{
               	   	$numCoincidencias=0;
               	   }//if
                     
	       $gradoOferente= ($numCoincidencias * 100) / $totalRequisitos; 

	       if($gradoOferente>=$gradoCoincidencia){
	       		array_push($arrayOferentes,$idOferente);
	       }
            
            $numCoincidencias=0;//limpiar la variable                  
        }//fin de while
    }//fin de if

	$conn->close();

	//echo "lista final:";
	//print_r($arrayOferentes);

	if(count($arrayOferentes)> 0 )
		$_SESSION['listafinal'] = $arrayOferentes;
	else
		$_SESSION['SinCoincidencia'] = "No se encontraron Oferentes que cumplan esos requisitos";


	
	header("Location: buscar_oferente.php");
	exit();

} else {
	header("Location: buscar_oferente.php");
	exit();
}