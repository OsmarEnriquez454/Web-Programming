<!DOCTYPE html>
<html>
<body>
  <h2>Agregar Alumno</h2>
  <a href="index.php">Ver todos</a> | 
  <a href="buscar.php">Buscar Alumno</a>
  <br><br>

  <!-- Agregar alumno -->
  <form action="" method="post">

    Nombre: <input type="text" name="nombre" required><br>
    Apellido Paterno: <input type="text" name="apellido_paterno" required><br>
    Apellido Materno: <input type="text" name="apellido_materno" required><br>
    Edad: <input type="number" name="edad" required><br>
    Carrera: <input type="text" name="carrera" required><br>
    Color de fondo: <input type="text" name="color_fondo" placeholder="ej. lightblue"><br>
    Usuario: <input type="text" name="usuario" required><br>
    Contraseña: <input type="password" name="contrasena" required><br><br>
    <input type="submit" name="guardar" value="Guardar">
  </form>

  <!-- Guardarlo en la base de datos -->
  <?php
  include("conexion.php");

  if (isset($_POST['guardar'])) {
    $nombre = $_POST['nombre'];
    $ap = $_POST['apellido_paterno'];
    $am = $_POST['apellido_materno'];
    $edad = $_POST['edad'];
    $carrera = $_POST['carrera'];
    $color = $_POST['color_fondo'];
    $usuario = $_POST['usuario'];
    $pass = $_POST['contrasena'];

    $guardar = "INSERT INTO alumnos 
    (nombre, apellido_paterno, apellido_materno, edad, carrera, color_fondo, usuario, contrasena) 
    VALUES ('$nombre','$ap','$am','$edad','$carrera','$color','$usuario','$pass')";
    
    mysqli_query($conexion, $guardar);

    echo "<p>Alumno guardado correctamente.</p>";
  }
  ?>
</body>
</html>
