<?php
include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];
    $direccion = $_POST['direccion'];
    $rol = "cliente";

    $sql = "INSERT INTO usuarios (nombre, correo, contrasena, direccion, rol)
            VALUES ('$nombre', '$correo', '$contrasena', '$direccion', '$rol')";

    if (mysqli_query($conexion, $sql)) {
        echo "<p style='color: yellow; text-align:center;'>Registro exitoso. Ahora puedes <a href='index.php' style='color:white;'>iniciar sesión</a>.</p>";
    } else {
        echo "<p style='color: yellow; text-align:center;'>Error al registrar: " . mysqli_error($conexion) . "</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pokecards - Registro</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="login-container">

    <h2>Regístrate</h2>

    <form method="POST">

        <label>Nombre</label>
        <input type="text" name="nombre" required>

        <label>Correo Electrónico</label>
        <input type="email" name="correo" required>

        <label>Clave</label>
        <input type="password" name="contrasena" required>

        <label>Dirección</label>
        <input type="text" name="direccion">

        <input type="submit" value="REGISTRARSE">

    </form>

    <p style="color: yellow; margin-top: 20px;">
        ¿Ya tienes cuenta? <a href="index.php" style="color: white;">Inicia sesión aquí</a>
    </p>

</div>

</body>
</html>
