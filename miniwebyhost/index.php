<?php include("conexion.php"); ?>
<!DOCTYPE html>
<html>
<body>
  <h2>Todos los Alumnos</h2>
  <a href="agregar.php">Agregar Alumno</a> | 
  <a href="buscar.php">Buscar Alumno</a>
  <br><br>

  <?php
  $consulta = "SELECT * FROM alumnos";
  $resultado = mysqli_query($conexion, $consulta);

  while ($fila = mysqli_fetch_assoc($resultado)) {
    echo "<div style='background-color:" . $fila['color_fondo'] . "; padding:10px; margin:5px;'>";
    echo "<b>Código:</b> " . $fila['codigo'] . "<br>";
    echo "<b>Nombre:</b> " . $fila['nombre'] . " " . $fila['apellido_paterno'] . " " . $fila['apellido_materno'] . "<br>";
    echo "<b>Edad:</b> " . $fila['edad'] . "<br>";
    echo "<b>Carrera:</b> " . $fila['carrera'] . "<br>";
    echo "</div>";
  }
  ?>
</body>
</html>
