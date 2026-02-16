<!DOCTYPE html>
<html>
<body>
<h1>Ingresa tu calificación:</h1>
<form method="post">
    <h2><input type="number" name="calificacion" min="0" max="100" required></h2>
    <h2><input type="submit" value="Evaluar"></h2>
</form>

<?php
if (isset($_POST['calificacion'])) {
    $calificacion = $_POST['calificacion'];

    if ($calificacion == 100) {
        echo "<h1>Excelente</h1>";
    } elseif ($calificacion >= 80) {
        echo "<h1>Muy Bien</h1>";
    } elseif ($calificacion >= 60) {
        echo "<h1>Bien</h1>";
    } elseif ($calificacion >= 40) {
        echo "<h1>Mal</h1>";
    } else {
        echo "<h1>Pésimo</h1>";
    }
}
?>

</body>
</html>
