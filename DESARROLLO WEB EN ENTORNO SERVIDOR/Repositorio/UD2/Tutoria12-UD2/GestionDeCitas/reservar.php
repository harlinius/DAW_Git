<?php
session_start();
require 'funciones.php';

$nombre_paciente = "";
$fecha_cita = "";
$hora_cita = "";
$motivo = "";
$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_paciente = htmlspecialchars(trim($_POST['nombre_paciente']));
    $fecha_cita = htmlspecialchars(trim($_POST['fecha_cita']));
    $hora_cita = htmlspecialchars(trim($_POST['hora_cita']));
    $motivo = htmlspecialchars(trim($_POST['motivo']));
    
    //Generamos el mensaje de error
    $mensaje .= validarDia($fecha_cita) ? "" : "<p class='alert alert-danger mt-2' role='alert'>El día escogido no se encuentra disponible.</p>";
    $mensaje .= validarHora($hora_cita) ? "" : "<p class='alert alert-danger mt-2' role='alert'>La hora escogida no se encuentra disponible.</p>";
    $mensaje .= !empty($nombre_paciente) ? "" : "<p class='alert alert-danger mt-2' role='alert'>El nombre del paciente es obligatorio para reservar una cita.</p>";
    $mensaje .= !empty($motivo) ? "" : "<p class='alert alert-danger mt-2' role='alert'>El motivo de consulta es obligatorio para reservar una cita.</p>";

    if ($mensaje == "") {
        agregarCita($nombre_paciente, $fecha_cita, $hora_cita, $motivo);
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
    <title>Reservar Cita</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body class="m-2">
    <div class="container mt-5">
        <h1>Reservar una Nueva Cita</h1>
        <form method="post" action="reservar.php" class="mt-4">
            <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
            <div class="form-group">
                <label>Nombre del Paciente</label>
                <input type="text" name="nombre_paciente" class="form-control" value="<?= $nombre_paciente ?>" required>
            </div>
            <div class="form-group">
                <label>Fecha de la Cita</label>
                <input type="date" name="fecha_cita" class="form-control" value="<?= $fecha_cita ?>" required>
            </div>
            <div class="form-group">
                <label>Hora de la Cita</label>
                <input type="time" name="hora_cita" class="form-control" value="<?= $hora_cita ?>" required>
            </div>
            <div class="form-group">
                <label>Motivo</label>
                <textarea name="motivo" class="form-control" required><?= $motivo ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Reservar Cita</button>
        </form>
    </div>
</body>

</html>