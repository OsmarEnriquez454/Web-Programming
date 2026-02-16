<?php
include("conexion.php");
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
}

$usuario = $_SESSION['usuario'];
$consulta = "SELECT * FROM alumnos WHERE usuario='$usuario'";
$resultado = mysqli_query($conexion, $consulta);
$alumno = mysqli_fetch_assoc($resultado);

$color = $alumno['color_fondo'];
?>
<body style="background-color:<?php echo $color; ?>;">
<h2>Bienvenido <?php echo $alumno['nombre']; ?></h2>
<img src="<?php echo $alumno['foto']; ?>" width="150"><br>

<p><b>Código:</b> <?php echo $alumno['codigo']; ?></p>
<p><b>Edad:</b> <?php echo $alumno['edad']; ?></p>
<p><b>Carrera:</b> <?php echo $alumno['carrera']; ?></p>

<h2>Materias inscritas:</h2>
<ul>
<?php
for ($i = 1; $i <= 3; $i++) {
    $mat = $alumno["mat$i"];
    $materia = mysqli_query($conexion, "SELECT * FROM materias WHERE nrc='$mat'");
    if ($m = mysqli_fetch_assoc($materia)) {
        // Obtener profesor
        $profesor_id = $m['profesor_asignado'];
        $prof = mysqli_query($conexion, "SELECT nombre, apellido_pat FROM profesores WHERE codigo='$profesor_id'");
        $p = mysqli_fetch_assoc($prof);

        echo "<li>{$m['nombre_materia']} - {$m['dia']} - {$m['horario']} 
        <br><b>Profesor:</b> {$p['nombre']} {$p['apellido_pat']}</li><br>";
    }
}
?>
</ul>

<p><a href="logout.php">Cerrar sesión</a></p>
</body>
