<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generación de código HTML</title>
</head>

<body>
    <h1>Generación de código HTML</h1>
    <?php

    //Generación de código HTML
    echo "<h2>Este es el primer ejemplo</h2>" . "<h3>Continuación del ejemplo</h3>";
    print "<h4>Más ejemplos</h4>";

    $ciclo = "DAW";
    $modulo = "DWES";
    print "<p>";
    printf("%s es un módulo de %d curso de %s", $modulo, 2, $ciclo);
    print "</p>";

    printf("<p>El número PI vale %+.2f</p>", 3.1416); // +3.14
    $txt_pi = sprintf("<p>El número PI vale %+.2f</p>", 3.1416);
    ?>
</body>

</html>