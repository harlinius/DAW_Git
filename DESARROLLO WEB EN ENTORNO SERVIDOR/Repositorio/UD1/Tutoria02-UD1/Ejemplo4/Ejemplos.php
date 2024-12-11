<?php
//Tipos de datos
    $nombre = "Juan"; // String
    $edad = 25; // Integer
    $altura = 1.75; // Float
    $esEstudiante = true; // Boolean

    echo "Hola, me llamo $nombre y tengo $edad años. Mido $altura metros.";
?>

<?php
//Expresiones y operadores
    $numero1 = 10;
    $numero2 = 5;
    $suma = $numero1 + $numero2;
    $resta = $numero1 - $numero2;
    $multiplicacion = $numero1 * $numero2;
    $division = $numero1 / $numero2;

    echo "Suma: $suma <br>";
    echo "Resta: $resta <br>";
    echo "Multiplicación: $multiplicacion <br>";
    echo "División: $division <br>";
?>

<?php
//Variables globales y locales
    $variableGlobal = "Soy global";

    function mostrarVariable() {
        global $variableGlobal; // Acceder a la variable global
        echo $variableGlobal;
    }

    mostrarVariable();
?>

<?php
//Variables superglobales
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombre = $_POST['nombre'];
        echo "Nombre enviado a través de POST: " . $nombre;
    }
?>

