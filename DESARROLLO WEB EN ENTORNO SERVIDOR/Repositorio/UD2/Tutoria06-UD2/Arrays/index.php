<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arrays</title>
</head>

<body>
    <?php
    // array numérico
    $colores = array("Rojo", "Amarillo", "Verde", "Azul", 3);
    //o bien
    $colores = ["Rojo", "Amarillo", "Verde", "Azul", 3];
    //o bien
    $colores = [0 => "Rojo", 1 => "Amarillo", 2 => "Verde", 4 => "Azul", 5 => 3];

    echo "<p>$colores[0]</p>";
    echo "<p>$colores[4]</p>";
    echo "<p>$colores[3]</p>";

    var_dump( $colores);
    echo "<br><br>";

    // array asociativo
    $modulos = array("PR" => "Programación", "BD" => "Bases de datos", "DWES" => "Desarrollo web en entorno servidor");
    //o bien
    $modulos = ["PR" => "Programación", "BD" => "Bases de datos", "DWES" => "Desarrollo web en entorno servidor"];

    echo "<p>" . $modulos["DWES"] . "</p>";
    var_dump($modulos);
    echo "<br><br>";
    //array bidemensional
    $ciclos = array(
        "DAM" => array("PR" => "Programación", "BD" => "Bases de datos", "PMDM" => "Programacion Multimedia y Dispositivos móviles"),
        "DAW" => array("PR" => "Programación", "BD" => "Bases de datos", "DWES" => "Desarrollo web en entorno servidor")
    );

    //En formato [ ]
    $ciclos = [
        "DAM" => ["PR" => "Programación", "BD" => "Bases de datos", "PMDM" => "Programacion Multimedia y Dispositivos móviles"],
        "DAW" => ["PR" => "Programacion", "BD" => "Bases de datos", "DWES" => "Desarrollo web en entorno servidor"]
    ];

    echo "<p>".$ciclos["DAW"]["PR"]."</p>";

    var_dump($ciclos);
    echo "<br><br>";
    var_dump($ciclos["DAM"]);
    echo "<br><br>";

    $verduras[0] = "Tomates";
    $verduras[1] = "Espinacas";
    $verduras[2] = "Acelgas";
    var_dump($verduras);
    echo "<br><br>";

    //Se pueden mezclar tipos de array
    $verduras["T"]="Tomates";

    var_dump($verduras);
    echo "<br><br>";

    //No es necesario indicar el valor de la clave
    $verduras[] = "Pepinos";
    $verduras[] = "Zanahorias";
    var_dump($verduras);
    echo "<br><br>";

    $verduras[7] = "Berenjenas";
    $verduras[] = "Calabacines";
    var_dump($verduras);
    echo "<br><br>";
    ?>
</body>

</html>