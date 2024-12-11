<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio Resuelto Condicionales</title>
</head>

<body>
    <!-- Carlos ha decidido hacer su primer programa, un taller mecánico les ha propuesto que le hagan una web que, en función del tipo de motor, recomiende un aceite u otra.
     
    Haz una página que en función de la variable $motor que puede tomar los valores 1 (Gasolina), 2 (Diésel), 3 (Motocicleta), 4 (Eléctrico) nos muestre el tipo de motor, es decir si $motor=1 nos mostrará "El motor es de Gasolina". Hazlo de dos formas, con bucles if y con switch. -->
    <?php
    $motor = 1; //podemos dar valores 2,3,4, o probar uno no válido
    //1.- Con if elseif else ---------------------------------------------
    if ($motor == 1) {
        echo "El motor es de Gasolina<br>";
    } elseif ($motor == 2) {
        echo "El motor es Diesel<br>";
    } elseif ($motor == 3) {
        echo "El motor es de una Motocicleta<br>";
    } elseif ($motor == 4) {
        echo "El motor es Eléctrico<br>";
    } else {
        echo "Error, el tipo de motor NO es válido<br>";
    }
    //2.- con switch -----------------------------------------------------
    switch ($motor) {
        case 1:
            echo "El motor es de Gasolina<br>";
            break;
        case 2:
            echo "El motor es Diesel<br>";
            break;
        case 3:
            echo "El motor es de una Motocicleta<br>";
            break;
        case 4:
            echo "El motor es Eléctrico<br>";
            break;
        default:
            echo "Error, el tipo de motor NO es válido<br>";
    }
    ?>
    <br>
    <a href="indexMejorado.php">Ejercicio mejorado</a>
</body>

</html>