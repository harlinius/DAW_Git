<?php
// Si el usuario no se ha autenticado, pedimos las credenciales
if (!isset($_SERVER['PHP_AUTH_USER'])) {
    header("WWW-Authenticate: Basic realm='Contenido restringido'");
    header("HTTP/1.0 401 Unauthorized");
    die("Autenticación requerida.");
}

// Conexión a la base de datos "proyecto"
$host = "localhost";
$db = "proyecto";
$user = "gestor";
$pass = "secreto";
$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

try {
    $conProyecto = new PDO($dsn, $user, $pass);
    $conProyecto->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $ex) {
    die("Error en la conexión: " . $ex->getMessage());
}

// Consulta para verificar credenciales
$consulta = "SELECT * FROM usuarios WHERE usuario = :u AND pass = :p";
$stmt = $conProyecto->prepare($consulta);

// Encriptamos la contraseña introducida usando SHA256
$password = hash('sha256', $_SERVER['PHP_AUTH_PW']);

try {
    $stmt->execute([
        ':u' => $_SERVER['PHP_AUTH_USER'],
        ':p' => $password
    ]);
} catch (PDOException $ex) {
    $conProyecto = null;
    die("Error al recuperar los datos de MySQL: " . $ex->getMessage());
}

// Si la consulta no devuelve ninguna fila, las credenciales son incorrectas
if ($stmt->rowCount() === 0) {
    header("WWW-Authenticate: Basic realm='Contenido restringido'");
    header("HTTP/1.0 401 Unauthorized");
    $stmt = null;
    $conProyecto = null;
    die("Credenciales incorrectas.");
}

// Cerrar la conexión y liberar el statement
$stmt = null;
$conProyecto = null;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CDN de Bootstrap -->
    <link rel="stylesheet" 
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" 
          crossorigin="anonymous">
    <title>Ejercicio 1.3 Unidad 4</title>
</head>
<body style="background: gainsboro;">
    <h4 class="mt-3 text-center font-weight-bold">Solución Ejercicio</h4>
    <div class='container mt-3'>
        <div class='row mb-3'>
            <div class='col-md-4 font-weight-bold'>
                Nombre de Usuario:
            </div>
            <div class='col-md-8'>
                <?php echo htmlspecialchars($_SERVER['PHP_AUTH_USER']); ?>
            </div>
        </div>
        <div class='row'>
            <div class='col-md-4 font-weight-bold'>
                Password Usuario (sha256):
            </div>
            <div class='col-md-8'>
                <?php echo htmlspecialchars($password); ?>
            </div>
        </div>
    </div>
</body>
</html>
