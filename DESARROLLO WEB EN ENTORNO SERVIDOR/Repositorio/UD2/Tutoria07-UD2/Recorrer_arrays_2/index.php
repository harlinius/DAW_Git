<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recorrer arrays 2</title>
</head>

<body>
    <?php
    $frutas = ["a" => "manzana", "b" => "naranja", "c" => "plátano", "d" => "fresa"];
    $frutas[4] = null;
    $frutas[5] = "Kiwi";

    var_dump($frutas);

    reset($frutas); // Sitúa el puntero al inicio
    echo "<p>Clave actual: " . key($frutas) . " - Valor actual: " . current($frutas) . "</p>";

    next($frutas); // Avanza una posición
    echo "<p>Clave actual: " . key($frutas) . " - Valor actual: " . current($frutas) . "</p>";

    next($frutas);
    echo "<p>Clave actual: " . key($frutas) . " - Valor actual: " . current($frutas) . "</p>";

    next($frutas);
    echo "<p>Clave actual: " . key($frutas) . " - Valor actual: " . current($frutas) . "</p>";

    next($frutas);
    echo "<p>Clave actual: " . key($frutas) . " - Valor actual: " . current($frutas) . "</p>";

    end($frutas); // Sitúa el puntero al final
    echo "<p>Clave actual: " . key($frutas) . " - Valor actual: " . current($frutas) . "</p>";

    prev($frutas); // Retrocede una posición
    echo "<p>Clave actual: " . key($frutas) . " - Valor actual: " . current($frutas) . "</p>";
    ?>
    <a href="ejercicioResuelto.php">Ejercicio resuelto</a>
</body>

</html>