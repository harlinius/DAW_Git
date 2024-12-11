<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Funciones de Fecha</title>
</head>

<body>
    <?php

    // Ejemplo 1: Creación de un objeto DateTime a partir de una fecha en formato MySQL (Y-m-d)
    $fechaMySql = "2020-12-31"; // Fecha en formato MySQL
    $objetoDateTime = date_create_from_format('Y-m-d', $fechaMySql); // Crea un objeto DateTime a partir de la fecha
    var_dump($objetoDateTime); // Muestra el objeto DateTime creado (donde se guarda la fecha)
    $fechaMySql = "31-12-2024"; // Fecha en formato MySQL
    $objetoDateTime2 = date_create_from_format('d-m-Y', $fechaMySql); // Crea un objeto DateTime a partir de la fecha
    var_dump($objetoDateTime2); // Muestra el objeto DateTime creado (donde se guarda la fecha)
    //print_r($objetoDateTime); //Hace lo mismo, muestra el objeto
    
    // Alternativamente, se puede crear un objeto DateTime más rápido
    $fecha1 = new DateTime("2020-12-31"); // Crea un objeto DateTime directamente
    echo "<br>";
    var_dump($fecha1); // Muestra el objeto DateTime creado
    
    //Fecha y hora actuales
    $fecha2 = new DateTime(); // Crea un objeto DateTime directamente
    echo "<br>";
    var_dump($fecha2); // Muestra el objeto DateTime creado
    
    // Ejemplo 2: Pasar la fecha al formato deseado
    $miFecha = new DateTime(); // Crea un objeto DateTime con la fecha y hora actuales
    $fecha = date_format($miFecha, 'd/m/Y'); // Formatea la fecha al formato 'd/m/Y'
    echo "<br>";
    var_dump($fecha); // Muestra la fecha formateada
    
    // Obtener la marca de tiempo (timestamp) a partir de un objeto DateTime
    $ahora = new DateTime(); // Crea un objeto DateTime con la fecha y hora actuales
    echo "<br>Timestamp: " . date_timestamp_get($ahora); // Muestra el timestamp de la fecha actual
    //Mirar mejor
    
    // Ejemplo 3
// Crea un objeto DateTime para la fecha actual
    $ahora = new DateTime(); // Crea un objeto DateTime con la fecha y hora actuales
    echo "<br>";
    var_dump($ahora); // Muestra el objeto DateTime que representa la fecha actual
    
    // Crea un objeto DateTime para la fecha de ayer
    $ayer = new DateTime("yesterday"); // Crea un objeto DateTime para la fecha de ayer
    echo "<br>";
    var_dump($ayer); // Muestra el objeto DateTime que representa la fecha de ayer
    
    // Crea un objeto DateTime para la fecha del último lunes
    $ultimoLunes = new DateTime("Last Monday"); // Crea un objeto DateTime para la fecha del último lunes
    echo "<br>";
    var_dump($ultimoLunes); // Muestra el objeto DateTime que representa la fecha del último lunes
    
    ?>
</body>

</html>