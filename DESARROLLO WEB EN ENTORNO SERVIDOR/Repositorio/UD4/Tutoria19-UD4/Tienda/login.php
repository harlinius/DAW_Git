<?php
session_start();
require_once 'conexion.php';

// Función para manejar errores y redireccionar
function error($mensaje)
{
    $_SESSION['error'] = $mensaje;
    header('Location: login.php');
    exit();
}

// Verificar si el formulario fue enviado
if (isset($_POST['login'])) {
    $nombre = trim($_POST['usuario']);
    $pass = trim($_POST['pass']);

    // Validar que los campos no estén vacíos
    if (strlen($nombre) == 0 || strlen($pass) == 0) {
        error("Error: El nombre de usuario o la contraseña no pueden estar vacíos o contener solo espacios en blanco.");
    }

    // Cifrar la contraseña con SHA-256
    $pass1 = hash('sha256', $pass);

    // Consulta SQL para verificar credenciales
    $consulta = "SELECT * FROM usuarios WHERE usuario = :u AND pass = :p";
    try {
        $stmt = $conProyecto->prepare($consulta);
        $stmt->execute([
            ':u' => $nombre,
            ':p' => $pass1
        ]);

        // Verificar si el usuario existe
        if ($stmt->rowCount() == 0) {
            error("Error: Nombre de usuario o contraseña incorrectos.");
        }

        // Usuario validado, crear sesión
        $_SESSION['nombre'] = $nombre;
        header('Location: listado.php');
        exit();
    } catch (PDOException $ex) {
        error("Error en la consulta a la base de datos: " . $ex->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- FontAwesome CDN -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
          integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
</head>
<body style="background-color:silver;">
    <div class="container mt-5">
        <div class="d-flex justify-content-center">
            <div class="card">
                <div class="card-header text-center">
                    <h3>Login</h3>
                </div>
                <div class="card-body">
                    <!-- Formulario de Login -->
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Usuario" name="usuario" required>
                        </div>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" class="form-control" placeholder="Contraseña" name="pass" required>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Login" class="btn btn-success btn-block" name="login">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Mostrar mensaje de error si existe -->
        <?php if (isset($_SESSION['error'])): ?>
            <div class="mt-3 text-danger font-weight-bold text-center">
                <?php
                echo $_SESSION['error'];
                unset($_SESSION['error']);
                ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
