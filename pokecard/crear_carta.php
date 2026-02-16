<?php
session_start();
include("conexion.php");

// Verificar admin
if (!isset($_SESSION['id_usuario']) || $_SESSION['rol'] != 'admin') {
    header("Location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre = $_POST['nombre'];
    $tipo = $_POST['tipo'];
    $rareza = $_POST['rareza'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];

    // Subir imagen
    $imagen = "";
    if (!empty($_FILES["imagen"]["name"])) {
        $folder = "cartas/";
        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }
        $imagen = $folder . basename($_FILES["imagen"]["name"]);
        move_uploaded_file($_FILES["imagen"]["tmp_name"], $imagen);
    }

    mysqli_query($conexion, 
        "INSERT INTO cartas (nombre, tipo, rareza, descripcion, precio, stock, imagen)
        VALUES ('$nombre', '$tipo', '$rareza', '$descripcion', '$precio', '$stock', '$imagen')"
    );

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
    <h2>PokeCards - Administrador</h2>
</div>

<!-- CAJA 2 -->
<div class="caja2">
    <a href="inicio_admin.php">Inicio Admin</a> |
    <a href="catalogo_admin.php">Catálogo Admin</a> |
</div>

<!-- FILA PRINCIPAL -->
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

        <h2>Crear nueva carta</h2>

        <form method="POST" enctype="multipart/form-data"
              style="background:#F5F5F5; padding:15px; border-radius:10px; border:2px solid #1E90FF;">

            <label><b>Nombre:</b></label><br>
            <input type="text" name="nombre" required
                   style="width:100%; padding:5px; margin-bottom:10px;"><br>

            <label><b>Tipo:</b></label><br>
            <input type="text" name="tipo" required
                   style="width:100%; padding:5px; margin-bottom:10px;"><br>

            <label><b>Rareza:</b></label><br>
            <input type="text" name="rareza" required
                   style="width:100%; padding:5px; margin-bottom:10px;"><br>

            <label><b>Descripción:</b></label><br>
            <input type="text" name="descripcion" required
                   style="width:100%; padding:5px; margin-bottom:10px;"><br>

            <label><b>Precio:</b></label><br>
            <input type="number" step="0.01" name="precio" required
                   style="width:100%; padding:5px; margin-bottom:10px;"><br>

            <label><b>Stock:</b></label><br>
            <input type="number" name="stock" required
                   style="width:100%; padding:5px; margin-bottom:10px;"><br>

            <label><b>Imagen:</b></label><br>
            <input type="file" name="imagen" required
                   style="margin-bottom:15px;"><br>

            <input type="submit" value="Crear Carta"
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
