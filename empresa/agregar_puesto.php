<?php
session_start();
require_once("../conexion.php");

//If user clicked register button
if(isset($_POST)) {

	//Escape Special Characters In String First
	$idPuesto = mysqli_real_escape_string($conn, $_POST['idPuesto']);
	$nombrePuesto = mysqli_real_escape_string($conn, $_POST['nombrePuesto']);
	$descripcion = mysqli_real_escape_string($conn, $_POST['descripcion']);
	$fecha = mysqli_real_escape_string($conn, $_POST['fecha']);
	$numVacantes = mysqli_real_escape_string($conn, $_POST['numVacantes']);
	$privado = mysqli_real_escape_string($conn, $_POST['privado']);
	$salario = mysqli_real_escape_string($conn, $_POST['salario']);
	$responsabilidades = mysqli_real_escape_string($conn, $_POST['responsabilidades']);
	$categoria = mysqli_real_escape_string($conn, $_POST['categoria']);

	$sql = "INSERT INTO puestos(idEmpresa,idPuesto, nombrePuesto, descripcion,fecha,numVacantes,privado,salario,responsabilidades,idCategoria,estadoPuesto) VALUES ('$_SESSION[id_usuario]','$idPuesto','$nombrePuesto', '$descripcion', '$fecha', '$numVacantes', '$privado', '$salario','$responsabilidades','$categoria',1)";

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