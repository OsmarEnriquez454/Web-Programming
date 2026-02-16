<?php
session_start();

$cookie = "usuario";

// Restaurar sesión desde cookie
if (!isset($_SESSION["login"]) && isset($_COOKIE[$cookie]))
  $_SESSION["login"] = $_COOKIE[$cookie];

// Login o invitado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST["login"])) {
    $_SESSION["login"] = $_POST["login"];
    $_SESSION["pass"]  = $_POST["pass"];
    setcookie($cookie, $_SESSION["login"], time() + 86400 * 30, "/");
  } elseif (isset($_POST["invitado"])) {
    $_SESSION["login"] = "Invitado";
  }
}

// Cerrar sesión
if (isset($_GET["logout"])) {
  session_destroy();
  setcookie($cookie, "", time() - 1, "/");
  header("Location: " . $_SERVER["PHP_SELF"]);
  exit;
}

// Color y contadores
if (isset($_POST["color"])) $_SESSION["color"] = $_POST["color"];
$_SESSION["contador_sesion"] = ($_SESSION["contador_sesion"] ?? 0) + 1;
$contador_total = ($_COOKIE["contador_total"] ?? 0) + 1;
setcookie("contador_total", $contador_total, time() + 86400 * 30, "/");

// Variables
$usuario = $_SESSION["login"] ?? "Invitado";
$color_fondo = $_SESSION["color"] ?? "#fff";
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="style.css">
</head>
<body style="background-color: <?= htmlspecialchars($color_fondo) ?>; font-family:sans-serif;">

  <!-- Barra superior -->
  <div class="usuario-barra">
    <?php if ($usuario != "Invitado"): ?>
      <span><?= htmlspecialchars($usuario) ?></span> |
      <a href="?logout=1">Cerrar sesión</a>
    <?php else: ?>
      <a href="index.php">INGRESAR</a>
    <?php endif; ?>
  </div>
  <div class="caja1">
    <h1>LOGOTIPO</h1>
    <div class="busqueda">
      Buscar <input type="text">
    </div>
  </div>

  <div class="caja2"><h4>
    <a href="#">Lorem</a>
    <a href="#">Ipsum</a>
    <a href="#">Dolor</a>
    <a href="#">Sit</a>
    <a href="#">Amet</a>
  </h4></div>

  <div class="fila-medio">

    <div class="caja3">
      <h4><a href="#">Noticias</a></h4>
      <a href="#">dd/mm/aaaa Lorem ipsum dolor sit amet</a><br>
      <a href="#">dd/mm/aaaa Consectetuer adipiscing elit</a><br>
      <a href="#">dd/mm/aaaa Donec molestie nunc eu sapien</a><br>
      <a href="#">dd/mm/aaaa Maecenas adipiscing dolor sit amet</a><br>
      <a href="#">dd/mm/aaaa Fusce tristique lorem id metus</a><br>

      <h4><a href="#">Enlaces relacionados</a></h4>
      <a href="#">Proin placerat</a><br>
      <a href="#">Nulla in felis</a><br>
      <a href="#">Nam luctus</a><br>

      <h4><a href="#">Publicidad</a></h4>
      <p>
        Etiam fermentum, nisl tincidunt blandit interdum, 
        massa velit ultrices sapien, id laoreet nulla sapien eget lorem. 
        Aenean sit amet arcu vitae nulla scelerisque rutrum.
      </p>
      <a href="#">Seguir leyendo...</a>
    </div>

    <div class="caja4">
      <h2>Lorem ipsum dolor sit amet, consectetur adipiscing elit</h2>
      <img src="perro.png" alt="imagen" style="width:200px; height:auto;">
      <p>
        Nullam est lacus, suscipit ut, dapibus quis, condimentum ac, risus.
        Vivamus vestibulum, ipsum sollicitudin faucibus pharetra, dolor metus fringilla dui, vel aliquet pede diam tempor tortor.

        Vestibulum pulvinar urna et quam. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.
        Nullam vel turpis vitae dui imperdiet laoreet. Quisque eget est..
      </p>
      <a href="#">Seguir leyendo...</a><br><br>

      <h2>Vivamus lobortis turpis ac ante fringilla faucibus</h2>
      <img src="perro.png" alt="imagen" style="width:200px; height:auto;">
      <p>
        Quisque eget ipsum.
        Donec commodo, turpis vel venenatis sollicitudin, quam ante convallis justo, sed eleifend justo lectus quis sapien.
        Ut consequat libero eget est.
      </p>
      <a href="#">Seguir leyendo...</a>
    </div>

    <div class="caja5">
      <h3>Phasellus blandit</h3>
      <p>
        Praesent sodales imperdiet augue.
        Mauris lorem felis, semper nec, suscipit ut, varius vel, nulla.
        Nulla facilisi.
        Morbi at enim ut ante ultrices dictum.
      </p>
      <a href="#">Seguir leyendo...</a><br><br>

      <h3>Nullam vel turpis</h3>
      <p>
        Donec commodo, turpis vel venenatis sollicitudin, quam ante convallis justo, sed eleifend justo lectus quis sapien.
        Ut consequat libero eget est.
      </p>
      <a href="#">Seguir leyendo...</a>
    </div>
  </div>

  <!-- FORMULARIO COLOR Y CONTADORES -->
  <div style="text-align:center; margin:30px;">
    <form method="POST">
      <label>Color preferido del sitio: </label>
      <input type="color" name="color" value="<?= htmlspecialchars($color_fondo) ?>">
      <button type="submit">Guardar</button>
    </form>

    <p><b>Visitas en esta sesión:</b> <?= $_SESSION["contador_sesion"] ?></p>
    <p><b>Visitas totales (cookie):</b> <?= $contador_total ?></p>
  </div>

  <div class="footer">
    <p>
      <a href="#">Nulla</a> | <a href="#">Pharetra</a> | 
      <a href="#">Luctus</a> | <a href="#">Ipsuma</a> | 
      <a href="#">Proin</a> | <a href="#">Placerat</a>
    </p>    
    <p>© Copyright Lorem ipsum</p>
  </div>

</body>
</html>
