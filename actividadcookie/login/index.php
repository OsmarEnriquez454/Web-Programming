<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["invitado"])) {
        $_SESSION["login"] = "Invitado";
    } else {
        $_SESSION["login"] = $_POST["login"];
        $_SESSION["pass"] = $_POST["pass"];
    }
    header("Location: pagina.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <form method="POST">
        Usuario: <input type="text" name="login" required><br><br>
        Contraseña: <input type="password" name="pass" required><br><br>
        <button type="submit">Iniciar sesión</button>
    </form>
    <br>
    <form method="POST">
        <button type="submit" name="invitado">Entrar como invitado</button>
    </form>
</body>
</html>
