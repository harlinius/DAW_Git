<?php

//GESTION DE ERRORES
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
//$resultado = $dividendo / $divisor;
error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT);

set_error_handler("miGestorDeErrores");
//$resultado = $dividendo / $divisor;
//restore_error_handler(); // Restaura el manejador original

function miGestorDeErrores($nivel, $mensaje, $archivo, $linea)
{
    echo "<p>Error detectado:</p>";
    echo "<ul>";
    echo "<li>Nivel: $nivel</li>";
    echo "<li>Mensaje: $mensaje</li>";
    echo "<li>Archivo: $archivo</li>";
    echo "<li>Línea: $linea</li>";
    echo "</ul>";

    switch ($nivel) {
        case E_WARNING:
            echo "Error de tipo WARNING: $mensaje.<br />";
            break;
        default:
            echo "Error desconocido: $mensaje.<br />";
    }
}

//GESTIÓN DE EXCEPCIONES
try {
    if ($divisor == 0) {
        throw new Exception("División por cero.");
    }
    $resultado = $dividendo / $divisor;
} catch (Exception $e) {
    echo "Se ha producido el siguiente error: " . $e->getMessage();
}

echo "<hr>";

$host = "localhost";
$db = "proyecto";
$user = "gestor";
$pass = "1234";
$dsn = "mysql:host=$host;dbname=$db";
try {
    $conProyecto = new PDO($dsn, $user, $pass);
    $conProyecto->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $ex) {
    die("Error en la conexión: " . $ex->getMessage());
}