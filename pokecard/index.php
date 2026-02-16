<?php
include("conexion.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    $sql = "SELECT * FROM usuarios WHERE correo='$correo' AND contrasena='$contrasena'";
    $resultado = mysqli_query($conexion, $sql);

    if (mysqli_num_rows($resultado) == 1) {
        $usuario = mysqli_fetch_assoc($resultado);

        $_SESSION['id_usuario'] = $usuario['id_usuario'];
        $_SESSION['nombre'] = $usuario['nombre'];
        $_SESSION['rol'] = $usuario['rol'];

        if ($usuario['rol'] == 'admin') {
            header("Location: inicio_admin.php");
        } else {
            header("Location: inicio.php");
        }
        exit();
    } else {
        echo "<p style='color: yellow; text-align: center;'>Correo o contraseña incorrectos.</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pokecards - Iniciar Sesión</title>
    <link rel="stylesheet" href="styles.css"> 
</head>
<body>

<div class="login-container">

    <h2>Inicie sesión</h2>

    <form method="POST">

        <label>Correo Electrónico</label>
        <input type="email" name="correo" required>

        <label>Clave</label>
        <input type="password" name="contrasena" required>

        <input type="submit" value="INICIAR SESION">

    </form>

    <p style="color: yellow; margin-top: 20px;">
        ¿No tienes cuenta? <a href="registro.php" style="color: white;">Regístrate aquí</a>
    </p>

</div>

</body>
</html>
