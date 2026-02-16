<!DOCTYPE html>
<html>
<body>

<h1>Calculadora</h1>

<form method="post">
    <p>¿Cuántos números? (2 a 10)</p>
    <input type="number" name="cantidad" min="2" max="10" required>
    <input type="submit" value="Continuar">
</form>
<br>

<?php
if (isset($_POST['cantidad']) && !isset($_POST['numeros'])) {
    $cant = $_POST['cantidad'];
    echo "<form method='post'>";
    for ($i = 1; $i <= $cant; $i++) {
        echo "Número $i: <input type='text' name='numeros[]' required><br>";
    }
    echo "<p>Operación:</p>
          <input type='radio' name='operacion' value='suma' required> Suma
          <input type='radio' name='operacion' value='resta'> Resta
          <input type='radio' name='operacion' value='mult'> Mult<br><br>";
    echo "<input type='hidden' name='cantidad' value='$cant'>";
    echo "<input type='submit' value='Calcular'>";
    echo "</form>";
}

if (isset($_POST['numeros']) && isset($_POST['operacion'])) {
    $nums = $_POST['numeros'];
    $op = $_POST['operacion'];
    $res = 0;

    if ($op == 'suma') {
        $res = array_sum($nums);
        $texto = implode("+", $nums);
    } elseif ($op == 'resta') {
        $res = $nums[0];
        for ($i = 1; $i < count($nums); $i++) {
            $res -= $nums[$i];
        }
        $texto = implode("-", $nums);
    } else {
        $res = 1;
        foreach ($nums as $n) {
            $res *= $n;
        }
        $texto = implode("×", $nums);
    }
    echo "<h1>Resultado: $texto = $res</h1>";
    echo "<a href='" . $_SERVER['PHP_SELF'] . "'>Volver</a>";
}
?>

</body>
</html>
