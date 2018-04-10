<?php

session_start();

if(empty($_SESSION['idAdministrador'])) {
  header("Location: index.php");
  exit();
}


require_once("../conexion.php");

if(isset($_GET)) {

	$sql = "DELETE FROM caracteristicas WHERE idCaracteristica='$_GET[id]'";
	if($conn->query($sql)) {
		header("Location: caracteristicas.php");
		exit();
	} else {
		echo "Error";
	}
}