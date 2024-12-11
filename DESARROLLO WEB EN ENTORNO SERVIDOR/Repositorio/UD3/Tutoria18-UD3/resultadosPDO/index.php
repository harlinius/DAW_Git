<?php

// Configuración de conexión a la base de datos
$host = "localhost"; // Dirección del servidor de base de datos
$db = "proyecto";    // Nombre de la base de datos
$user = "gestor";    // Nombre de usuario
$pass = "secreto";   // Contraseña del usuario

// Data Source Name (DSN), incluye información necesaria para conectar
$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

try {
    // Crear la conexión PDO
    $conProyecto = new PDO($dsn, $user, $pass);

    // Configurar el modo de error para que lance excepciones
    $conProyecto->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "<p>Conexión exitosa a la base de datos.</p>";

    $resultado = $conProyecto->query("SELECT producto, unidades FROM stocks");
    while ($registro = $resultado->fetch()) {
        var_dump($registro);
        echo "<br>";
        echo "Producto: " . $registro['producto'] . " - Unidades: " . $registro['unidades'] . "<br>";
    }

    echo "<hr>";

    $resultado = $conProyecto->query("SELECT producto, unidades FROM stocks");
    while ($registro = $resultado->fetch(PDO::FETCH_OBJ)) {
        var_dump($registro);
        echo "<br>";
        echo "Producto: " . $registro->producto . " - Unidades: " . $registro->unidades . "<br>";
    }

    echo "<hr>";

    $resultado = $conProyecto->query("SELECT producto, unidades FROM stocks");
    $resultado->bindColumn(1, $producto);
    $resultado->bindColumn(2, $unidades);
    while ($resultado->fetch(PDO::FETCH_BOUND)) {
        echo "<br> Producto: " . $producto . " - Unidades: " . $unidades . "<br>";
    }

    echo "<hr>";

    $resultado = $conProyecto->query("SELECT producto, unidades FROM stocks");
    var_dump($resultado);

    // Verificar si se obtuvieron resultados
    if ($resultado) {
        // Iterar sobre las filas obtenidas y mostrarlas
        foreach ($resultado as $fila) {
            //Devuelve array asociativo y numérico
            var_dump($fila);
            echo "<p>Producto: {$fila['producto']}, Unidades: {$fila['unidades']}</p>";
        }
    } else {
        echo "<p>No se encontraron resultados en la consulta.</p>";
    }

    echo "<hr>";

    //Sí, si no utilizas fetchAll() al obtener datos con PDO, los resultados se van obteniendo secuencialmente uno por uno, en lugar de cargarse todos de golpe en memoria. Esto ocurre cuando usas métodos como fetch() o iteradores sobre el objeto PDOStatement.
    $resultado = $conProyecto->query("SELECT producto, unidades FROM stocks");
    $datos = $resultado->fetchAll(PDO::FETCH_ASSOC);
    var_dump($datos);
    foreach ($datos as $fila) {
        echo $fila['producto'] . " " . $fila['unidades'] . "<br>";
    }
} catch (PDOException $e) {
    // Manejo de errores: Mostrar mensaje en caso de fallo
    echo "<p>Error en la conexión o consulta: " . $e->getMessage() . "</p>";
} finally {
    // Cerrar conexión explícitamente
    $conProyecto = null;
    echo "<p>Conexión cerrada.</p>";
}
