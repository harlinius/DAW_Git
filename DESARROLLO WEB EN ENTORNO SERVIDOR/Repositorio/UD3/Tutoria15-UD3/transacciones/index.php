<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    @$conProyecto = new mysqli('localhost', 'gestor', 'secreto', 'proyecto');
    $error = $conProyecto->connect_errno;
    if ($error == null) {
        $conProyecto->autocommit(false); // Deshabilitar transacciones automáticas
        // Ejecutar consultas como parte de la transacción
        $conProyecto->query('DELETE FROM stocks WHERE unidades=0');
        $conProyecto->query('UPDATE stock SET unidades=3 WHERE producto="abc"');
        // Confirmar los cambios
        $conProyecto->commit();
        // Al finalizar, una nueva transacción comienza automáticamente
        $conProyecto->close();
    }
    ?>
</body>

</html>