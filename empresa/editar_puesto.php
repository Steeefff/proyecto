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

	$sql = "UPDATE puesto_trabajo SET tituloTrabajo = '$tituloTrabajo', descripcionTrabajo = '$descripcionTrabajo', salarioMinimo='$salarioMinimo', salarioMaximo='$salarioMaximo', experienciaRequerida='$experienciaRequerida', requisitos='$requisitos' WHERE id_puesto='$_POST[target_id]'AND id_empresa='$_SESSION[id_usuario]'"; 

	if($conn->query($sql)===TRUE) {
		$_SESSION['jobPostUpdateSuccess'] = true;
		header("Location: trabajosPublicados.php");
		exit();
	} else {
		echo "Error " . $sql . "<br>" . $conn->error;
	}

	$conn->close();

} else {
	header("Location: trabajos_publicados.php");
	exit();
}