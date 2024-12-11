<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Funciones relacionadas con los tipos de datos compuestos</title>
</head>

<body>
    <?php
    $a = array();  // array vacío

    print_r($a);
    echo "<br><br>";

    $modulos = array("Programación", "Bases de datos", "Desarrollo web en entorno servidor");   // array numérico
    
    print_r($modulos);
    echo "<br><br>";

    // Añadir un nuevo módulo (sin especificar el índice)
    $modulos[] = "Entornos de desarrollo";

    // Modificar un módulo existente (cambiar "Bases de datos" por "Redes")
    $modulos[1] = "Redes";

    // Mostrar el contenido actualizado del array
    print_r($modulos);
    echo "<br><br>";

    $modulos = array("Programación", "Bases de datos", "Desarrollo web en entorno servidor");

    // Eliminar el primer elemento
    unset($modulos[0]);

    // Mostrar el array después de eliminar un elemento
    print_r($modulos);
    echo "<br><br>";

    $modulos = array("Programación", "Bases de datos", "Desarrollo web en entorno servidor");
    unset($modulos[0]);

    // Reindexar el array para que los índices sean consecutivos
    $modulos = array_values($modulos);

    // Mostrar el array reindexado
    print_r($modulos);
    echo "<br><br>";

    $modulos = array("Programación", "Bases de datos");

    if (is_array($modulos)) {
        echo "La variable \$modulos es un array.<br>";
    } else {
        echo "La variable \$modulos no es un array.<br>";
    }

    $modulos = array("Programación", "Bases de datos", "Desarrollo web en entorno servidor");
    echo "<p>El array tiene " . count($modulos) . " elementos.</p>";

    $modulos = array("Programación", "Bases de datos", "Desarrollo web en entorno servidor");
    $modulo = "Bases de datos";

    if (in_array($modulo, $modulos)) {
        echo "<p>Existe el módulo de nombre $modulo.</p>";
    } else {
        echo "<p>No existe el módulo de nombre $modulo.</p>";
    }

    $modulos = array("Programación", "Bases de datos", "Desarrollo web en entorno servidor");
    $modulo = "Bases de datos";

    $clave = array_search($modulo, $modulos);
    if ($clave !== false) {
        echo "<p>El módulo '$modulo' se encuentra en la posición $clave.</p>";
    } else {
        echo "<p>No se encontró el módulo '$modulo'.</p>";
    }

    $modulos = array("Programación", "Bases de datos", "Desarrollo web en entorno servidor");

    // Comprobar si la clave 1 existe en el array
    if (array_key_exists(1, $modulos)) {
        echo "<p>La clave 1 existe y su valor es: " . $modulos[1] . "</p>";
    } else {
        echo "<p>La clave 1 no existe en el array.</p>";
    }
    ?>
</body>

</html>