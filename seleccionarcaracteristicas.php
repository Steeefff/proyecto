<?php
require_once("conexion.php");



	//Guardando la variable GET
	$idTipo = mysqli_real_escape_string($conn, $_GET['valor']);
	
	//Creando la consulta
	$sql = "SELECT caracteristicas.`idCaracteristica`,caracteristicas.`nombre` FROM caracteristicas WHERE `idTipoCaracteristica`='$idTipo'";

	$result = $conn->query($sql);
	$opciones="";
	//$opciones = "<option value=''>Seleccione una opción</option>"; // en esta variable se van a concatenar todas las caracteristicas del tipo seleccionado
	

	//Concatenando HTML para devolverlo a la petición y que esta la mande a la página
	while($row = $result->fetch_assoc()) 
	{
	    $opciones .= "<option value='".$row['idCaracteristica']."'>".$row['nombre']."</option>";

	}//cierre de while
	
	echo $opciones;//lo que se devuelve a la petición AJAX
		
?>