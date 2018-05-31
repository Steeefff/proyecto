<?php
session_start();
require_once("conexion.php");

//Si el usuario hizo clic en el botón de inicio de sesión 
if(isset($_POST)) {

	//Escape Special Characters in String

	$tipoUsuario =  mysqli_real_escape_string($conn, $_POST['tipoInicio']);
	$correo = mysqli_real_escape_string($conn, $_POST['correo']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);

	//Encrypt Password
	//$password = base64_encode(strrev(md5($password)));

	//SEGÚN EL TIPO DE USUARIO EL SELECT VA A VARIAR PARA VALIDAR LAS CREDENCIALES
	if($tipoUsuario=='oferente'){
		$sql = "SELECT idOferente, nombre, apellido, correo, aprobado FROM oferentes WHERE correo='$correo' AND clave='$password'";
	}
	else if ($tipoUsuario=='empresa'){
		$sql = "SELECT idEmpresa, nombre, correo, aprobado FROM empresas WHERE correo='$correo' AND clave='$password'";

	}
	else if ($tipoUsuario=='admin'){
		$sql = "SELECT * FROM administradores WHERE nombre='$correo' AND clave='$password'";

	}

	//Se ejecuta el Select
	$result = $conn->query($sql);

	if($result->num_rows > 0) {
		//output data
		while($row = $result->fetch_assoc()) {


			if($tipoUsuario=='admin'){
				$_SESSION['idAdministrador'] = $row['idAdministrador'];
				header("Location: administrador/panel.php");
				exit();
			}

			//LOS OFERENTES Y LAS EMPRESAS HAY QUE COMPROBAR SI ESTAN APROBADOS
			else if($tipoUsuario=='oferente' || $tipoUsuario=='empresa'){

				if($row['aprobado'] == '2') {
					$_SESSION['msjLoginError'] = "Su cuenta aun esta pendiente de aprobacion.";
					header("Location: login.php");
					exit();
				} 
				else if($row['aprobado'] == '0') {
					$_SESSION['msjLoginError'] = "Su cuenta fue rechazada. Para mayor informacion contactenos.";
					header("Location: login.php");
					exit();
				} 
				else if($row['aprobado'] == '1') {//SE PUEDE LOGUEAR NORMALMENTE

					//SI ES UNA EMPRESA USAMOS ESTA VARIABLE PARA SABER QUE SE ESTA COMO UNA EMPRESA Y MANEJAR LAS OPCIONES DEL MENU
					if($tipoUsuario=='empresa'){
						$_SESSION['nombre'] = $row['nombre'];
						$_SESSION['correo'] = $row['correo'];
						$_SESSION['id_usuario'] = $row['idEmpresa'];
						$_SESSION['empresaLogeada'] = true;
						header("Location: empresa/trabajos_publicados.php");
						exit();
					}
					//SI ES UN OFERENTE
					else{
						$_SESSION['nombre'] = $row['nombre'] . " " . $row['apellido'];
						$_SESSION['correo'] = $row['correo'];
						$_SESSION['id_usuario'] = $row['idOferente'];
						header("Location: ver_puestos.php");
						exit();
					}

				}
			}//fin de if de empresa y oferente
		}//fin de while
 	} else {
 		$_SESSION['msjLoginError'] = "Error. Usuario/Contrseña Incorrectos";
  		//$_SESSION['msjLoginError'] = "Error.".$sql;
 		header("Location: login.php");
		exit();
 	}

 	$conn->close();

} else {
	//redirect them back to login page
	header("Location: login.php");
	exit();
}