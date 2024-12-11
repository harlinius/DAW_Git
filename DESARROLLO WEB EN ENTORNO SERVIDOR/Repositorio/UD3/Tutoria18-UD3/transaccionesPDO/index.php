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

    // Iniciar la transacción
    $ok = true; // Indicador para verificar el éxito de las operaciones
    $conProyecto->beginTransaction(); // Inicio de la transacción, desactiva autocommit

    // NO DEVUELVE RESULTADOS: Ejecutar consulta de inserción
    $insertResult = $conProyecto->exec('INSERT INTO stocks (producto, tienda, unidades) VALUES ("21", "3", "0"), ("1", "3", "0")');
    if ($insertResult === false) {
        $ok = false; // Marcar como fallo si no se pudo ejecutar
    }

    // Igualdad (==)
    var_dump(5 == "5");  // true (PHP convierte la cadena "5" en un entero para compararla)
    var_dump(0 == false); // true (PHP convierte `false` en `0` para compararla)

    // Identidad (===)
    var_dump(5 === "5");  // false (los tipos son diferentes: entero vs cadena)
    var_dump(0 === false); // false (los tipos son diferentes: entero vs booleano)
    var_dump(5 === 5);     // true (los valores y tipos coinciden)

    // Primera operación: Eliminar registros con `unidades = 0`
    $deleteResult = $conProyecto->exec('DELETE FROM stocks WHERE unidades = 0');
    if ($deleteResult === false) {
        $ok = false; // Marcar como fallo si no se pudo ejecutar
    }

    // Segunda operación: Actualizar las unidades de un producto específico
    $updateResult = $conProyecto->exec('UPDATE stocks SET unidads = 5 WHERE producto = "PROD123"');
    if ($updateResult === false) {
        $ok = false; // Marcar como fallo si no se pudo ejecutar
    }

    // Verificar el estado de las operaciones
    if ($ok) {
        // Confirmar los cambios si todo fue exitoso
        $conProyecto->commit();
        echo "<p>Transacción completada con éxito. $insertResult registros insertados, $deleteResult registros eliminados, $updateResult registros actualizados.</p>";
    } else {
        // Revertir los cambios en caso de error
        $conProyecto->rollback();
        echo "<p>Transacción revertida debido a un error.</p>";
    }
} catch (PDOException $e) {
    // Manejo de errores: Mostrar mensaje en caso de fallo
    echo "<p>Error en la conexión o consulta: " . $e->getMessage() . "</p>";

    // Revertir transacción si ocurre un error
    if (isset($conProyecto) && $conProyecto->inTransaction()) {
        $conProyecto->rollback();
        echo "<p>Transacción revertida debido a un fallo inesperado.</p>";
    }
} finally {
    // Cerrar conexión explícitamente
    $conProyecto = null;
    echo "<p>Conexión cerrada.</p>";
}
