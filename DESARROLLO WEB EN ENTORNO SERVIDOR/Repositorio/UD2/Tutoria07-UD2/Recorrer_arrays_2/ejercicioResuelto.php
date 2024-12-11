<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Recorrer arrays 2 - Ejercicio Resuelto</title>
</head>

<body>
    <table cellpadding="2" cellspacing="2">
        <tbody style="background-color: grey; text-align: center; font-weight: bold">
            <td>Clave</td>
            <td>Valor</td>
        </tbody>
        <?php
        // Reseteamos el puntero al inicio del array
        reset($_SERVER);

        $clave = key($_SERVER);
        echo $clave;
        // Recorremos el array $_SERVER usando current() y key()
        while ($clave) {
            $valor = current($_SERVER);

            // Mostramos la clave y el valor en la tabla
            echo "<tr>";
            echo "<td>" . htmlspecialchars($clave) . "</td>";
            echo "<td>" . htmlspecialchars($valor) . "</td>";
            echo "</tr>";

            // Avanzamos a la siguiente posición
            next($_SERVER);
            $clave = key($_SERVER);
        }
        ?>
    </table>
    <?php
        end($_SERVER);
        $clave = key($_SERVER);
        echo $clave;
        var_dump($clave);
    ?>
    <a href="index.php">Recorrer arrays</a>
</body>

</html>