<?php
$servername = "sql313.byethost24.com";
$username = "b24_39693294";
$password = "kiridhar45"; // vacío si no tiene contraseña
$database = "b24_39693294_escuela";

$conexion = mysqli_connect($servername, $username, $password, $database);

if (!$conexion) {
  die("Error al conectar: " . mysqli_connect_error());
}
?>