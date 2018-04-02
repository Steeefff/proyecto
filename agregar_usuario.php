<?php
session_start();
require_once("conexion.php");

//Si el usuario presiona el boton de Registrar

if(isset($_POST)){
	//caracteres especiales en string
	$id = mysqli_real_escape_string($conn, $_POST['idOferente']);
	$nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
	$apellido = mysqli_real_escape_string($conn, $_POST['apellido']);
	$correo = mysqli_real_escape_string($conn, $_POST['correo']);
	$nacionalidad = mysqli_real_escape_string($conn, $_POST['nacionalidad']);
	$telefono = mysqli_real_escape_string($conn, $_POST['telefono']);
	$residencia = mysqli_real_escape_string($conn, $_POST['residencia']);

	//encryptar la contrasena
	$password = base64_encode(strrev(md5($password)));

	$sql = "SELECT correo FROM oferentes WHERE correo='$correo' "; //verificamos que NO exista el correo para que no se repita 
	$result = $conn->query($sql);

	if($result->num_rows == 0) {
	
		$sql = "INSERT INTO oferentes(idOferente,nombre, apellido, correo, nacionalidad,telefono,residencia,aprobado) VALUES ('$id','$nombre','$apellido','$correo','$nacionalidad','$telefono','$residencia',0)";
		if($conn->query($sql)===TRUE) {
				$_SESSION['registerCompleted'] = true;
				header("Location: login.php");
				exit();
			} else {
				echo "Error " . $sql . "<br>" . $conn->error;
			}
		}else{
			$_SESSION['registerError'] = true;
			header("Location: registro.php");
			exit();

		}

			$conn->close();

}else{
	header("Location: registro.php");
	exit();
}