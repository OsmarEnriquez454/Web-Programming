<?php
session_start();
include("conexion.php");

if (!isset($_SESSION['id_usuario']) || $_SESSION['rol'] != 'cliente') {
    header("Location: index.php");
    exit;
}

$id_cliente = $_SESSION['id_usuario'];

// --- CREAR PEDIDO DESDE CARRITO ---
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!isset($_SESSION['carrito'][$id_cliente]) || empty($_SESSION['carrito'][$id_cliente])) {
        echo "<h2>No hay artículos en el carrito.</h2>";
        echo "<p><a href='catalogo.php'>Ir al catálogo</a></p>";
        exit;
    }

    $carrito = $_SESSION['carrito'][$id_cliente];
    $total = 0;

    foreach ($carrito as $id_carta => $cantidad) {
        $q = mysqli_query($conexion, "SELECT precio, stock FROM cartas WHERE id_carta = $id_carta");
        $c = mysqli_fetch_assoc($q);
        $total += ($c['precio'] * $cantidad);
    }

    $fecha = date("Y-m-d H:i:s");
    mysqli_query($conexion, "INSERT INTO pedidos (id_usuario, total, estado, fecha_pedido) 
                             VALUES ($id_cliente, $total, 'pagado', '$fecha')");
    $id_pedido = mysqli_insert_id($conexion);

    foreach ($carrito as $id_carta => $cantidad) {
        $q = mysqli_query($conexion, "SELECT precio, stock FROM cartas WHERE id_carta = $id_carta");
        $c = mysqli_fetch_assoc($q);
        $subtotal = $c['precio'] * $cantidad;

        mysqli_query($conexion, 
            "INSERT INTO detalles_pedido (id_pedido, id_carta, cantidad, subtotal) 
             VALUES ($id_pedido, $id_carta, $cantidad, $subtotal)");

        $nuevo_stock = $c['stock'] - $cantidad;
        if ($nuevo_stock < 0) $nuevo_stock = 0;

        mysqli_query($conexion, "UPDATE cartas SET stock = $nuevo_stock WHERE id_carta = $id_carta");
    }

    $_SESSION['carrito'][$id_cliente] = [];

    $q = mysqli_query($conexion, "SELECT * FROM pedidos WHERE id_pedido = $id_pedido");
    $pedido = mysqli_fetch_assoc($q);

} else {

    $q = mysqli_query($conexion, 
        "SELECT * FROM pedidos WHERE id_usuario = $id_cliente ORDER BY id_pedido DESC LIMIT 1");

    if (mysqli_num_rows($q) == 0) {
        echo "<h2>No tienes ningún pedido registrado.</h2>";
        echo "<p><a href='inicio.php'>Volver</a></p>";
        exit;
    }

    $pedido = mysqli_fetch_assoc($q);
}

$u = mysqli_query($conexion, 
    "SELECT nombre, direccion FROM usuarios WHERE id_usuario = $id_cliente");
$usuario = mysqli_fetch_assoc($u);

$detalles = mysqli_query($conexion,
    "SELECT d.*, c.nombre, c.imagen
     FROM detalles_pedido d
     INNER JOIN cartas c ON d.id_carta = c.id_carta
     WHERE d.id_pedido = {$pedido['id_pedido']}"
);
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
    <a href="catalogo.php">Catálogo</a> |
    <a href="carrito.php">Carrito</a>
</div>

<!-- CONTENEDOR -->
<div class="fila-medio">

    <!-- IZQUIERDA -->
    <div class="caja3">
        <b>Menú</b><br><br>
        <a href="inicio.php">Inicio</a><br>
        <a href="catalogo.php">Catálogo</a><br>
        <a href="carrito.php">Carrito</a><br>
        <a href="logout.php">Cerrar sesión</a><br>
    </div>

    <!-- CENTRO -->
    <div class="caja4">

        <h2>Mi Pedido</h2>

        <p><b>Estado:</b> <?php echo $pedido['estado']; ?></p>
        <p><b>Forma de pago:</b> Por tarjeta</p>
        <p><b>Total pagado:</b> $<?php echo $pedido['total']; ?></p>
        <p><b>Fecha:</b> <?php echo $pedido['fecha_pedido']; ?></p>
        <p><b>Enviado por FedEx a:</b> <?php echo $usuario['direccion']; ?></p>

        <hr>

        <h3>Artículos comprados</h3>

        <?php while ($d = mysqli_fetch_assoc($detalles)) { ?>
            <div style="border:2px solid #1E90FF; padding:10px; margin-bottom:15px; border-radius:10px;">

                <img src="<?php echo $d['imagen']; ?>" 
                     style="width:17%; height:17%; display:block; margin-left:0; border-radius:8px; border:2px solid #FFCC00;">

                <b><?php echo $d['nombre']; ?></b><br>
                Cantidad: <?php echo $d['cantidad']; ?><br>
                Subtotal: $<?php echo $d['subtotal']; ?><br>
            </div>
        <?php } ?>

        <a href="inicio.php" style="color:white; background:#003399; border-radius:5px; padding:7px 12px; border:2px solid yellow;">Volver</a>

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
