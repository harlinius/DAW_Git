<?php
$host = "localhost";
$db = "proyecto";
$user = "gestor";
$pass = "secreto";
$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

try {
    // Crear conexión usando PDO
    $conProyecto = new PDO($dsn, $user, $pass);
    $conProyecto->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $ex) {
    die("Error en la conexión: " . $ex->getMessage());
}

/**
 * Función para consultar un producto por ID
 * @param int $id
 * @return object|null
 */
function consultarProducto($id) {
    global $conProyecto;
    $consulta = "SELECT * FROM productos WHERE id = :id";
    $stmt1 = $conProyecto->prepare($consulta);
    try {
        $stmt1->execute([':id' => $id]); // Parámetro corregido con "=" en lugar de ">"
    } catch (PDOException $ex) {
        die("Error al recuperar productos: " . $ex->getMessage());
    }
    // Devuelve una sola fila (objeto)
    $producto = $stmt1->fetch(PDO::FETCH_OBJ);
    $stmt1 = null; // Cierra el statement
    return $producto;
}

/**
 * Función para cerrar la conexión
 * @param PDO &$con
 */
function cerrar(&$con) {
    $con = null;
}

/**
 * Función para cerrar la conexión y el statement
 * @param PDO &$con
 * @param PDOStatement &$st
 */
function cerrarTodo(&$con, &$st) {
    $st = null;
    $con = null;
}
?>
