<?php
session_start();
require_once("../conexion.php");
if(empty($_SESSION['idAdministrador'])) {
  header("Location: index.php");
  exit();
}

//Si el usuario presiona el boton de Registrar

if(isset($_POST)){
	//caracteres especiales en string
	

	$tipo = mysqli_real_escape_string($conn, $_POST['tipo']);
	$nombre = mysqli_real_escape_string($conn, $_POST['nombreCaracteristica']);
	
 

	if($result->num_rows == 0) {
	
		$sql = "INSERT INTO caracteristicas (nombre, idAdmin, idTipoCaracteristica) VALUES ('$nombre','".$_SESSION['idAdministrador']."','$tipo')";
		if($conn->query($sql)===TRUE) {
				$_SESSION['registerCompleted'] = true;
				header("Location: panel.php");
				exit();
			} else {
				echo "Error " . $sql . "<br>" . $conn->error;
			}
		}else{
			$_SESSION['registerError'] = true;
			header("Location: caracteristicas.php");
			exit();

		}

			$conn->close();

}else{
	header("Location: caracteristicas.php");
	exit();
}