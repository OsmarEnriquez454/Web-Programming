<!DOCTYPE html>
<html>
<body>

<h1>Ingresa tu fecha de nacimiento</h1>

<form method="post">
    <h2>Mes: <input type="number" name="mes" min="1" max="12" required></h2>
    <h2>Día: <input type="number" name="dia" min="1" max="31" required></h2>
    <h2><input type="submit" value="Ver Signo Zodiacal"></h2>
</form>

<?php
if (isset($_POST['mes']) && isset($_POST['dia'])) {
    $mes = $_POST['mes'];
    $dia = $_POST['dia'];
    $signo = "";

    switch ($mes) {
        case 1:
            if ($dia <= 20) {
                $signo = "Capricornio";
            } else if ($dia <= 31) {
                $signo = "Acuario";
            }
        break;

        case 2:
            if ($dia <= 18) {
                $signo = "Acuario";
            } else if ($dia <= 29) {
                $signo = "Piscis";
            }
        break;

        case 3:
            if ($dia <= 20) {
                $signo = "Piscis";
            } else if ($dia <= 31) {
                $signo = "Aries";
            }
        break;

        case 4:
            if ($dia <= 19) {
                $signo = "Aries";
            } else if ($dia <= 30) {
                $signo = "Tauro";
            }
        break;

        case 5:
            if ($dia <= 20) {
                $signo = "Tauro";
            } else if ($dia <= 31) {
                $signo = "Géminis";
            }
        break;

        case 6:
            if ($dia <= 20) {
                $signo = "Géminis";
            } else if ($dia <= 30) {
                $signo = "Cáncer";
            }
        break;

        case 7:
            if ($dia <= 22) {
                $signo = "Cáncer";
            } else if ($dia <= 31) {
                $signo = "Leo";
            }
        break;

        case 8:
            if ($dia <= 22) {
                $signo = "Leo";
            } else if ($dia <= 31) {
                $signo = "Virgo";
            }
        break;

        case 9:
            if ($dia <= 22) {
                $signo = "Virgo";
            } else if ($dia <= 30) {
                $signo = "Libra";
            }
        break;

        case 10:
            if ($dia <= 22) {
                $signo = "Libra";
            } else if ($dia <= 31) {
                $signo = "Escorpio";
            }
        break;

        case 11:
            if ($dia <= 21) {
                $signo = "Escorpio";
            } else if ($dia <= 30) {
                $signo = "Sagitario";
            }
        break;

        case 12:
            if ($dia <= 21) {
                $signo = "Sagitario";
            } else if ($dia <= 31) {
                $signo = "Capricornio";
            }
        break;
    }

    echo "<h1>Tu signo zodiacal es: $signo</h1>";
}
?>

</body>
</html>