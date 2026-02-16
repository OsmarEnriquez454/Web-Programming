<?php
session_start();
include("conexion.php");

if (!isset($_SESSION['id_usuario']) || $_SESSION['rol'] != 'cliente') {
    header("Location: index.php");
    exit;
}

// Obtener texto de bienvenida y portada
$consulta = "SELECT bienvenida, imagen FROM configuracion WHERE id = 1";
$resultado = mysqli_query($conexion, $consulta);
$config = mysqli_fetch_assoc($resultado);
?>

<link rel="stylesheet" href="estilos.css">

<!-- BARRA SUPERIOR DEL USUARIO -->
<div class="usuario-barra">
    <span>Bienvenido: <?php echo $_SESSION['nombre']; ?></span> |
    <a href="logout.php">Cerrar sesión</a>
</div>

<!-- BARRA PRINCIPAL -->
<div class="caja1">
    <h2>PokeCards</h2>
</div>

<!-- MENÚ SUPERIOR -->
<div class="caja2">
    <a href="catalogo.php">Catalogo</a> |
    <a href="carrito.php">Carrito</a> |
    <a href="pedido.php">Mis Pedidos</a>
</div>

<!-- CONTENIDO GENERAL -->
<div class="fila-medio">

    <!-- CAJA IZQUIERDA — SOLO BIENVENIDA -->
    <div class="caja3">
        <b>Bienvenido a PokeCards</b>
        <p><?php echo $config['bienvenida']; ?></p>
    </div>

    <!-- CONTENIDO CENTRAL — SOLO IMAGEN -->
    <div class="caja4">
        <?php if (!empty($config['imagen'])) { ?>
            <img src="<?php echo $config['imagen']; ?>" alt="Imagen de portada">
        <?php } ?>

        <br><br>
    </div>

    <!-- LATERAL DERECHO -->
    <div class="caja5">
        <h3>Disponibles Pronto</h3>
        <a href="#">Cartas Favoritas</a><br>
        <a href="#">Cartas Disponibles</a><br>
        <a href="#">Cartas Mas Vendidas</a>
    </div>

</div>

<!-- FOOTER -->
<div class="footer">
    <span>PokeCards © 2025</span>
    <span>Tu tienda de cartas Pokémon</span>
</div>
