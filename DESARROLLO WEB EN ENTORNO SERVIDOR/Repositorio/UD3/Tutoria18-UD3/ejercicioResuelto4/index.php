<?php
// Conexión a la base de datos
// Recomendación: mover la conexión a un archivo separado y usar require_once.
$host = "localhost"; // Dirección del servidor
$db = "proyecto";    // Nombre de la base de datos
$user = "gestor";    // Usuario
$pass = "secreto";   // Contraseña

$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

try {
    // Crear la conexión PDO
    $conProyecto = new PDO($dsn, $user, $pass);

    // Configurar el modo de error para que emita advertencias
    $conProyecto->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

} catch (PDOException $e) {
    // Manejo de errores al conectar
    echo "<p class='text-danger'>Error al conectar a la base de datos: " . $e->getMessage() . "</p>";
    exit();
}
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSS para usar Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Ejercicio Tema 3 PDO</title>
</head>
<body style="background: antiquewhite">
<h3 class="text-center mt-2 font-weight-bold">Ejercicio Transacción con PDO</h3>
<div class="container mt-3">
    <?php
    // Variable para verificar el estado de la transacción
    $isOk = true;

    try {
        // Iniciar la transacción
        $conProyecto->beginTransaction();

        // Primera consulta: Actualizar unidades de un producto en una tienda específica
        $update = "UPDATE stocks 
                   SET unidades = 1 
                   WHERE producto = (SELECT id FROM productos WHERE nombre_corto = 'PAPYRE62GB') 
                   AND tienda = 1";
        if (!$conProyecto->exec($update)) {
            $isOk = false;
        }

        // Segunda consulta: Insertar un nuevo registro en la tabla stocks
        $insert = "INSERT INTO stocks 
                   SELECT id, 2, 1 
                   FROM productos 
                   WHERE nombre_corto = 'PAPYRE62GB'";
        if (!$conProyecto->exec($insert)) {
            $isOk = false;
        }

        // Verificar el estado de las operaciones
        if ($isOk) {
            $conProyecto->commit(); // Confirmar los cambios si todo fue exitoso
            echo "<p class='text-primary font-weight-bold'>Los cambios se realizaron correctamente.</p>";
        } else {
            $conProyecto->rollBack(); // Revertir los cambios en caso de error
            echo "<p class='text-danger font-weight-bold'>No se han podido realizar los cambios.</p>";
        }
    } catch (PDOException $e) {
        // Manejo de errores en consultas o transacciones
        $conProyecto->rollBack();
        echo "<p class='text-danger font-weight-bold'>Error en la transacción: " . $e->getMessage() . "</p>";
    }

    // Cerrar la conexión
    $conProyecto = null;
    ?>
</div>
</body>
</html>
