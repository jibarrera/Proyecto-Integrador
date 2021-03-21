
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>App Contactos</title>
	<link href="https://fonts.googleapis.com/css2?family=Big+Shoulders+Inline+Display&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">

	<style>
		
		body{
			background: url(img/responsive.jpg) #CCC no-repeat;
			background-size: cover;
			background-position: center center;
			background-attachment: fixed;
			font-family: 'Big Shoulders Inline Display';
			font-size: 17px;
		}
	</style>
</head>
<body>

<!--------------------     Barra de Navegación  ----------------------------------------------->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid"> 
   
    <div class="navbar-header">
      <button type="button" style="font-size: 18px; padding: 20px;font-family: 'Big Shoulders Inline Display', cursive;" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      <a class="navbar-brand" href="http://127.0.0.1/app_agenda/index.php">Home</a> </div>


    
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <button type="button" class="btn" id="x" style="font-size: 15px; padding: 20px;font-family: 'Big Shoulders Inline Display', cursive;" onclick="accion();">Cerrar Sesión</button>
		<script type="text/javascript">
		    function accion()
		    {
		        $.ajax({
		            type:'POST', 
		            url: 'function.php',
		            success:function(response){
		              window.location.href='http://127.0.0.1/app_agenda/index.php';  
		           }
		         });
		    }
		    
		</script>
      </ul>
    </div>

    </div>
    <!-- /.navbar-collapse --> 
  </div>
  <!-- /.container-fluid --> 
</nav>
<!--------------------------------------*Fin de Barra de Navegación*---------------------------->


<!--------------------------------------  *Inicio de Contenedor* ------------------------------->
<div class="container">
	<h1 class="page-header text-center" style="margin-top:-50px; color: blue;">Bienvenido a mi App de Contactos</h1>
	<div class="row">
		<div class="col-sm-8 col-sm-offset-2">
			<a href="#addnew" class="btn btn-info" style="color:white;" data-toggle="modal"><span class="glyphicon glyphicon-plus"></span> Agregar nuevo contacto</a>
<?php 
	//session_start();
	if(isset($_SESSION['message'])){
		?>
		<div class="alert alert-info text-center" style="margin-top:20px;">
			<?php echo $_SESSION['message']; ?>
		</div>
		<?php

		unset($_SESSION['message']);
	}
?>

<!----------------------Inicio de Tabla de Contactos------------------------------------------->

<table class="table table-dark table-striped" style="margin-top:20px; width: 100%; border: 1px solid white;">
	<thead style="background-color: #EDEDCB; color: blue; width: 100%; text-align: center; border: 1px solid white;">
		<th>ID</th>
		<th>Nombre</th>
		<th>Apellido</th>
		<th>Telefono</th>
		<th>Email</th>
		<th>Dirección</th>
		<th>Fecha de Nacimiento</th>
		<th>Acciones</th>
	</thead>
	<tbody style="text-align: left; color: black;">
		<?php
			//incluimos el fichero de conexion
			include_once('dbconect.php');

			$database = new Connection();
			$db = $database->open();
			try{	
				$sql = 'SELECT * FROM empleados order by Apellido ASC';
				foreach ($db->query($sql) as $row) {

					?>
					<tr>
						<td><?php echo $row['idEmp']; ?></td>
						<td><?php echo $row['Nombre']; ?></td>
						<td><?php echo $row['Apellido']; ?></td>
						<td><?php echo $row['Telefono']; ?></td>
						<td><?php echo $row['Email']; ?></td>
						<td><?php echo $row['Direccion']; ?></td>
						<td><?php echo $row['fechaNac']; ?></td>
						<td>
							<a href="#edit_<?php echo $row['idEmp']; ?>" class="btn btn-success btn-sm" data-toggle="modal"><span class="glyphicon glyphicon-edit"></span> Editar</a>
							<br>
							<br>
							<a href="#delete_<?php echo $row['idEmp']; ?>" class="btn btn-danger btn-sm" data-toggle="modal"><span class="glyphicon glyphicon-trash"></span> Borrar</a>
						</td>
						<?php include('BorrarEditarModal.php'); ?>
					</tr>
					<?php 
				}
			}
			catch(PDOException $e){
				echo "Hubo un problema en la conexión: " . $e->getMessage();
			}

			//Cerrar la Conexion
			$database->close();

		?>
				</tbody>
			</table>
<!-----------------------------------*Fin de Tabla Contactos* ---------------------------------->
		</div>
	</div>
</div>
<!--------------------------------------*Inicio de Contenedor* ------------------------------->
<?php include('AgregarModal.php'); ?>
<script src="js/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>