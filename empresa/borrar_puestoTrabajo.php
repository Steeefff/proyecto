<?php
session_start();
require_once("../conexion.php");

//If user clicked register button
if(isset($_POST)) {

	

	$sql = "DELETE FROM puesto_trabajo WHERE id_puesto='$_GET[id]' AND id_empresa='$_SESSION[id_usuario]'"; 

	if($conn->query($sql)===TRUE) {
		$_SESSION['jobPostDeleteSuccess'] = true;
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