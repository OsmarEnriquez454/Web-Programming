<?php
session_start();
include("conexion.php");

if (!isset($_SESSION['id_usuario']) || $_SESSION['rol'] != 'cliente') {
    header("Location: index.php");
    exit;
}

$id_cliente = $_SESSION['id_usuario'];

// Crear carrito si no existe
if (!isset($_SESSION['carrito'][$id_cliente])) {
    $_SESSION['carrito'][$id_cliente] = [];
}
// QUITAR DEL CARRITO
if (isset($_POST['quitar'])) {
    $id_carta = $_POST['id_carta'];

    if (isset($_SESSION['carrito'][$id_cliente][$id_carta])) {
        $_SESSION['carrito'][$id_cliente][$id_carta]--;

        if ($_SESSION['carrito'][$id_cliente][$id_carta] <= 0) {
            unset($_SESSION['carrito'][$id_cliente][$id_carta]);
        }
    }
}
// PAGAR (solo redirige a pedido)
if (isset($_POST['pagar'])) {
    header("Location: pedido.php");
    exit;
}
?>

<link rel="stylesheet" href="estilos.css">

<!-- BARRA SUPERIOR -->
<div class="usuario-barra">
    <span>Bienvenido: <?php echo $_SESSION['nombre']; ?></span> |
    <a href="logout.php">Cerrar sesión</a>
</div>

<!-- CAJA 1 -->
<div class="caja1">
    <h2>PokeCards</h2>
</div>

<!-- CAJA 2 -->
<div class="caja2">
    <a href="inicio.php">Inicio</a> |
    <a href="catalogo.php">Catalogo</a> |
    <a href="pedido.php">Mis Pedidos</a>
</div>

<!-- CONTENIDO PRINCIPAL -->
<div class="fila-medio">

    <!-- CAJA 3 -->
    <div class="caja3">
        <b>Menú</b><br><br>
        <a href="inicio.php">Inicio</a><br>
        <a href="catalogo.php">Catálogo</a><br>
        <a href="logout.php">Cerrar sesión</a><br>
    </div>

    <!-- CAJA 4 (CONTENIDO DEL CARRITO) -->
    <div class="caja4">

        <h2>Mi Carrito</h2>

        <?php
        $carrito = $_SESSION['carrito'][$id_cliente];

        if (empty($carrito)) {
            echo "<p>Tu carrito está vacío.</p>";
            exit;
        }

        $total = 0;

        foreach ($carrito as $id_carta => $cantidad) {

            // Traer info de la carta
            $q = mysqli_query($conexion, "SELECT * FROM cartas WHERE id_carta=$id_carta");
            $carta = mysqli_fetch_assoc($q);

            $subtotal = $carta['precio'] * $cantidad;
            $total += $subtotal;

            echo "<div style='border:2px solid #1E90FF; padding:10px; border-radius:10px; margin-bottom:15px;'>";

            echo "<img src='{$carta['imagen']}' 
                      style='width:17%; height:17%; border:2px solid #FFCC00;
                             border-radius:8px; display:block; margin-left:0;'>";

            echo "<b>{$carta['nombre']}</b><br>";
            echo "Precio: $ {$carta['precio']}<br>";
            echo "Cantidad: $cantidad<br><br>";

            // BOTÓN QUITAR
            echo "<form method='POST'>
                    <input type='hidden' name='id_carta' value='$id_carta'>
                    <input type='submit' name='quitar' 
                           value='Quitar del carrito'
                           style='background:#003399; color:white;
                                  border:2px solid yellow; border-radius:5px; padding:5px;'>
                  </form>";

            echo "</div>";
        }

        echo "<h3>Total: $$total</h3>";
        ?>

        <form method="POST" action="pedido.php">
            <input type="submit" name="pagar" value="Pagar"
                   style="background:#008000; color:white;
                          border:2px solid yellow; border-radius:5px; padding:8px 15px;">
        </form>

    </div>

</div>

<!-- FOOTER -->
<div class="footer">
    <span>PokeCards © 2025</span>
    <span>Tu tienda de cartas Pokémon</span>
</div>
