<?php
session_start();
require_once("../conexion.php");

//if user clicked update profile button
if(isset($_POST)) {

	//Escape Special Characters
	$nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
	$apellido = mysqli_real_escape_string($conn, $_POST['apellido']);
	$direccion = mysqli_real_escape_string($conn, $_POST['direccion']);
	$provincia = mysqli_real_escape_string($conn, $_POST['provincia']);
	$ciudad = mysqli_real_escape_string($conn, $_POST['ciudad']);
	$contactno = mysqli_real_escape_string($conn, $_POST['contactno']);
	$calificacion = mysqli_real_escape_string($conn, $_POST['calificacion']);
	$anoPasa = mysqli_real_escape_string($conn, $_POST['anoPasa']);
	$fechaNacimiento = mysqli_real_escape_string($conn, $_POST['fechaNacimiento']);
	$edad = mysqli_real_escape_string($conn, $_POST['edad']);
	$ocupacion = mysqli_real_escape_string($conn, $_POST['ocupacion']);

	//Update Query
	$sql = "UPDATE usuarios SET nombre='$nombre', apellido='$apellido', direccion='$direccion', provincia='$provincia', ciudad='$ciudad', contactno='$contactno', calificacion='$calificacion', anoPasa='$anoPasa', fechaNacimiento='$fechaNacimiento', edad='$edad', ocupacion='$ocupacion' WHERE id_usuario='$_SESSION[id_usuario]'";

	if($conn->query($sql) === TRUE) {
		header("Location: panel.php");
		exit();
	} else {
		echo "Error ". $sql . "<br>" . $conn->error;
	}

	$conn->close();

} else {
	header("Location: panel.php");
	exit();
}