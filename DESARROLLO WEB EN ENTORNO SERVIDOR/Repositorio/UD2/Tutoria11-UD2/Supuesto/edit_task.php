<?php
include 'functions.php';

$id = $_GET['id'];
$tarea = obtenerTareaPorId($id);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Procesamos los datos enviados
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $prioridad = $_POST['prioridad'];
    $fecha = $_POST['fecha'];

    actualizarTarea($id, $nombre, $descripcion, $prioridad, $fecha); // Actualizamos la tarea
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Tarea</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="m-2">
    <h1>Editar Tarea</h1>
    <form method="POST">
        <label class="form-label">Nombre: <input class="form-control" type="text" name="nombre" value="<?php echo $tarea['nombre']; ?>" required></label><br>
        <label class="form-label">Descripción: <textarea class="form-control" name="descripcion" required><?php echo $tarea['descripcion']; ?></textarea></label><br>
        <label class="form-label">Prioridad:
            <select class="form-select" name="prioridad">
                <option value="Alta" <?php if ($tarea['prioridad'] == 'Alta') echo 'selected'; ?>>Alta</option>
                <option value="Media" <?php if ($tarea['prioridad'] == 'Media') echo 'selected'; ?>>Media</option>
                <option value="Baja" <?php if ($tarea['prioridad'] == 'Baja') echo 'selected'; ?>>Baja</option>
            </select>
        </label><br>
        <label>Fecha de Entrega: <input class="form-control" type="date" name="fecha" value="<?php echo $tarea['fecha']; ?>" required></label><br>
        <button class="btn btn-primary m-2" type="submit">Guardar Cambios</button>
    </form>
</body>
</html>
