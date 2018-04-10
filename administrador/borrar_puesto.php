<?php

session_start();


if(empty($_SESSION['idAdministrador'])) {
  header("Location: index.php");
  exit();
}


require_once("../conexion.php");

if(isset($_GET)) {

	$sql = "DELETE FROM puestos WHERE idPuesto='$_GET[id]'";
	if($conn->query($sql)) {
		$sql1 = "DELETE FROM postulante WHERE idPuesto='$_GET[id]'";
		if($conn->query($sql1)) {
		}
		header("Location: puesto.php");
		exit();
	} else {
		echo "Error";
	}
}