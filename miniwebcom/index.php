
<?php
include("conexion.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    $sql = "SELECT * FROM alumnos WHERE usuario='$usuario' AND contrasena='$contrasena'";
    $result = mysqli_query($conexion, $sql);

    if (mysqli_num_rows($result) == 1) {
        $alumno = mysqli_fetch_assoc($result);
        $_SESSION['usuario'] = $alumno['usuario'];
        $_SESSION['color'] = $alumno['color_fondo'];
        header("Location: perfil.php");
        exit;
    } else {
        echo "<p>Usuario o contraseña incorrectos.</p>";
    }
}
?>

<h2>Iniciar sesión</h2>
<form method="POST">
    Usuario: <input type="text" name="usuario" required><br>
    Contraseña: <input type="password" name="contrasena" required><br>
    <input type="submit" value="Entrar">
</form>
<p><a href="registro.php">¿No tienes cuenta? Regístrate aquí</a></p>
