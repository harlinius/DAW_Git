<?php
// inicializo la advertencia
$mensaje = "";

// el color de la advertencia cambia dependiendo del tipo del mensaje
$color = "";

// se procesa el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // verifico si se intenta vaciar la agenda
    if (isset($_POST['limpiar'])) {
        $agenda = [];
    } else {
        if (isset($_POST['agenda'])) {
            $agenda = $_POST['agenda'];
        } else {
            $agenda = [];
        }
        
        $nombre = trim($_POST['nombre']);
        $telefono = trim($_POST['telefono']);
        // uso trim para eliminar los espacios innecesarios por si el usuario mete alguno 

        // valido si el nombre está vacío
        if (empty($nombre)) {
            $color = "orange";
            $mensaje = "¡tienes que poner un nombre!";
        } else {
            // si el nombre ya existe
            if (isset($agenda[$nombre])) {
                if (!empty($telefono)) {
                    // actualizo el numero de tfno
                    $agenda[$nombre] = $telefono;
                    $color = "blue";
                    $mensaje = "¡has actualizado el número de '$nombre'!";
                } else {
                    // elimino el contacto si no se indica tfno y se da nombre
                    unset($agenda[$nombre]);
                    $color = "red";
                    $mensaje = "tu contacto '$nombre' ya no está en tu agenda. bye bye!";
                }
            } else {
                if (!empty($telefono)) { // si el nombre no existe y hay teléfono, añade el contacto a la agenda
                    $agenda[$nombre] = $telefono;
                    $color = "green";
                    $mensaje = "¡has añadido a '$nombre'! :D";
                } else { // si el nombre no existe y no hay teléfono da la advertencia
                    $color = "orange";
                    $mensaje = "¡debes poner un número de teléfono!";
                }
            }
        }
    }
} else {
    $agenda = [];
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
        <h1 style="text-align: center; color: purple">๋࣭ ⭑⚝ agenda de contactos</h1>

        <!-- uso fieldset para agrupar los campos para que quede parecido al ejemplo del enunciado. legend es la etiqueta del texto que sobresale. -->

        <!-- advertencia -->
        <?php if (!empty($mensaje)): ?>
            <p style="color: <?php echo $color; ?>; font-weight: bold; text-align: center;"><?php echo $mensaje; ?></p>
        <?php endif; ?>

        <!-- agenda -->
        <fieldset>
            <legend style="text-align: center; color: purple; font-weight: bold"> ✩ tu agenda ✩</legend>
            <?php if (!empty($agenda)): ?>
                <?php foreach ($agenda as $nombre => $telefono): ?>
                    <p><b><a href="#"><?php echo htmlspecialchars($nombre); ?></a></b> <?php echo htmlspecialchars($telefono); ?></p>
                <?php endforeach; ?>
            <?php else: ?>
                <p style="font-weight: bold;">no hay contactos en la agenda. :c</p>
            <?php endif; ?>
        </fieldset>
        <br>

        <!-- form para añadir/actualizar contactos -->
        <fieldset>
            <legend style="text-align: center; color: purple; font-weight: bold"> ▻ nuevo contacto ◅</legend>
            <form method="post" action="">
                <label><b>nombre:</b></label>
                <input type="text" name="nombre" />
                <br><br>
                <label><b>teléfono:</b></label>
                <input type="number" name="telefono" />

                <!-- añado los contactos existentes como campos ocultos -->
                <?php if (!empty($agenda)): ?>
                    <?php foreach ($agenda as $nombre => $telefono): ?>
                        <input type="hidden" name="agenda[<?php echo htmlspecialchars($nombre); ?>]" value="<?php echo htmlspecialchars($telefono); ?>" />
                    <?php endforeach; ?>
                <?php endif; ?>

                <br><br>
                <div style="text-align: center;">
                    <button type="submit" style="color: purple;font-family: 'Montserrat', sans-serif; font-weight: bold">¡añadelo!</button>
                    <button type="reset" style="color: purple;font-family: 'Montserrat', sans-serif; font-weight: bold">reset</button>
                </div>
            </form>
        </fieldset>
        <br>
        <!-- para vaciar la agenda, si hay contactos -->
        <?php if (!empty($agenda)): ?>
            <fieldset>
                <legend style="text-align: center; color: purple; font-weight: bold"> ☐ vaciar agenda ☐ </legend>
                <form method="post" action="">
                    <input type="hidden" name="limpiar" value="1" />
                    <div style="text-align: center;">
                        <button type="submit" style="color: purple;font-family: 'Montserrat', sans-serif; font-weight: bold">¡borra la agenda!</button>
                    </div>
                </form>
            </fieldset>
        <?php endif; ?>
    </div>
</body>

</html>