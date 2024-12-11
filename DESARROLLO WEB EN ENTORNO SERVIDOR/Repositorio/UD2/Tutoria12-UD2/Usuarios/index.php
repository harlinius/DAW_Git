<?php
include 'funciones_usuario.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Página Principal</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Bienvenido al Sistema</h1>
        <?php if (esUsuarioAutenticado()) { ?>
            <p>Has iniciado sesión como <?= htmlspecialchars($_SESSION['usuario']['nombre']); ?>.</p>
            <a href="perfil.php" class="btn btn-primary">Ir a Perfil</a>
            <a href="logout.php" class="btn btn-danger">Cerrar Sesión</a>
        <?php } else { ?>
            <a href="login.php" class="btn btn-primary">Iniciar Sesión</a>
            <a href="registro.php" class="btn btn-secondary">Registrarse</a>
        <?php } ?>
    </div>
</body>
</html>
