<!DOCTYPE html>
<html>
<body>

<?php
	$num1 = $_POST["num1"];
	$num2 = $_POST["num2"];
	$op = $_POST["op"];

	if ($op == "sumar") {
		echo "Resultado: " . ($num1 + $num2);
	}
	elseif ($op == "restar") {
		echo "Resultado: " . ($num1 - $num2);	
	}
	elseif ($op == "multiplicar") {
		echo "Resultado: " . ($num1 * $num2);
	}
	elseif ($op == "dividir") {
		if ($num2 !=0) {
			echo "Resultado: " . ($num1 / $num2);
		}
		else{
			echo "No se puede dividir entre 0";
		}
		
	}




?>
</body>
</html>