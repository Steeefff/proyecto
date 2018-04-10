<?php


session_start();
header("Content-Type: text/html;charset=utf-8");


require_once("conexion.php");

if(isset($_POST)) {


	$correo = mysqli_real_escape_string($conn, $_POST['correo']);
	$clave = mysqli_real_escape_string($conn, $_POST['clave']);


	$clave = base64_encode(strrev(md5($clave)));


	$sql = "SELECT idEmpresa, nombre, correo, aprobado FROM empresas 
	WHERE correo='$correo' AND clave='$clave'";
	$result = $conn->query($sql);


	if($result->num_rows > 0) {
		//output data
		while($row = $result->fetch_assoc()) {

			if($row['aprobado'] == '2') {
				$_SESSION['companyLoginError'] = 
				"Su cuenta aun esta pendiente de aprobacion.";
				header("Location: empresa_login.php");
				exit();
			} else if($row['aprobado'] == '0') {
				$_SESSION['companyLoginError'] = "Su cuenta fue rechazada. Para mayor informacion contactenos.";
				header("Location: empresa_login.php");
				exit();
			} else if($row['aprobado'] == '1') {
				

				$_SESSION['nombre'] = $row['nombre'];
				$_SESSION['correo'] = $row['correo'];
				$_SESSION['id_usuario'] = $row['idEmpresa'];
				$_SESSION['companyLogged'] = true;

				header("Location: empresa/panel.php");
				exit();
			}
		}
 	} else {
 		
 		$_SESSION['loginError'] = $conn->error;
 		header("Location: empresa_login.php");
		exit();
 	}

 	
 	$conn->close();

} else {

	header("Location: empresa_login.php");
	exit();
}