<?php
// Conexión directa al crear la instancia EJEMPLO 1
$conProyecto = new mysqli('localhost', 'gestor', 'secreto', 'proyecto');  
print $conProyecto->server_info;

$conProyecto->close();

// Crear la instancia primero y luego conectar EJEMPLO 2
$conProyecto = new mysqli();
$conProyecto->connect('localhost', 'gestor', 'secreto', 'proyecto');
print $conProyecto->server_info;

$conProyecto->close();

// Usar funciones para conectar EJEMPLO 3
$conProyecto = mysqli_connect('localhost', 'gestor', 'secreto', 'proyecto');
print $conProyecto->server_info;

$conProyecto->close();

// Comprobar Errores de Conexión
@$conProyecto = new mysqli('localhost', 'gestor', 'secreto', 'proyecto');

if ($conProyecto->connect_errno != null) {
    echo "<p>Error {$conProyecto->connect_errno} conectando a la base de datos: {$conProyecto->connect_error}</p>";
    die();
}  

$conProyecto->close();

//MEJOR x2
try {
    @$conProyecto = new mysqli('localhost', 'gestr', 'secreto', 'proyecto');
    if ($conProyecto->connect_error) {
        throw new Exception("Error conectando a la base de datos: {$conProyecto->connect_error}");
    }
} catch (Exception $e) {
    echo "<br><h1>";
    echo($e->getMessage()); // Muestra el error por pantalla
    echo "</h1><br>";
    die("Error al conectar con la base de datos. Por favor, intentalo de nuevo más tarde.");//Exit() con salida de texto
}
