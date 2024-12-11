<?php
include 'functions.php'; // Incluimos el fichero php de funciones

$tareas = obtenerTareas(); // Obtenemos las tareas almacenadas en la sesión
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Gestión de Tareas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="m-2">
    <div class="border border-secondary p-2 bg-info-subtle">
        <h1 class="text-primary-emphasis">Enunciado</h1>
        <p><strong>
            Imagina que trabajas en una pequeña empresa que necesita gestionar las tareas asignadas a cada empleado de manera organizada. Tu objetivo es construir una aplicación web que permita añadir, visualizar, modificar y eliminar tareas mediante formularios web y PHP. Este ejercicio integrará las principales características de PHP que has aprendido.
        </strong></p>
    </div>
    <h1>Lista de Tareas</h1>
    <a class="btn btn-primary" href="add_task.php">Agregar Nueva Tarea</a>
    <a class="btn btn-danger" href="close.php">Cerrar sesión</a>
    <?php if ($tareas != []) { ?>
        <table class="table table-striped table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Prioridad</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- Bucle que recorre cada tarea en el array $tareas para mostrarlas en la tabla -->
                <?php foreach ($tareas as $tarea) { ?>
                    <tr>
                        <td><?php echo $tarea['id']; ?></td>
                        <td><?php echo $tarea['nombre']; ?></td>
                        <td><?php echo $tarea['descripcion']; ?></td>
                        <td><?php echo $tarea['prioridad']; ?></td>
                        <td><?php echo $tarea['fecha']; ?></td>
                        <td>
                            <!-- Botones para editar/eliminar la tarea, pasando el ID de la tarea -->
                            <a href="edit_task.php?id=<?php echo $tarea['id']; ?>" class="btn btn-sm btn-primary">Editar</a>
                            <a href="delete_task.php?id=<?php echo $tarea['id']; ?>" class="btn btn-sm btn-danger">Eliminar</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <div class="alert alert-warning mt-2" role="alert">
            No hay tareas creadas.
        </div>
    <?php } ?>
</body>

</html>