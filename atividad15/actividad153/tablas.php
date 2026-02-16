<!DOCTYPE html>
<html>
<body>
<h1>Ingresa un multiplo:</h1>
<form method="post">
    <h2><input type="number" name="multiplo" required></h2>
    <h2><input type="submit" value="Multiplicar"></h2>
</form>

<?php
if (isset($_POST['multiplo'])) {
    $numero = $_POST['multiplo'];
    $multiplicar = $_POST['multiplo'];

    for ($i=1; $i <=12 ; $i++) { 
        $multiplicar = $numero*$i;
        echo $numero." X ".$i." = ".$multiplicar."<br>";
    }
}
?>

</body>
</html>
