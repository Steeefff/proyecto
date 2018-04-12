<?php
session_start();
require_once("../conexion.php");

//If user clicked register button
if(isset($_POST)) {

	$sql = "SELECT * FROM puesto_trabajo WHERE id_puesto='$_GET[id]'";
	  $result = $conn->query($sql);
	  if($result->num_rows > 0) 
	  {
	    	$row = $result->fetch_assoc();
	    	$id_empresa = $row['id_empresa'];
	   }

	$sql1 = "SELECT * FROM aplicar_trabajo WHERE id_usuario='$_SESSION[id_usuario]' AND id_puesto='$row[id_puesto]'";
    $result1 = $conn->query($sql1);
    if($result1->num_rows == 0) {  
    	
    	$sql = "INSERT INTO aplicar_trabajo(id_puesto, id_empresa, id_usuario) VALUES ('$_GET[id]', '$id_empresa', '$_SESSION[id_usuario]')";

		if($conn->query($sql)===TRUE) {
			$_SESSION['jobApplySuccess'] = true;
			header("Location: ver_puestos.php");
			exit();
		} else {
			echo "Error " . $sql . "<br>" . $conn->error;
		}

		$conn->close();

    }  else {
		header("Location: ver_puestos.php");
		exit();
	}
	

} else {
	header("Location: ver_puestos.php");
	exit();
}