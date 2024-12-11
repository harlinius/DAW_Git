<?php
// Comprobar si no se ha enviado el usuario y la contraseña
if (!isset($_SERVER['PHP_AUTH_USER'])) {
    // Enviar las cabeceras HTTP para solicitar autenticación
    header('WWW-Authenticate: Basic Realm="Contenido restringido"');
    header('HTTP/1.0 401 Unauthorized');
    readfile('401.html'); // Incluye el contenido de 401.html
    exit; // No mostramos ningún mensaje adicional
}

// Credenciales correctas
$usuario_correcto = "gestor";
$contrasena_correcta = "secreto";

// Comprobar las credenciales
if ($_SERVER['PHP_AUTH_USER'] === $usuario_correcto && $_SERVER['PHP_AUTH_PW'] === $contrasena_correcta) {
    echo "Bienvenido, " . htmlspecialchars($_SERVER['PHP_AUTH_USER']) . "!";
} else {
    // Si las credenciales son incorrectas, generar el error 401
    header('WWW-Authenticate: Basic Realm="Contenido restringido"');
    header('HTTP/1.0 401 Unauthorized');
    readfile('401.html'); // Incluye el contenido de 401.html    exit; // El servidor usará la página configurada con ErrorDocument 401
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privado</title>
</head>
<body>
    <h1>Bienvenid@ al Área pública</h1> 
    <a href="private/">Ir al Área restringida.</a>
    <br>
    <a href="EjercicioResuelto1/">Ejercicio resuelto 1.</a>
    <br>
    <a href="EjercicioResuelto2/">Ejercicio resuelto 2.</a>
</body>
</html>