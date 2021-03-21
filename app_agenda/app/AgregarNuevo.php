<?php
session_start();
include_once('dbconect.php');

if(isset($_POST['agregar'])){
	$database = new Connection();
	$db = $database->open();
	try{
		//hacer uso de una declaración preparada para prevenir la inyección de sql
		$stmt = $db->prepare("INSERT INTO empleados (Nombre, Apellido, Telefono, Email, Direccion, fechaNac) VALUES (:nombre, :apellido, :telefono, :email, :direccion, :fechaNac)");
		//instrucción if-else en la ejecución de nuestra declaración preparada
		$_SESSION['message'] = ( $stmt->execute(array(':nombre' => $_POST['nombre'] , ':apellido' => $_POST['apellido'] , ':telefono' => $_POST['telefono'], ':email' => $_POST['email'], ':direccion' => $_POST['direccion'], ':fechaNac' => $_POST['fechaNac'])) )? 'Contacto guardado correctamente' : 'Algo salió mal. No se puede agregar el contacto';	
	
	}
	catch(PDOException $e){
		$_SESSION['message'] = $e->getMessage();
	}

	//cerrar la conexion
	$database->close();
}

else{
	$_SESSION['message'] = 'Llene el formulario';
}

header('location: index.php');
	
?>