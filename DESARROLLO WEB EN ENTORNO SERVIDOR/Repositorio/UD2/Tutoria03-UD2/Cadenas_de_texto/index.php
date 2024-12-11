<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadenas de texto</title>
</head>

<body>
    <h1>Cadenas de texto</h1>
    <?php
    //Cadenas de texto
    $modulo = "DWES";
    print "<p>Módulo: $modulo</p>";

    $a = "Módulo ";
    $b = $a . "DWES"; // ahora $b contiene "Módulo DWES"
    $a .= "DWES"; // ahora $a también contiene "Módulo DWES"
    
    echo "<p>" . $b . "<br>" . $a . "</p>";

    $a = <<<CADENA
    <p>Desarrollo de Aplicaciones Web<br>
    Desarrollo Web en Entorno Servidor </p>
    CADENA;
    print $a;
    ?>
</body>

</html>