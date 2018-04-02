<?php
session_start();
require_once("conexion.php");

//Si el usuario hizo clic en el botón de inicio de sesión 
if(isset($_POST)) {

	//Escape Special Characters in String

	$correo = mysqli_real_escape_string($conn, $_POST['correo']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);

	//Encrypt Password
	$password = base64_encode(strrev(md5($password)));

	$sql = "SELECT idOferente, nombre, apellido, correo FROM oferentes WHERE correo='$correo' AND clave='$password' AND aprobado=1 ";
	$result = $conn->query($sql);

	if($result->num_rows > 0) {
		//output data
		while($row = $result->fetch_assoc()) {
			$_SESSION['nombre'] = $row['nombre'] . " " . $row['apellido'];
			$_SESSION['correo'] = $row['correo'];
			$_SESSION['id_usuario'] = $row['idOferente'];
			header("Location: oferente/panel.php");
			exit();
		}
 	} else {
 		$_SESSION['loginError'] = $conn->error;
 		header("Location: login.php");
		exit();
 	}

 	$conn->close();

} else {
	//redirect them back to login page
	header("Location: login.php");
	exit();
}