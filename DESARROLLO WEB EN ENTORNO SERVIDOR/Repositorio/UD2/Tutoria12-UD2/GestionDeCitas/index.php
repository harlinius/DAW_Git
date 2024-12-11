<?php
session_start();
require 'funciones.php';

$citas = obtenerCitas();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema de Reserva de Citas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="m-2">
    <div class="container mt-5">
        <h1 class="mb-4">Reservas de Citas</h1>
        <a href="reservar.php" class="btn btn-primary mb-3">Reservar una Nueva Cita</a>

        <?php if (!empty($citas)) { ?>
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Nombre</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Motivo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($citas as $cita) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($cita['nombre']); ?></td>
                            <td><?php echo htmlspecialchars($cita['fecha']); ?></td>
                            <td><?php echo htmlspecialchars($cita['hora']); ?></td>
                            <td><?php echo htmlspecialchars($cita['motivo']); ?></td>
                            <td>
                                <a href="reprogramar.php?id=<?php echo $cita['id']; ?>" class="btn btn-sm btn-warning">Reprogramar</a>
                                <a href="cancelar.php?id=<?php echo $cita['id']; ?>" class="btn btn-sm btn-danger">Cancelar</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p>No hay citas reservadas.</p>
        <?php } ?>
    </div>
</body>
</html>
