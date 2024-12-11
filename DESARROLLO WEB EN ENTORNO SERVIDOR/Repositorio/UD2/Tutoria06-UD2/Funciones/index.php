<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Funciones 2</title>
</head>

<body>
    <?php
    $iva = true;
    $precio = 10;
    //precioConIva();     // esta línea dará error, coméntala
    if ($iva) {
        function precioConIva()
        {
            global $precio; //podemos usar también $precio = $GLOBALS["precio"];
            $precioIva = $precio * 1.18;
            echo "<p>El precio con IVA es " . $precioIva . "</p>";
        }
    }
    precioConIva();     // Aquí ya no da error
    ?>
    <a href="variante1.php">Variante ejemplo 1</a>
    <br>
    <a href="ejemplo2.php">Ejemplo 2</a>
</body>

</html>