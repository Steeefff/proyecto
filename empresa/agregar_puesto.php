<?php
session_start();
require_once("../conexion.php");

//If user clicked register button
if(isset($_POST)) {

	//Escape Special Characters In String First

	$nombrePuesto = mysqli_real_escape_string($conn, $_POST['nombrePuesto']);
	$descripcion = mysqli_real_escape_string($conn, $_POST['descripcion']);
	$fecha = mysqli_real_escape_string($conn, $_POST['fecha']);
	$numVacantes = mysqli_real_escape_string($conn, $_POST['numVacantes']);
	$privado = mysqli_real_escape_string($conn, $_POST['privado']);
	$salario = mysqli_real_escape_string($conn, $_POST['salario']);
	$responsabilidades = mysqli_real_escape_string($conn, $_POST['responsabilidades']);
	$categoria = mysqli_real_escape_string($conn, $_POST['categoria']);

	$sql = "INSERT INTO puestos(idEmpresa, nombrePuesto, descripcion,fecha,numVacantes,privado,salario,responsabilidades,idCategoria,estadoPuesto) VALUES ('$_SESSION[id_usuario]','$nombrePuesto', '$descripcion', '$fecha', '$numVacantes', '$privado', '$salario','$responsabilidades','$categoria',1)";


	if($conn->query($sql)===TRUE) {

		$idPuesto=$conn->insert_id;
		// inserta cada uno de los requisitos del puesto
		foreach ($_POST['idCaracteristica'] as $idActual) {
			$sql2 = "INSERT INTO `requisitos_puesto` (`idPuesto`, `idCaracteristicas`) VALUES ('$idPuesto','$idActual')";
			$conn->query($sql2);
		}

		$_SESSION['jobPostSuccess'] = true;
		header("Location: trabajos_publicados.php");
		exit();
	} else {
		echo "Error " . $sql . "<br>" . $conn->error;
	}

	$conn->close();

} else {
	header("Location: trabajos_publicados.php");
	exit();
}