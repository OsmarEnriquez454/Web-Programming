<?php
session_start();
include("conexion.php");

// Solo cliente
if (!isset($_SESSION['id_usuario']) || $_SESSION['rol'] != 'cliente') {
    header("Location: index.php");
    exit;
}

$id_cliente = $_SESSION['id_usuario'];

// Crear carrito si no existe
if (!isset($_SESSION['carrito'][$id_cliente])) {
    $_SESSION['carrito'][$id_cliente] = [];
}

// Agregar al carrito
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_carta'])) {
    $id_carta = $_POST['id_carta'];

    if (!isset($_SESSION['carrito'][$id_cliente][$id_carta])) {
        $_SESSION['carrito'][$id_cliente][$id_carta] = 1;
    } else {
        $_SESSION['carrito'][$id_cliente][$id_carta]++;
    }

    header("Location: carrito.php");
    exit;
}

// Obtener cartas
$q = mysqli_query($conexion, "SELECT * FROM cartas");
?>

<link rel="stylesheet" href="estilos.css">

<!-- BARRA SUPERIOR -->
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
    <a href="inicio.php">Inicio</a> |
    <a href="carrito.php">Carrito</a> |
    <a href="pedido.php">Mis Pedidos</a>
</div>

<!-- CONTENEDOR GENERAL -->
<div class="fila-medio">

    <!-- IZQUIERDA -->
    <div class="caja3">
        <b>Menú</b><br><br>
        <a href="inicio.php">Inicio</a><br>
        <a href="catalogo.php">Catalogo</a><br>
        <a href="carrito.php">Carrito</a><br>
        <a href="logout.php">Cerrar sesión</a><br>
    </div>

    <!-- CENTRO – CATÁLOGO -->
    <div class="caja4">
        <h2>Catálogo Pokémon</h2>

        <?php while ($c = mysqli_fetch_assoc($q)) { ?>

            <div style="border: 2px solid #1E90FF; padding: 10px; border-radius: 10px; margin-bottom: 15px;">
                
                <img src="<?php echo $c['imagen']; ?>" 
     style="width:17%; height:17%; display:block; margin-left:0; border-radius:10px;">



                <br>

                <b><?php echo $c['nombre']; ?></b><br>
                Tipo: <?php echo $c['tipo']; ?><br>
                Rareza: <?php echo $c['rareza']; ?><br>
                Precio: $<?php echo $c['precio']; ?><br>
                Stock: <?php echo $c['stock']; ?><br><br>

                <b>Descripción:</b>
                <p><?php echo $c['descripcion']; ?></p>

                <?php if ((int)$c['stock'] > 0) { ?>
                    <form method="POST">
                        <input type="hidden" name="id_carta" value="<?php echo $c['id_carta']; ?>">
                        <input type="submit" value="Agregar al carrito" 
                        style="background:#003399; color:white; border:2px solid yellow; padding:5px 15px; border-radius:5px;">
                    </form>
                <?php } else { ?>
                    <p><b style="color:red;">AGOTADO</b></p>
                <?php } ?>

            </div>

        <?php } ?>
    </div>

    <!-- DERECHA -->
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
