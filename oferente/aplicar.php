<?php
session_start();
require_once("../conexion.php");

//If user clicked register button
if(isset($_GET)) {

	//Verificar que no este aplicado
	$sql1 = "SELECT * FROM postulante WHERE idCandidato='$_SESSION[id_usuario]' AND idPuesto='$_GET[id]'";
    $result1 = $conn->query($sql1);
    if($result1->num_rows == 0) {  //si es 0 quiere decir que no ha aplicado entonces vamos a insertar
    	
    	$sql = "INSERT INTO `postulante` (`idPuesto`, `idCandidato`) VALUES ('$_GET[id]', '$_SESSION[id_usuario]')";

		if($conn->query($sql)===TRUE) {
			$_SESSION['jobApplySuccess'] = true;
			header("Location: trabajos_aplicados.php");
			exit();
		} else {
			echo "Error " . $sql . "<br>" . $conn->error;
		}

		$conn->close();

    }  else {
		header("Location: trabajos_aplicados.php");
		exit();
	}
	

} else {
	header("Location: trabajos_aplicados.php");
	exit();
}