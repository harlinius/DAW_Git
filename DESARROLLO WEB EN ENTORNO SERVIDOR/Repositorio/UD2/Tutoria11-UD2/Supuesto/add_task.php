<?php
include 'functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recibimos y procesamos los datos del formulario
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $prioridad = $_POST['prioridad'];
    $fecha = $_POST['fecha'];

    agregarTarea($nombre, $descripcion, $prioridad, $fecha); // Llamamos a la función para agregar la tarea
    header('Location: index.php'); // Redireccionamos a la página principal
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Tarea</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="m-2">
    <h1>Agregar Nueva Tarea</h1>
    <form method="POST">
        <label class="form-label">Nombre: <input class="form-control" type="text" name="nombre" required></label><br>
        <label class="form-label">Descripción: <textarea class="form-control" name="descripcion" required></textarea></label><br>
        <label class="form-label">Prioridad:
            <select name="prioridad" class="form-select">
                <option value="Alta">Alta</option>
                <option value="Media">Media</option>
                <option value="Baja">Baja</option>
            </select>
        </label><br>
        <label class="form-label">Fecha de Entrega: <input class="form-control" type="date" name="fecha" required></label><br>
        <button class="btn btn-primary m-2" type="submit">Guardar</button>
    </form>
</body>
</html>
