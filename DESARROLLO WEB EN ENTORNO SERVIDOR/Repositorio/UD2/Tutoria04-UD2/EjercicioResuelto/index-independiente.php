<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Condicionales</title>
</head>

<body style="background-color: antiquewhite">
    <?php
    // Definir la zona horaria a la de Madrid para la correcta visualización de la hora.
    date_default_timezone_set('Europe/Madrid');

    // Crear un objeto DateTime con la fecha y hora actual.
    $ahora = new DateTime();

    // Arrays con los días de la semana y los meses en español.
    $dias_semana = ["domingo", "lunes", "martes", "miércoles", "jueves", "viernes", "sábado"];
    $meses = ["enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre"];
    
    // Obtener el nombre del día y del mes en español.
    $dia = $dias_semana[$ahora->format('w')]; //Accedo por el índice (en el caso de jueves -> 4)
    $dia_num = $ahora->format('d');
    $mes = $meses[$ahora->format('n') - 1]; //Accedo por el índice (en el caso de octubre -> 9)
    $anio = $ahora->format('Y');
    $hora = $ahora->format('H:i:s');

    // Construir la cadena de fecha en español.
    $fecha = "Hoy es $dia, $dia_num de $mes de $anio y son las $hora";

    // Mostrar la fecha formateada en la página web.
    echo $fecha;
    ?>
    <br>
    <a href="index.php">Sulución con intl (Internationalization)</a>
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