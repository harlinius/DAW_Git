<?php
include 'funciones_usuario.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];
    $nombre = $_POST['nombre'];

    if (registrarUsuario($usuario, $password, $nombre)) {
        header("Location: perfil.php");
        exit();
    } else {
        $error = "El usuario ya existe.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Registrar Usuario</h1>
        <?php if (isset($error)) { ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php } ?>
        <form method="POST" action="registro.php">
            <div class="form-group">
                <label>Usuario</label>
                <input type="text" name="usuario" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Contraseña</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Nombre</label>
                <input type="text" name="nombre" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Registrar</button>
        </form>
    </div>
</body>
</html>
