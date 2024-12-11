<?php
// Iniciamos sesión para almacenar información del usuario
session_start();

// Si el usuario no está autenticado, solicitamos las credenciales
if (!isset($_SERVER['PHP_AUTH_USER'])) {
    header("WWW-Authenticate: Basic realm='Contenido restringido'");
    header("HTTP/1.0 401 Unauthorized");
    die("Acceso no autorizado");
}

// Si la sesión no existe, verificamos las credenciales
if (!isset($_SESSION['usuario'])) {
    // Parámetros de conexión a la base de datos
    $host = "localhost";
    $db = "proyecto";
    $user = "gestor";
    $pass = "secreto";
    $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

    try {
        // Establecer la conexión a la base de datos
        $conProyecto = new PDO($dsn, $user, $pass);
        $conProyecto->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $ex) {
        die("Error en la conexión: " . $ex->getMessage());
    }

    // Consulta para verificar usuario y contraseña
    $consulta = "SELECT * FROM usuarios WHERE usuario=:u AND pass=:p";
    $stmt = $conProyecto->prepare($consulta);
    $password = hash('sha256', $_SERVER['PHP_AUTH_PW']);

    try {
        $stmt->execute([
            ':u' => $_SERVER['PHP_AUTH_USER'],
            ':p' => $password
        ]);
    } catch (PDOException $ex) {
        $conProyecto = null;
        die("Error en la consulta: " . $ex->getMessage());
    }

    // Verificamos si la consulta devuelve filas
    if ($stmt->rowCount() == 0) {
        header("WWW-Authenticate: Basic realm='Contenido restringido'");
        header("HTTP/1.0 401 Unauthorized");
        $stmt = null;
        $conProyecto = null;
        die("Credenciales incorrectas");
    }

    // Credenciales correctas, iniciamos sesión
    $_SESSION['usuario'] = $_SERVER['PHP_AUTH_USER'];
    $stmt = null;
    $conProyecto = null;
}

// Si ya está autenticado, configuramos la fecha de visita
setlocale(LC_ALL, 'es_ES.UTF-8');
date_default_timezone_set('Europe/Madrid');
$ahora = new DateTime();
$fecha = strftime("Tu última visita fue el %A, %d de %B de %Y a las %H:%M:%S", $ahora->getTimestamp());

// Si se envía el formulario para limpiar el registro
if (isset($_POST['limpiar'])) {
    unset($_SESSION['visita']);
} else {
    $_SESSION['visita'][] = $fecha;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejemplo Sesiones</title>
    <!-- CDN de Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body style="background:gainsboro;">
    <div class="container mt-3">
        <h4 class="text-center font-weight-bold">Ejemplo de Sesiones con PHP</h4>

        <div class="row mt-4">
            <div class="col-md-4 font-weight-bold">Nombre de Usuario:</div>
            <div class="col-md-4"><?php echo htmlspecialchars($_SERVER['PHP_AUTH_USER']); ?></div>
        </div>

        <div class="row mt-2">
            <div class="col-md-4 font-weight-bold">Password Usuario (SHA-256):</div>
            <div class="col-md-4"><?php echo hash('sha256', $_SERVER['PHP_AUTH_PW']); ?></div>
        </div>

        <?php if (!isset($_SESSION['visita'])): ?>
            <p class='text-success font-weight-bold mt-3'>Bienvenido, es tu primera visita.</p>
        <?php else: ?>
            <p class='text-success font-weight-bold mt-3'>Tus anteriores visitas han sido:</p>
            <ul>
                <?php foreach ($_SESSION['visita'] as $fecha): ?>
                    <li><?php echo htmlspecialchars($fecha); ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <!-- Formulario para limpiar el registro de visitas -->
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <input type="submit" name="limpiar" value="Limpiar registro" class="btn btn-warning">
        </form>
    </div>
</body>
</html>
