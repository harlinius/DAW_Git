<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Condicionales</title>
</head>

<body style="background-color: antiquewhite">
    <?php
    // Establece la localización a español de España para que los nombres de días y meses se muestren en español.
    setlocale(LC_ALL, 'es_ES.UTF-8');

    // Define la zona horaria a la de Madrid, para asegurarnos de que la hora mostrada es correcta.
    date_default_timezone_set('Europe/Madrid');

    // Crea un objeto DateTime con la fecha y hora actual.
    $ahora = new DateTime();

    // Utiliza strftime para formatear la fecha y la hora en español.
    // Se utiliza %A para el nombre completo del día, %d para el día del mes, %B para el nombre completo del mes,
    // %Y para el año con cuatro dígitos, y %H:%M:%S para la hora, minutos y segundos.
    $fecha = strftime("Hoy es %A, %d de %B de %Y y son las %H:%M:%S", $ahora->getTimestamp());

    // Muestra la fecha formateada en la página web.
    echo $fecha;
    ?>
    <br>
    <a href="index.php">Sulución con intl (Internationalization)</a>
    <br>
    <a href="index-independiente.php">Sulución con independencia del servidor</a>
    <br>
    <a href="../Ejemplo1/index.php">Funciones de Fecha</a>
    <br>
    <a href="../Ejemplo2/index.php">Variables especiales de PHP</a>
    <br>
    <a href="../Ejemplo3/index.php">Condicionales</a>
</body>

</html>