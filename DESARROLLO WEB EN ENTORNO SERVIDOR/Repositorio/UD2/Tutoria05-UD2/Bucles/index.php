<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bucles</title>
</head>
<body>
    <h1>Ejemplos de Bucles en PHP</h1>

    <?php
    // Bucle for
    echo "<h2>Bucle for</h2>";
    for ($i = 10; $i >= 1; $i--) {
        echo "Número: $i<br>";
    }

    // Bucle while
    echo "<h2>Bucle while</h2>";
    $i = 1;
    while ($i <= 10) {
        echo "Número: $i<br>";
        $i++;
    }

    // Bucle do while
    echo "<h2>Bucle do while</h2>";
    $i = 1;
    do {
        echo "Número: $i<br>";
        $i++;
    } while ($i <= 10);

    // Bucle foreach
    echo "<h2>Bucle foreach</h2>";
    $frutas = array("Manzana", "Banana", "Naranja", "Fresa");
    foreach ($frutas as $fruta) {
        echo "Fruta: $fruta<br>";
    }

    // Bucle anidado
    echo "<h2>Bucle anidado</h2>";
    for ($i = 1; $i <= 5; $i++) {
        for ($j = 1; $j <= 10; $j++) {
            echo "$i x $j = " . ($i * $j) . "<br>";
        }
        echo "<br>";
    }

    // Uso de break y continue
    echo "<h2>Uso de break y continue</h2>";
    for ($i = 1; $i <= 10; $i++) {
        if ($i == 5) {
            continue; // Saltar el 5
        }
        else if($i == 8){
            break; //Salir del bucle
        }
        echo "Número: $i<br>";
    }
    ?>
</body>
</html>
