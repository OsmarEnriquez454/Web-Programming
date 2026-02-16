<!DOCTYPE html>
<html>
<body>
  <h2>Configuración inicial del sistema</h2>
  <form method="post">
    <label>Usuario MySQL:</label><br>
    <input type="text" name="usuario" placeholder="root" required><br><br>

    <label>Contraseña MySQL:</label><br>
    <input type="password" name="contrasena" placeholder="(deje vacío si no tiene)" ><br><br>

    <input type="submit" name="instalar" value="Crear Base de Datos y Tabla">
  </form>

  <?php
  if (isset($_POST['instalar'])) {
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    // Conexión al servidor MySQL
    $conexion = mysqli_connect("localhost", $usuario, $contrasena);

    if (!$conexion) {
      die("Error al conectar con MySQL revise usuario o contraseña");
    }

    // Crear base de datos
    $sql_db = "CREATE DATABASE IF NOT EXISTS escuela";
    if (mysqli_query($conexion, $sql_db)) {
      echo "<p>Base de datos 'escuela' lista.</p>";
    } else {
      die("Error al crear la base: ".mysqli_error($conexion));
    }

    // Seleccionar base
    mysqli_select_db($conexion, "escuela");

    // Crear tabla alumnos
    $sql_tabla = "CREATE TABLE IF NOT EXISTS alumnos (
      codigo INT AUTO_INCREMENT PRIMARY KEY,
      nombre VARCHAR(50),
      apellido_paterno VARCHAR(50),
      apellido_materno VARCHAR(50),
      edad INT,
      carrera VARCHAR(50),
      color_fondo VARCHAR(20),
      usuario VARCHAR(50),
      contrasena VARCHAR(50)
    )";

    if (mysqli_query($conexion, $sql_tabla)) {
      echo "<p>Tabla 'alumnos' lista.</p>";
      echo "<p style='color:green;'>Instalación completa. Ya puede usar el sistema.</p>";
      echo "<a href=agregar.php>Ir a crear alumno";
    } else {
      echo "<p style='color:red;'>Error al crear la tabla: " . mysqli_error($conexion) . "</p>";
    }

    mysqli_close($conexion);
  }
  ?>

</body>
</html>
