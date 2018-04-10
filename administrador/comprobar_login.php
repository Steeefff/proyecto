<?php


session_start();

require_once("../conexion.php");

if(isset($_POST)) {

	$nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
	$clave = mysqli_real_escape_string($conn, $_POST['clave']);

	//Encrypt Password
	// $password = base64_encode(strrev(md5($password)));

	//login
	$sql = "SELECT * FROM administradores WHERE nombre='$nombre' AND clave='$clave'";
	$result = $conn->query($sql);

	
	if($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			
			$_SESSION['idAdministrador'] = $row['idAdministrador'];
			header("Location: panel.php");
			exit();
			

			
		}
 	} else {

 		$_SESSION['loginError'] = $conn->error;
 		header("Location: index.php");
		exit();
 	}

 	$conn->close();

} else {
	header("Location: index.php");
	exit();
}