<?php
session_start();
include("conexion.php");

// Solo admin
if (!isset($_SESSION['id_usuario']) || $_SESSION['rol'] != 'admin') {
    header("Location: index.php");
    exit;
}

// Obtener ID de carta
$id = $_GET['id'];

// Obtener datos actuales
$q = mysqli_query($conexion, "SELECT * FROM cartas WHERE id_carta=$id");
$carta = mysqli_fetch_assoc($q);

// Si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre = $_POST['nombre'];
    $tipo = $_POST['tipo'];
    $rareza = $_POST['rareza'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];

    // Imagen por defecto (la actual)
    $imagen_final = $carta['imagen'];

    // Si subió imagen nueva
    if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] == 0) {

        $ruta = "cartas/";

        if (!file_exists($ruta)) {
            mkdir($ruta, 0777, true);
        }

        $nuevo_nombre = time() . "_" . $_FILES["imagen"]["name"];
        $ruta_completa = $ruta . $nuevo_nombre;

        move_uploaded_file($_FILES["imagen"]["tmp_name"], $ruta_completa);

        if (file_exists($carta['imagen'])) {
            unlink($carta['imagen']);
        }

        $imagen_final = $ruta_completa;
    }

    $update = "
        UPDATE cartas SET
        nombre='$nombre',
        tipo='$tipo',
        rareza='$rareza',
        descripcion='$descripcion',
        precio='$precio',
        stock='$stock',
        imagen='$imagen_final'
        WHERE id_carta=$id
    ";

    mysqli_query($conexion, $update);

    header("Location: catalogo_admin.php");
    exit;
}
?>

<link rel="stylesheet" href="estilos.css">

<!-- BARRA SUPERIOR -->
<div class="usuario-barra">
    <span>Administrador: <?php echo $_SESSION['nombre']; ?></span> |
    <a href="logout.php">Cerrar sesión</a>
</div>

<!-- CAJA 1 -->
<div class="caja1">
    <h2>PokeCards - Editar Carta</h2>
</div>

<!-- CAJA 2 -->
<div class="caja2">
    <a href="inicio_admin.php">Inicio Admin</a> |
    <a href="catalogo_admin.php">Catálogo Admin</a> 
</div>

<!-- FILA -->
<div class="fila-medio">

    <!-- CAJA 3 -->
    <div class="caja3">
        <b>Menú Admin</b><br><br>
        <a href="inicio_admin.php">Inicio</a><br>
        <a href="catalogo_admin.php">Catálogo</a><br>
        <a href="logout.php">Cerrar sesión</a><br>
    </div>

    <!-- CAJA 4 (FORMULARIO) -->
    <div class="caja4">

        <h2>Editar Carta</h2>

        <p><b>Imagen actual:</b></p>
        <img src="<?php echo $carta['imagen']; ?>" 
             style="width:35%; border:3px solid #FFCC00; border-radius:8px; margin-bottom:15px;"><br><br>

        <form method="POST" enctype="multipart/form-data"
              style="background:#F5F5F5; padding:15px; border-radius:10px; border:2px solid #1E90FF;">

            <label><b>Nombre:</b></label><br>
            <input type="text" name="nombre" value="<?php echo $carta['nombre']; ?>" 
                   style="width:100%; padding:5px; margin-bottom:10px;"><br>

            <label><b>Tipo:</b></label><br>
            <input type="text" name="tipo" value="<?php echo $carta['tipo']; ?>" 
                   style="width:100%; padding:5px; margin-bottom:10px;"><br>

            <label><b>Rareza:</b></label><br>
            <input type="text" name="rareza" value="<?php echo $carta['rareza']; ?>" 
                   style="width:100%; padding:5px; margin-bottom:10px;"><br>

            <label><b>Descripción:</b></label><br>
            <input type="text" name="descripcion" value="<?php echo $carta['descripcion']; ?>" 
                   style="width:100%; padding:5px; margin-bottom:10px;"><br>

            <label><b>Precio:</b></label><br>
            <input type="number" name="precio" step="0.01" value="<?php echo $carta['precio']; ?>" 
                   style="width:100%; padding:5px; margin-bottom:10px;"><br>

            <label><b>Stock:</b></label><br>
            <input type="number" name="stock" value="<?php echo $carta['stock']; ?>" 
                   style="width:100%; padding:5px; margin-bottom:10px;"><br>

            <label><b>Nueva imagen (opcional):</b></label><br>
            <input type="file" name="imagen" style="margin-bottom:15px;"><br>

            <input type="submit" value="Guardar cambios"
                   style="background:#003399; color:white; padding:10px 20px;
                          border:2px solid yellow; border-radius:8px; cursor:pointer;">
        </form>

        <br>
        <a href="catalogo_admin.php"
           style="color:#003399; font-weight:bold;">← Volver</a>

    </div>

    <!-- CAJA 5 -->
    <div class="caja5">
        <h3>Información</h3>
        <p>Solo puedes editar el texto de bienvenida y la imagen de portada. Asi mismo en el apartado de catalogo  puedes agregar, editar y eliminar cartas con cambios hacia el usuario y a la base de datos</p>
    </div>


</div>

<!-- FOOTER -->
<div class="footer">
    <span>PokeCards © 2025</span>
    <span>Panel Admin</span>
</div>
