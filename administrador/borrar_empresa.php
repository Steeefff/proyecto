<?php

session_start();

if(empty($_SESSION['idAdministrador'])) {
  header("Location: index.php");
  exit();
}


require_once("../conexion.php");

if(isset($_GET)) {

	$sql = "DELETE FROM empresas WHERE idEmpresa='$_GET[id]'";
	if($conn->query($sql)) {
		header("Location: empresa.php");
		exit();
	} else {
		echo "Error";
	}
}