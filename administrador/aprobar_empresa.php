<?php

session_start();

if(empty($_SESSION['idAdministrador'])) {
  header("Location: index.php");
  exit();
}


require_once("../conexion.php");

if(isset($_GET)) {

	//---------------------------------------CODIGO PARA GENERAR CONTRASEÑA-------------------------------------
/*
	$longitud = 8;
	$codReserva="";//codigo de reserva que se le dará al usuario y se guardara en la BD
	 
	$letras ="abcdefghijklmnopqrstuvwxyz";
	$numeros = "1234567890";
	$letrasMayus = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	$listado = "";
	 
	//Se le concatenan las letras,numero y mayusculas para luego escoger una aleatoriamente e ir guardandolas en el array
	$listado .= $letras; 
	$listado .= $numeros; 
	$listado .= $letrasMayus; 
	
	//Metodo para escoger alguna letra del listado de forma aleatoria 
	str_shuffle($listado);//shuffle reordena el listado de forma random
	for( $i=1; $i<=$longitud; $i++) {
		$codReserva .= $listado[rand(0,strlen($listado))];//Se van concatenando uno a uno las letras/numeros en la variable codReserva
		str_shuffle($listado);
	}
*/

//---------------------------------------------------------------------------

	//encryptar la contrasena
	//$codReserva = base64_encode(strrev(md5($codReserva)));

	$sql = "UPDATE  empresas SET aprobado='1' WHERE idEmpresa='$_GET[id]'";
	if($conn->query($sql)) {
		header("Location: panel.php");
		exit();
	} else {
		echo "Error";
	}
}