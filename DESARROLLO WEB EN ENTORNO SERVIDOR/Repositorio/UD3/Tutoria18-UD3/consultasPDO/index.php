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

    // NO DEVUELVE RESULTADOS (exec): Ejecutar consulta de inserción
    $registros = $conProyecto->exec('INSERT INTO stocks (producto, tienda, unidades) VALUES ("21", "3", "0"), ("1", "3", "0")');
    echo "<p>Se han añadido $registros registros.</p>";

    // NO DEVUELVE RESULTADOS: Ejecutar consulta de eliminación
    $registros = $conProyecto->exec('DELETE FROM stocks WHERE unidades = 0');
    echo "<p>Se han borrado $registros registros.</p>";

    // DEVUELVE RESULTADOS: Ejecutar consulta de selección
    $resultado = $conProyecto->query("SELECT producto, unidades FROM stocks");
    var_dump($resultado);

    echo "<br>";

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

} catch (PDOException $e) {
    // Manejo de errores: Mostrar mensaje en caso de fallo
    echo "<p>Error en la conexión o consulta: " . $e->getMessage() . "</p>";
} finally {
    // Cerrar conexión explícitamente
    $conProyecto = null;
    echo "<p>Conexión cerrada.</p>";
}
