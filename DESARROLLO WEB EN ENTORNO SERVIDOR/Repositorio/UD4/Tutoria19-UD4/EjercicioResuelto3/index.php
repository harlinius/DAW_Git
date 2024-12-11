<?php
// Si el usuario no se ha autenticado, pedimos las credenciales
if (!isset($_SERVER['PHP_AUTH_USER'])) {
    header("WWW-Authenticate: Basic realm='Contenido restringido'");
    header("HTTP/1.0 401 Unauthorized");
    die("Acceso denegado.");
}

// Conexión a la base de datos 'proyecto'
$host = "localhost";
$db = "proyecto";
$user = "gestor";
$pass = "secreto";
$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

try {
    $conProyecto = new PDO($dsn, $user, $pass);
    $conProyecto->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $ex) {
    die("Error en la conexión a la base de datos: " . $ex->getMessage());
}

// Consulta SQL para validar usuario y contraseña
$consulta = "SELECT * FROM usuarios WHERE usuario=:u AND pass=:p";
$stmt = $conProyecto->prepare($consulta);
$password = hash('sha256', $_SERVER['PHP_AUTH_PW']); // Hash de la contraseña

try {
    $stmt->execute([
        ':u' => $_SERVER['PHP_AUTH_USER'],
        ':p' => $password
    ]);
} catch (PDOException $ex) {
    $conProyecto = null;
    die("Error al recuperar los datos de MySQL: " . $ex->getMessage());
}

// Verificamos si la consulta devuelve filas (credenciales incorrectas)
if ($stmt->rowCount() == 0) {
    header("WWW-Authenticate: Basic realm='Contenido restringido'");
    header("HTTP/1.0 401 Unauthorized");
    $stmt = null;
    $conProyecto = null;
    die("Credenciales incorrectas.");
}
$stmt = null;
$conProyecto = null;

// Configuración de fecha y hora en castellano
setlocale(LC_ALL, 'es_ES.UTF-8');
date_default_timezone_set('Europe/Madrid');

// Fecha y hora actual
$ahora = new DateTime();
$fecha = strftime("Tu última visita fue el %A, %d de %B de %Y a las %H:%M:%S", $ahora->getTimestamp());

// Comprobar si existe la cookie y recuperar su valor
if (isset($_COOKIE[$_SERVER['PHP_AUTH_USER']])) {
    $mensaje = $_COOKIE[$_SERVER['PHP_AUTH_USER']];
} else {
    $mensaje = "Es la primera vez que visitas la página.";
}

// Actualizar la cookie con la nueva fecha de acceso (duración: 1 semana)
setcookie($_SERVER['PHP_AUTH_USER'], $fecha, time() + 7 * 24 * 60 * 60);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cookies</title>
    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body style="background: gainsboro;">

<p class="float-left m-3">
    <?php echo htmlspecialchars($mensaje); ?>
</p>

<h4 class="mt-3 text-center font-weight-bold">Ejercicio Apartado 2 Unidad 4</h4>

<div class="container mt-3">
    <div class="row">
        <div class="col-md-4 font-weight-bold">Nombre Usuario:</div>
        <div class="col-md-4"><?php echo htmlspecialchars($_SERVER['PHP_AUTH_USER']); ?></div>
    </div>
    <div class="row mt-2">
        <div class="col-md-4 font-weight-bold">Password Usuario (SHA-256):</div>
        <div class="col-md-4"><?php echo htmlspecialchars(hash('sha256', $_SERVER['PHP_AUTH_PW'])); ?></div>
    </div>
</div>

</body>
</html>
