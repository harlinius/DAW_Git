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

    //Pasar valores utilizando ?
    $stmt = $conProyecto->prepare('INSERT INTO familias (cod, nombre) VALUES (?, ?)');
    $cod_producto = "TABLET";
    $nombre_producto = "Tablet PC";
    $stmt->bindParam(1, $cod_producto);
    $stmt->bindParam(2, $nombre_producto);
    $stmt->execute();

    //Pasar valores utilizando un nombre
    $stmtNombre = $conProyecto->prepare('INSERT INTO familias (cod, nombre) VALUES (:cod, :nombre)');
    $cod_producto = "TAB2";
    $nombre_producto = "Tablet PC2";
    $stmtNombre->bindParam(":cod", $cod_producto);
    $stmtNombre->bindParam(":nombre", $nombre_producto);
    $stmtNombre->execute();

    //Pasar valores con execute directamente
    $nombre = "Monitores";
    $codigo = "MONI";
    $stmt = $conProyecto->prepare('INSERT INTO familias (cod, nombre) VALUES (:cod, :nombre)');
    $stmt->execute([':cod' => $codigo, ':nombre' => $nombre]);
} catch (PDOException $e) {
    // Manejo de errores: Mostrar mensaje en caso de fallo
    echo "<p>Error en la conexión o consulta: " . $e->getMessage() . "</p>";
} finally {
    // Cerrar conexión explícitamente
    $conProyecto = null;
    echo "<p>Conexión cerrada.</p>";
}
