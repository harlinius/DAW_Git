<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ejercicio</title>
</head>
<body>
    <p>Haz una página PHP que utilice foreach() para mostrar todos los valores del array "$_SERVER" en una tabla con dos columnas. La primera columna debe contener el nombre de la variable, y la segunda su valor.</p>
    <table cellpadding="2" cellspacing="2">
        <tbody style="background-color: grey; text-align: center; font-weight: bold">
            <td>Clave</td>
            <td>Valor</td>
        </tbody>
    <?php
    var_dump($_SERVER);

        foreach($_SERVER as $key=>$value){
            echo "<tr>";
            echo "<td>$key</td>";
            echo "<td>$value</td>";
            echo "<tr>";
        }
    ?>
    </table>
    <a href="index.php">Recorrer arrays</a>
</body>
</html>