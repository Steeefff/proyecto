<?php

session_start();

if(empty($_SESSION['idAdministrador'])) {
  header("Location: index.php");
  exit();
}


require_once("../conexion.php");

if(isset($_GET)) {

	$sql = "UPDATE  oferentes SET aprobado='0' WHERE idOferente='$_GET[id]'";
	if($conn->query($sql)) {
		header("Location: panel.php");
		exit();
	} else {
		echo "Error";
	}
}