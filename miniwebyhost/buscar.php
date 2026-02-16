<?php include("conexion.php"); ?>
<!DOCTYPE html>
<html>
<body>
  <h2>Búsqueda de Alumnos</h2>
  <a href="index.php">Ver todos</a> |
  <a href="agregar.php">Agregar Alumno</a>
  <br><br>

  <form method="post">
    Buscar por código: <input type="text" name="codigo">
    <input type="submit" name="buscar_codigo" value="Buscar"><br><br>

    Buscar por apellido paterno: <input type="text" name="apellido">
    <input type="submit" name="buscar_apellido" value="Buscar"><br><br>

    Buscar por carrera: <input type="text" name="carrera">
    <input type="submit" name="buscar_carrera" value="Buscar"><br><br>

    Buscar por edad y carrera:<br>
    Edad: <input type="number" name="edad"><br>
    Carrera: <input type="text" name="carrera2">
    <input type="submit" name="buscar_edad_carrera" value="Buscar">
  </form>

  <hr>

  <?php
  if (isset($_POST['buscar_codigo'])) {
    $codigo = $_POST['codigo'];
    $sql = "SELECT * FROM alumnos WHERE codigo='$codigo'";
  } elseif (isset($_POST['buscar_apellido'])) {
    $apellido = $_POST['apellido'];
    $sql = "SELECT * FROM alumnos WHERE apellido_paterno LIKE '%$apellido%'";
  } elseif (isset($_POST['buscar_carrera'])) {
    $carrera = $_POST['carrera'];
    $sql = "SELECT * FROM alumnos WHERE carrera='$carrera'";
  } elseif (isset($_POST['buscar_edad_carrera'])) {
    $edad = $_POST['edad'];
    $carrera2 = $_POST['carrera2'];
    $sql = "SELECT * FROM alumnos WHERE edad='$edad' AND carrera='$carrera2'";
  }

  if (isset($sql)) {
    $resultado = mysqli_query($conexion, $sql);
    while ($fila = mysqli_fetch_assoc($resultado)) {
      echo "<div style='background-color:" . $fila['color_fondo'] . "; padding:10px; margin:5px;'>";
      echo "<b>Código:</b> " . $fila['codigo'] . "<br>";
      echo "<b>Nombre:</b> " . $fila['nombre'] . " " . $fila['apellido_paterno'] . " " . $fila['apellido_materno'] . "<br>";
      echo "<b>Edad:</b> " . $fila['edad'] . "<br>";
      echo "<b>Carrera:</b> " . $fila['carrera'] . "<br>";
      echo "</div>";
    }
  }
  ?>
</body>
</html>
