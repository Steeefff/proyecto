<?php
require_once("conexion.php");

//If user clicked button para buscar trabajo
if(isset($_POST)) {

	$buscarCaracteristicas = mysqli_real_escape_string($conn, $_POST['buscarCaracteristicas']);

	$sql = "select * from puestos where descripcion like '%" .$buscarCaracteristicas . "%' order by idPuesto";

	echo ("Se encotro el trabajo");
	header("Location: panelBusqueda.php");


} else {
	header("Location: index.php");
	exit();
}