<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Funciones</title>
</head>

<body>
    <?php
    $iva = true;
    $precio = 10;
    if ($iva) {
        //podemos hacer uso de la función
        //Antes de implementarla.
        precioConIva();
    }
    function precioConIva()
    {
        $precio = $GLOBALS["precio"];
        $precioIva = $precio * 1.18;
        echo "<p>El precio con IVA es " . $precioIva . "</p>";
    }
    ?>
    <a href="index.php">Ejemplo 1</a>
    <br>
    <a href="ejemplo2.php">Ejemplo 2</a>
</body>

</html>