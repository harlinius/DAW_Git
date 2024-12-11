<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio Resuelto</title>
</head>

<body style="background-color: antiquewhite">
    <?php
    // Asegúrate de tener la extensión intl habilitada en tu servidor PHP.

    // Establecer la zona horaria a la de Madrid.
    date_default_timezone_set('Europe/Madrid');

    // Crear un objeto DateTime con la fecha y hora actual.
    $ahora = new DateTime();

    // Crear un formateador de fecha personalizado usando la clase IntlDateFormatter.
    $formatoFecha = new IntlDateFormatter(
        'es_ES', // Localización en español de España.
        IntlDateFormatter::FULL, // Formato de la fecha.
        IntlDateFormatter::NONE // Sin formato de hora.
    );

    // Personalizar el formato para obtener el nombre del día y del mes en español.
    $formatoFecha->setPattern("EEEE, d 'de' MMMM 'de' y");

    // Formatear la fecha actual.
    $fechaFormateada = $formatoFecha->format($ahora);

    // Formatear la hora por separado.
    $horaFormateada = $ahora->format('H:i:s');

    // Mostrar la fecha y la hora formateadas en la página web.
    echo "Hoy es $fechaFormateada y son las $horaFormateada";
    ?>
    <br>
    <a href="index-independiente.php">Sulución con independencia del servidor</a>
    <br>
    <a href="index-strftime.php">Sulución con strftime (Apuntes)</a>
    <br>
    <a href="../Ejemplo1/index.php">Funciones de Fecha</a>
    <br>
    <a href="../Ejemplo2/index.php">Variables especiales de PHP</a>
    <br>
    <a href="../Ejemplo3/index.php">Condicionales</a>
</body>

</html>