<?php
session_start();
require 'funciones.php';

if (isset($_GET['id'])) {
    $id_cita = $_GET['id'];
    $cita = obtenerCitaPorId($id_cita);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nueva_fecha = htmlspecialchars(trim($_POST['fecha_cita']));
    $nueva_hora = htmlspecialchars(trim($_POST['hora_cita']));

    //Generamos el mensaje de error
    $mensaje .= validarDia($fecha_cita) ? "" : "<p class='alert alert-danger mt-2' role='alert'>El día escogido no se encuentra disponible.</p>";
    $mensaje .= validarHora($hora_cita) ? "" : "<p class='alert alert-danger mt-2' role='alert'>La hora escogida no se encuentra disponible.</p>";

    if ($mensaje == "") {
        reprogramarCita($_POST['id_cita'], $nueva_fecha, $nueva_hora);
        header("Location: index.php");
        exit();
    } else {
        echo $mensaje;
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reprogramar Cita</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body class="m-2">
    <div class="container mt-5">
        <h1>Reprogramar Cita</h1>
        <form method="post" action="reprogramar.php" class="mt-4">
            <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
            <input type="hidden" name="id_cita" value="<?php echo $cita['id']; ?>">
            <div class="form-group">
                <label>Nueva Fecha</label>
                <input type="date" name="fecha_cita" value="<?php echo $cita['fecha']; ?>" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Nueva Hora</label>
                <input type="time" name="hora_cita" value="<?php echo $cita['hora']; ?>" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-warning">Reprogramar</button>
        </form>
    </div>
</body>

</html>