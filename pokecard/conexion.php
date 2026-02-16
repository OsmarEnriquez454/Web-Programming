<?php
$servername = "sql313.byethost24.com";   // MySQL hostname
$username   = "b24_39693294";            // MySQL username
$password   = "kiridhar45";       // MySQL password
$database   = "b24_39693294_pokecardsdb";// Nombre completo de tu base

$conexion = mysqli_connect($servername, $username, $password, $database);

if (!$conexion) {
    die("Error al conectar con la base de datos");
}
?>
