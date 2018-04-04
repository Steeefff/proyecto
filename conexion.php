<?php

$servername = "localhost";
$username = "root";
$password ="";
$dbname ="bolsaempleo";

//Crear Conexion

$conn = new mysqli($servername, $username, $password, $dbname);

//Comprobar conexion
if($conn->connect_error) {
	die("Connection Failed: ". $conn->connect_error);
}
/*else{
	echo "conectado";
}*/