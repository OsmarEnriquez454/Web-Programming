<?php
session_start();
include("conexion.php");

// Verificar que sea admin
if (!isset($_SESSION['id_usuario']) || $_SESSION['rol'] != 'admin'){
    header("Location: index.php");
    exit;
}

// Obtener el texto actual
$consulta = "SELECT bienvenida, imagen FROM configuracion WHERE id = 1";
$resultado = mysqli_query($conexion, $consulta);
$config = mysqli_fetch_assoc($resultado);

// Si se envió formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Actualizar texto
    $nuevo_texto = mysqli_real_escape_string($conexion, $_POST['bienvenida']);
    $updateTexto = "UPDATE configuracion SET bienvenida='$nuevo_texto' WHERE id = 1";
    mysqli_query($conexion, $updateTexto);

    // Subir imagen si el admin sube una
    if (isset($_FILES["portada"]) && $_FILES["portada"]["error"] == 0) {
        $carpeta = "portada/";
        if (!file_exists($carpeta)) {
            mkdir($carpeta, 0777, true);
        }
        $nombreImagen = "portada_" . time() . "_" . basename($_FILES["portada"]["name"]);
        $rutaFinal = $carpeta . $nombreImagen;
        move_uploaded_file($_FILES["portada"]["tmp_name"], $rutaFinal);

        // Guardar en BD
        $updateImg = "UPDATE configuracion SET imagen='$rutaFinal' WHERE id = 1";
        mysqli_query($conexion, $updateImg);
    }
    echo "<p style='color: yellow; font-weight: bold;'>Datos actualizados correctamente.</p>";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Panel Admin - PokeCards</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

<!-- BARRA SUPERIOR -->
<div class="usuario-barra">
    <span>Bienvenido: <?php echo $_SESSION['nombre']; ?></span> |
    <a href="logout.php">Cerrar sesión</a>
</div>

<!-- BARRA PRINCIPAL -->
<div class="caja1">
    <h2>PokeCards - Inicio Administrador</h2>
</div>

<!-- Menú -->
<div class="caja2">
    <a href="catalogo_admin.php">Catálogo</a> 
</div>

<!-- Contenedor principal -->
<div class="fila-medio">

    <!-- Caja lateral izquierda -->
    <div class="caja3">
        <h3>Opciones</h3>
        <p>- Editar bienvenida</p>
        <p>- Cambiar portada</p>
        <p>- Administrar catálogo</p>
    </div>

    <!-- Caja central -->
    <div class="caja4">
        <h2>Configuración del Inicio</h2>

        <form method="POST" enctype="multipart/form-data">

            <h3>Texto de bienvenida</h3>
            <textarea name="bienvenida" rows="6" cols="60" required><?php echo $config['bienvenida']; ?></textarea>
            <br><br>

            <h3>Imagen de portada</h3>
            <input type="file" name="portada" accept="image/*">
            <br><br>

            <?php if (!empty($config['imagen'])) { ?>
                <img src="<?php echo $config['imagen']; ?>" style="width: 100%; max-width: 350px; border: 3px solid yellow; border-radius: 10px;">
                <br><br>
            <?php } ?>

            <input type="submit" value="Guardar Cambios">
        </form>

    </div>

    <!-- Caja derecha -->
    <div class="caja5">
        <h3>Información</h3>
        <p>Solo puedes editar el texto de bienvenida y la imagen de portada. Asi mismo en el apartado de catalogo  puedes agregar, editar y eliminar cartas con cambios hacia el usuario y a la base de datos</p>
    </div>

</div>

<!-- Footer -->
<div class="footer">
    <div>PokeCards © 2024</div>
    <div>Panel de administración</div>
</div>
</body>
</html>
