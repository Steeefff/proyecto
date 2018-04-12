<?php
session_start();
require_once("conexion.php");

//Si el usuario presiona el boton de Registrar

if(isset($_POST)){
	

	//------------------------------------SUBIR CURRICULUM A CARPETA: archivos/ -------------------------------

	$target_dir = "archivos/";//directorio donde se guardaran los curriculums
	$nombreCurriculum= $_POST['idOferente']."-". basename($_FILES["archivo"]["name"]);//nombre del curriculum concatenado al ID del oferente
	$target_file = $target_dir .$nombreCurriculum;// especifica la ruta y nombre del archivo para ser subido
	$uploadOk = 1; //bandera para saber si se subio bien o no
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	
	// Check file size
	/*if ($_FILES["fileToUpload"]["size"] > 500000) {
	    echo "Sorry, your file is too large.";
	    $uploadOk = 0;
	}*/

	// Allow certain file formats
	if($imageFileType != "pdf") {
	    echo "Lo siento, solo archivos pdf permitidos. <br></br>";
	    $uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
	    echo "Lo siento, su curriculum no pudo ser subido.";
	// if everything is ok, try to upload file
	} else {
	    if (move_uploaded_file($_FILES["archivo"]["tmp_name"], $target_file )) {//este metodo dentro del if es el que mueve el archivo a la carpeta archivos
	        echo "El curriculum ". basename( $_FILES["archivo"]["name"]). " ha sido agregado.";
	        $uploadOk=1; // se ingresó correctamente el curriculum a la carpeta archivos
	    } else {//no se movio el curriculum
	        echo "Lo siento, ah ocurrido un error al subir el archivo.";
	    }
	}
	
	//------------------------------------------------FIN DE SUBIR CURRICULUM------------------------------------------

	if($uploadOk==1){

		$id = mysqli_real_escape_string($conn, $_POST['idOferente']);
		$nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
		$apellido = mysqli_real_escape_string($conn, $_POST['apellido']);
		$correo = mysqli_real_escape_string($conn, $_POST['correo']);
		$nacionalidad = mysqli_real_escape_string($conn, $_POST['nacionalidad']);
		$telefono = mysqli_real_escape_string($conn, $_POST['telefono']);
		$residencia = mysqli_real_escape_string($conn, $_POST['residencia']);

		$sql = "SELECT correo FROM oferentes WHERE correo='$correo' "; //verificamos que NO exista el correo para que no se repita 
		$result = $conn->query($sql);

		if($result->num_rows == 0) {
		
			$sql = "INSERT INTO oferentes(idOferente,nombre, apellido, correo, nacionalidad,telefono,residencia,aprobado,curriculum) VALUES ('$id','$nombre','$apellido','$correo','$nacionalidad','$telefono','$residencia',2,'$nombreCurriculum')";//2 porque es pendiente
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
	} //fin del if del UploadOk

	else{
		$_SESSION['errorCurriculum'] = true;
		header("Location: registro.php");
		exit();
	}
}//fin del if del POST
else{
	header("Location: registro.php");
	exit();

}
