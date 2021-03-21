<!---------- *Conexión a la Base de Datos* ------------------------------------->
<?php

$server = 'localhost';
$username = 'areasist_33420896';
$password = 'U$tQ$Ztl*)E@';
$database = 'areasist_33420896';

try {
  $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
} catch (PDOException $e) {
  die('Connection Failed: ' . $e->getMessage());
}

?>