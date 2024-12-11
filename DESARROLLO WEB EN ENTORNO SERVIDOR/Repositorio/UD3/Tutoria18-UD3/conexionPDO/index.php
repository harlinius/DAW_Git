<?php

// Configuración de conexión a la base de datos
$host = "localhost"; // Dirección del servidor de base de datos (en este caso, local)
$db = "proyecto";    // Nombre de la base de datos
$user = "gestor";    // Nombre de usuario para la conexión
$pass = "secreto";   // Contraseña del usuario
// Cadena de conexión (DSN), incluye tipo de base de datos, host, nombre de la base de datos y codificación de caracteres
$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

//Control de errores
try {
    // Creación de una nueva conexión PDO a la base de datos
    $conProyecto = new PDO($dsn, $user, $pass);
    
    // Obtención de la versión del servidor de base de datos
    $version = $conProyecto->getAttribute(PDO::ATTR_SERVER_VERSION);
    echo "Versión del servidor: $version"; // Muestra la versión del servidor

    // Configuración de atributos adicionales para la conexión PDO
    // Convierte los nombres de las columnas devueltas en los resultados a mayúsculas
    $conProyecto->setAttribute(PDO::ATTR_CASE, PDO::CASE_UPPER);
    // Configura el modo de error para que se lancen excepciones en caso de fallos
    $conProyecto->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    // Captura y maneja cualquier error de conexión o configuración
    echo "Error al conectar con la base de datos: " . $e->getMessage();
} finally {
    // Cierre explícito de la conexión a la base de datos
    $conProyecto = null; // Esto libera los recursos asociados a la conexión
}
