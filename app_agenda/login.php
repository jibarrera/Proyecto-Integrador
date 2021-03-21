<?php

  
  require 'database.php';

  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $records = $conn->prepare('SELECT id, email, password FROM users WHERE email = :email');
    $records->bindParam(':email', $_POST['email']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message = '';

    if (count($results) > 0 && password_verify($_POST['password'], $results['password'])) {
      $_SESSION['user_id'] = $results['id'];
      header("Location: /app_agenda/login.php");
    } else {
      $message = 'Sorry, estas credenciales no coinciden';
    }
  }

?>


<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title> Login de Usuarios</title>
  <link rel="stylesheet" href="style.css">

</head>

<body>
<!-- partial:index.partial.html -->
                

        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

            <!-- Google Fonts -->
           <link href="https://fonts.googleapis.com/css2?family=Big+Shoulders+Inline+Display&display=swap" rel="stylesheet">

            <!-- Estilos -->
            <link rel="stylesheet" href="style.css">

            

            <title>Login de Usuarios</title>
        </head>
        <body>


          <div class="container">

            <h2>Bienvenido a mi Agenda de Contactos</h2>
            <br>
            <div>
             <a class="btn" href="index.php">Volver a Página Principal</a>
             <a class="btn" href="login.php"> Iniciar Sesión</a>
             <a class="btn" href="signup.php"> Registrarse</a>
            </div>
           </div>

           <?php if(!empty($message)): ?>
             <p> <?= $message ?></p>
            <?php endif; ?>


           <!------------------ Formulario de Login de Usuarios-------------------------------->

            <div class="contenedor-formularios">
                <!-- Links de los formularios -->
                <ul class="contenedor-tabs">
                    <li class="tab tab-segunda active"><a href="#iniciar-sesion">Iniciar Sesión</a></li>
                </ul>

                <!-- Contenido de los Formularios -->
                <div class="contenido-tab">
                    <!-- Iniciar Sesion -->
                    <div id="iniciar-sesion">

                        <!--Logueo de Usuarios Registrados-->

                        <form action="app/index.php" method="post">
                            <div class="contenedor-input">
                                <label>
                                    Ingrese su email <span class="req">*</span>
                                </label>
                                <input type="text" required>
                            </div>

                            <div class="contenedor-input">
                                <label>
                                    Ingrese su contraseña <span class="req">*</span>
                                </label>
                                <input type="password" required>
                            </div>
                            <input type="submit" class="button button-block" value="Iniciar Sesión">
                        </form>

                    </div>
                </div>
            </div>
            <!------------------ Fin de Login de Usuarios--------------------------------------->

           <script src="js/jquery.js"></script>
           <script src="js/main.js"></script>
        </body>
        </html>

<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script><script  src="./script.js"></script>

</body>

</html>
