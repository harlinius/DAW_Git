<?php
session_start();

// inicializo la agenda en la session
if (!isset($_SESSION['agenda'])) {
    $_SESSION['agenda'] = [];
}

// inicializo la advertencia
$mensaje = "";

// se procesa el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verificar si se intenta vaciar la agenda
    if (isset($_POST['limpiar'])) {
        $_SESSION['agenda'] = [];
    } else {
        $nombre = trim($_POST['nombre']);
        $telefono = trim($_POST['telefono']);
        //uso trim para eliminar los espacios innecesarios por si el usuario mete alguno 

        // valido si el nombre está vacío
        if (empty($nombre)) {
            $mensaje = "El nombre es obligatorio.";
        } else {
            // si el nombre ya existe
            if (isset($_SESSION['agenda'][$nombre])) {
                if (!empty($telefono)) {
                    // actualizo el numero de tfno
                    $_SESSION['agenda'][$nombre] = $telefono;
                    $mensaje = "El número de teléfono ha sido actualizado.";
                } else {
                    // elimino el contacto si no se indica tfno y se da nombre
                    unset($_SESSION['agenda'][$nombre]);
                    $mensaje = "El contacto '$nombre' ha sido eliminado.";
                }
            } else {

                if (!empty($telefono)) { // si el nombre no existe y hay teléfono, añade el contacto a la agenda
                    $_SESSION['agenda'][$nombre] = $telefono;
                    $mensaje = "El contacto ha sido añadido a la agenda.";
                } else { //si el nombre no existe y no hay teléfono da la advertencia
                    $mensaje = "Debes proporcionar un número de teléfono.";
                }
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <title>Agenda</title>
</head>

<body>
    <div style="width: 40%; height: 40%; margin: auto; font-family: 'Montserrat', sans-serif;">
        <h1 style="text-align: center;">Agenda</h1>

        <!-- Uso fieldset para agrupar los campos para que quede parecido al ejemplo del enunciado. legend es la etiqueta del texto que sobresale. -->

        <!-- advertencia -->
        <?php if (!empty($mensaje)): ?>
            <p style="color: red; font-weight: bold;"><?php echo $mensaje; ?></p>
        <?php endif; ?>

        <!-- agenda -->
        <fieldset>
            <legend>Datos Agenda</legend>
            <?php if (!empty($_SESSION['agenda'])): ?>
                <?php foreach ($_SESSION['agenda'] as $nombre => $telefono): ?>
                    <p><b><a href="#"><?php echo htmlspecialchars($nombre); ?></a></b> <?php echo htmlspecialchars($telefono); ?></p>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No hay contactos en la agenda.</p>
            <?php endif; ?>
        </fieldset>

        <!-- form para añadir/actualizar contactos -->
        <fieldset>
            <legend>Nuevo Contacto</legend>
            <form method="post" action="">
                <label><b>Nombre:</b></label>
                <input type="text" name="nombre" />
                <br>
                <label><b>Teléfono:</b></label>
                <input type="number" name="telefono" />
                <br><br>
                <button type="submit">Añadir Contacto</button>
                <button type="reset">Limpiar Campos</button>
            </form>
        </fieldset>

        <!-- para vaciar la agenda, si hay contactos -->
        <?php if (!empty($_SESSION['agenda'])): ?>
            <fieldset>
                <legend>Vaciar Agenda</legend>
                <form method="post" action="">
                    <button type="submit" name="limpiar">Vaciar</button>
                </form>
            </fieldset>
        <?php endif; ?>
    </div>
</body>

</html>