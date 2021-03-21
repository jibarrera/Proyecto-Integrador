<?php

          require 'database.php';

          $message = '';
          
          if (!empty($_POST['email']) && !empty($_POST['password'])) {
            $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':email', $_POST['email']);
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $stmt->bindParam(':password', $password);

            if ($stmt->execute()) {
              $message = 'Usuario creado Exitosamente';
              
            echo "<script>
                alert('Usuario creado');
                window.location= 'signup.php'
            </script>";

            
            } else {
              $message = 'Hubo un error al crear su cuenta.';
              echo "<script>
                alert('Usuario No Creado');
                window.location= 'signup.php'
    </script>";
            }
          }
?>

 <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

            <!-- Google Fonts --> 
             <link href="https://fonts.googleapis.com/css2?family=Big+Shoulders+Inline+Display&display=swap" rel="stylesheet">

            <!-- Estilos -->
            <link rel="stylesheet" href="style.css">

            <title> Registro de Usuarios</title>
        </head>
        <body>

            

            <div class="container">

                <h2>Bienvenido a mi Agenda de Contactos</h2>
                <br>
                <div>
                    <a class="btn" href="index.php">Volver al Sitio Principal</a>
                    <a class="btn" href="login.php" > Iniciar Sesión</a>
                    <a class="btn" href="signup.php"> Registrarse</a>
                </div>
           </div>

           <?php if(!empty($message)): ?>
                <p>

                    <?= $message ?> </p>
            <?php endif; ?>

           <!--------------------Formulario de Registración de Usuarios------------------------->
           
            <div class="contenedor-formularios">
                <!-- Links de los formularios -->
                <ul class="contenedor-tabs">
                    <li class="tab tab-primera"><a href="#registrarse">Registrarse</a></li>
                </ul>

                <!-- Contenido de los Formularios -->
                <div class="contenido-tab">

                    <!-- Registrarse -->
                    <div id="registrarse">

                        <!--<h1>Registrarse</h1>-->
            
                        <form action="signup.php" method="post">
                            <div class="fila-arriba">
                                <div class="contenedor-input">
                                    <label>
                                        Nombre <span class="req">*</span>
                                    </label>
                                    <input type="text" name="nombre" required >
                                </div>

                                <div class="contenedor-input">
                                    <label>
                                        Apellido <span class="req">*</span>
                                    </label>
                                    <input type="text" name="apellido" required>
                                </div>
                            </div>
                            <div class="contenedor-input">
                                    <label>
                                        Email <span class="req">*</span>
                                    </label>
                                <input type="email" name="email"required>
                            </div>
                            <div class="contenedor-input">
                                <label>
                                    Contraseña <span class="req">*</span>
                                </label>
                                <input type="password" name="password" required>
                            </div>

                            <input type="submit" class="button button-block" value="Registrarse">
                        </form>
                    </div>
                </div>
            </div>
            <!--------------------------Fin de Registración de Usuarios------------------------->

           <script src="js/jquery.js"></script>
           <script src="js/main.js"></script>
        </body>
        </html>

<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script><script  src="./script.js"></script>