<?php
session_start();
include("conexion.php");

// Verificar admin
if (!isset($_SESSION['id_usuario']) || $_SESSION['rol'] != 'admin') {
    header("Location: index.php");
    exit;
}

// Eliminar carta
if (isset($_GET['eliminar'])) {
    $id = $_GET['eliminar'];

    $q = mysqli_query($conexion, "SELECT imagen FROM cartas WHERE id_carta=$id");
    $img = mysqli_fetch_assoc($q);

    if ($img && file_exists($img['imagen'])) {
        unlink($img['imagen']);
    }

    mysqli_query($conexion, "DELETE FROM cartas WHERE id_carta=$id");
    echo "<p>✔ Carta eliminada.</p>";
}

// Obtener cartas
$cartas = mysqli_query($conexion, "SELECT * FROM cartas");
?>

<link rel="stylesheet" href="estilos.css">

<!-- BARRA SUPERIOR -->
<div class="usuario-barra">
    <span>Bienvenido: <?php echo $_SESSION['nombre']; ?></span> |
    <a href="logout.php">Cerrar sesión</a>
</div>

<!-- BARRA PRINCIPAL -->
<div class="caja1">
    <h2>PokeCards - Catalogo Administrador</h2>
</div>

<!-- MENÚ SUPERIOR -->
<div class="caja2">
    <a href="inicio_admin.php">Inicio admin</a>
</div>

<!-- CUERPO CENTRAL -->
<div class="fila-medio">

    <!-- MENÚ IZQUIERDO -->
    <div class="caja3">
        <b>Menú Admin</b><br><br>
        <a href="inicio_admin.php">Inicio</a><br>
        <a href="logout.php">Cerrar sesión</a><br>
    </div>

    <!-- CONTENIDO PRINCIPAL -->
    <div class="caja4">

        <h2>Administración del catálogo</h2>
        <a href="crear_carta.php" class="btn-azul">➕ Agregar nueva carta</a>

        <br><br>

        <table border="1" cellpadding="5" style="width:100%; background:white; border-collapse:collapse;">
            <tr style="background:#003399; color:white;">
                <th>ID</th>
                <th>Nombre</th>
                <th>Tipo</th>
                <th>Rareza</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>

            <?php while ($c = mysqli_fetch_assoc($cartas)) { ?>
            <tr>
                <td><?php echo $c['id_carta']; ?></td>
                <td><?php echo $c['nombre']; ?></td>
                <td><?php echo $c['tipo']; ?></td>
                <td><?php echo $c['rareza']; ?></td>
                <td>$<?php echo $c['precio']; ?></td>
                <td><?php echo $c['stock']; ?></td>

                <td>
                    <img src="<?php echo $c['imagen']; ?>" style="width:17%; height:17%; border:2px solid #FFCC00; border-radius:5px;">

                </td>

                <td>
                    <a href="editar_carta.php?id=<?php echo $c['id_carta']; ?>">Editar</a> |
                    <a href="catalogo_admin.php?eliminar=<?php echo $c['id_carta']; ?>" onclick="return confirm('¿Eliminar carta?')">Eliminar</a>
                </td>
            </tr>
            <?php } ?>

        </table>

    </div>

    <!-- DERECHA -->
    <div class="caja5">
        <h3>Información</h3>
        <p>Solo puedes editar el texto de bienvenida y la imagen de portada. Asi mismo en el apartado de catalogo  puedes agregar, editar y eliminar cartas con cambios hacia el usuario y a la base de datos</p>
    </div>

</div>

<!-- FOOTER -->
<div class="footer">
    <span>PokeCards © 2025</span>
    <span>Panel Administrador</span>
</div>
