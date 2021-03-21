<?php
	session_start();
	include_once('dbconect.php');

	if(isset($_POST['editar'])){
		$database = new Connection();
		$db = $database->open();
		try{
			$id = $_GET['id'];
			$nombre = $_POST['nombre'];
			$apellido = $_POST['apellido'];
			$telefono = $_POST['telefono'];
			$email = $_POST['email'];
			$direccion = $_POST['direccion'];
			$fechaNac = $_POST['fechaNac'];


			$sql = "UPDATE empleados SET Nombre = '$nombre', Apellido = '$apellido', Telefono = '$telefono', Email = '$email', Direccion = '$direccion', fechaNac = '$fechaNac' WHERE idEMp = '$id'";
			//if-else statement in executing our query
			$_SESSION['message'] = ( $db->exec($sql) ) ? 'Empleado actualizado correctamente' : 'No se pudo actualizar el contacto';

		}
		catch(PDOException $e){
			$_SESSION['message'] = $e->getMessage();
		}

		//Cerrar la conexión
		$database->close();
	}
	else{
		$_SESSION['message'] = 'Complete el formulario de Editar Contacto';
	}

	header('location: index.php');

?>