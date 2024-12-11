<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $num1 = $_POST['num1'];
        $num2 = $_POST['num2'];
        $resultado = $num1 + $num2;
        echo "Resultado: " . $resultado;
    }
?>
