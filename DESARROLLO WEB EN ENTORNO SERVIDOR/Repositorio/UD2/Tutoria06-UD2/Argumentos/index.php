<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Argumentos</title>
</head>

<body>
    <?php
    function precioConIva($precio)
    {
        return $precio * 1.21;
    }
    $precio = 10;
    $precioIva = precioConIva($precio);
    echo "<p>El precio con IVA 21% es $precioIva </p>";

    /**
     * El símbolo & antes de $precio indica que se está pasando la variable por referencia y no por valor. Esto significa que cualquier cambio realizado sobre $precio dentro de la función afectará directamente a la variable original fuera de la función. En lugar de trabajar con una copia del valor de $precio, la función opera directamente sobre la variable que se le pasa.
     * Valor por defecto definido en $iva. Valores por defecto SIEMPRE A LA DERECHA.
     */
    function precioConIva2(&$precio, $iva = 0.21)
    {
        $precio *= (1 + $iva);
    }
    $precio = 10;
    precioConIva2($precio);
    echo "<p>El precio con IVA 21% es $precio</p>";
    //Cambiando el valor por defecto.
    precioConIva2($precio, 0.23);

    echo "<p>El precio con IVA 23% es $precio</p>";

    function precioConIva3(float $precio): float
    { //con :float especificamos el tipo de dato a devolver
        return $precio * 1.18;
    }
    $precio = 10;
    $precioIva = precioConIva3($precio);
    echo "<p>El precio con IVA es $precioIva </p>";
    ?>
    <a href="ejercicioResuelto.php">Ejercicio resuelto</a>
</body>

</html>