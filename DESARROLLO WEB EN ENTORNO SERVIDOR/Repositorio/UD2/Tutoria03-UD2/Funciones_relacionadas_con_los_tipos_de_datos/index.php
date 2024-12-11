<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Funciones relacionadas con los tipos de datos</title>
</head>

<body>
    <h1>Funciones relacionadas con los tipos de datos.</h1>
    <?php
    //Funciones relacionadas con los tipos de datos.
    $a = $b = "3.1416"; // asignamos a las dos variables la misma cadena de texto
    settype($b, "float"); // y cambiamos $b a tipo float
    print "<p>\$a vale $a y es de tipo " . gettype($a) . "</p>";
    print "<p>\$b vale $b y es de tipo " . gettype($b) . "</p>";

    $a = "3.1416";
    if (isset($a)) { // la variable $a está definida
        echo "<p>Está definida</p>";
        unset($a); //ahora ya no está definida
    
    }
    if (empty($a)) // la variable $a está definida
        echo "<p>No está definida</p>";

    define("PI", 3.1416);
    print "<p>El valor de PI es " . PI . "</p>"; //El identificador se reconoce tanto por PI como por pi
    ?>
</body>

</html>