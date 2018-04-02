<?php
session_start();
require_once("conexion.php");

//Si el usuario presiona el boton de Registrar

if(isset($_POST)){ //si recibe algo que venga en _POST haga lo que sigue
	//caracteres especiales en string
	$idEmpresa = mysqli_real_escape_string($conn, $_POST['idEmpresa']);
	$nombreEmpresa = mysqli_real_escape_string($conn, $_POST['nombreEmpresa']); //los llama por el id
	$correo = mysqli_real_escape_string($conn, $_POST['correo']);
	$numeroContacto = mysqli_real_escape_string($conn, $_POST['numeroContacto']);
	$descripcion = mysqli_real_escape_string($conn, $_POST['descripcion']);
	$localizacion = mysqli_real_escape_string($conn, $_POST['localizacion']);
	

	//encryptar la contrasena
	$password = base64_encode(strrev(md5($password)));

	$sql = "SELECT correo FROM empresas WHERE correo='$correo'";
	$result = $conn->query($sql);

	if($result->num_rows == 0) {
	
		$sql = "INSERT INTO empresas(idEmpresa,nombre,correo,telefono,descripcion,localizacion,aprobado) VALUES ('$idEmpresa','$nombreEmpresa','$correo','$numeroContacto','$descripcion','$localizacion','0')";

		if($conn->query($sql)===TRUE) {
				$_SESSION['registerCompleted'] = true;
				header("Location: empresa_login.php");
				exit();
			} else {
				echo "Error " . $sql . "<br>" . $conn->error;
			}
		}else{
			$_SESSION['registerError'] = true;
			header("Location: empresa_registro.php");
			exit();

		}

			$conn->close();

}else{
	header("Location: empresa_registroo.php");
	exit();
}