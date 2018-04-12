<?php
session_start();
require_once("../conexion.php");

//if user clicked update profile button
if(isset($_POST)) {

	//Escape Special Characters
	$nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
	$apellido = mysqli_real_escape_string($conn, $_POST['apellido']);
	$correo = mysqli_real_escape_string($conn, $_POST['correo']);
	$nacionalidad = mysqli_real_escape_string($conn, $_POST['nacionalidad']);
	$telefono = mysqli_real_escape_string($conn, $_POST['telefono']);
	$residencia = mysqli_real_escape_string($conn, $_POST['residencia']);

	//Update Query
	$sql = "UPDATE oferentes SET nombre='$nombre', apellido='$apellido', correo='$correo', nacionalidad='$nacionalidad', telefono='$telefono', residencia='$residencia' WHERE idOferente='$_SESSION[id_usuario]'";

	if($conn->query($sql) === TRUE) {
		header("Location: ver_puestos.php");
		exit();
	} else {
		echo "Error ". $sql . "<br>" . $conn->error;
	}

	$conn->close();

} else {
	header("Location: ver_puestos.php");
	exit();
}