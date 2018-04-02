<?php
session_start();
require_once("../conexion.php");

//If user clicked register button
if(isset($_POST)) {

	//Escape Special Characters In String First
	$tituloTrabajo = mysqli_real_escape_string($conn, $_POST['tituloTrabajo']);
	$descripcionTrabajo = mysqli_real_escape_string($conn, $_POST['descripcionTrabajo']);
	$salarioMinimo = mysqli_real_escape_string($conn, $_POST['salarioMinimo']);
	$salarioMaximo = mysqli_real_escape_string($conn, $_POST['salarioMaximo']);
	$experienciaRequerida = mysqli_real_escape_string($conn, $_POST['experienciaRequerida']);
	$requisitos = mysqli_real_escape_string($conn, $_POST['requisitos']);

	$sql = "INSERT INTO puesto_trabajo(id_empresa, tituloTrabajo, descripcionTrabajo, salarioMinimo, salarioMaximo, experienciaRequerida, requisitos) VALUES ('$_SESSION[id_usuario]','$tituloTrabajo', '$descripcionTrabajo', '$salarioMinimo', '$salarioMaximo', '$experienciaRequerida', '$requisitos')";

	if($conn->query($sql)===TRUE) {
		$_SESSION['jobPostSuccess'] = true;
		header("Location: panel.php");
		exit();
	} else {
		echo "Error " . $sql . "<br>" . $conn->error;
	}

	$conn->close();

} else {
	header("Location: panel.php");
	exit();
}