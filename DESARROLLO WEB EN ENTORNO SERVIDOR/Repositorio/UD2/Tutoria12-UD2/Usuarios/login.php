<?php
include 'funciones_usuario.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    if (autenticarUsuario($usuario, $password)) {
        header("Location: perfil.php");
        exit();
    } else {
        $error = "Nombre de usuario o contraseña incorrectos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Iniciar Sesión</h1>
        <?php if (isset($error)) { ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php } ?>
        <form method="POST" action="login.php">
            <div class="form-group">
                <label>Usuario</label>
                <input type="text" name="usuario" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Contraseña</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
            <a href="registro.php" class="btn btn-link">Registrar Nuevo Usuario</a>
        </form>
    </div>
</body>
</html>
