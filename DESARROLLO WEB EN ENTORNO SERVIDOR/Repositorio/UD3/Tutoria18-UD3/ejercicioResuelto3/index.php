<?php
// Establecemos la conexión con la base de datos
// Sería buena idea mover esta lógica a un archivo separado e incluirlo con 'require' o 'require_once'
$conProyecto = new mysqli('localhost', 'gestor', 'secreto', 'proyecto');

// Verificamos si hay errores en la conexión
if ($conProyecto->connect_error) {
    die('Error de Conexión (' . $conProyecto->connect_errno . ') ' . $conProyecto->connect_error);
    // die() detiene la ejecución del código PHP si ocurre un error
}

// Función para cerrar la conexión con la base de datos
function cerrarConexion() {
    global $conProyecto; // Accedemos a la conexión global
    $conProyecto->close(); // Cerramos la conexión
}

// Función para generar el botón "Consultar Otro Artículo"
function pintarBoton() {
    echo "<a href='{$_SERVER['PHP_SELF']}' class='btn btn-success mb-2'>Consultar Otro Artículo</a>";
}
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Inclusión de Bootstrap para estilos -->
    <link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
          crossorigin="anonymous">
    <title>Ejercicio Tema 3: Conjuntos de resultados en MySQLi</title>
</head>
<body style="background: antiquewhite">
<h3 class="text-center mt-2 font-weight-bold">Ejercicio Resuelto</h3>
<div class="container mt-3">
<?php
if (isset($_POST['enviar'])) { // Comprobamos si se ha enviado el formulario para consultar unidades
    $codProd = $_POST['producto']; // Obtenemos el ID del producto seleccionado

    // Inicializamos las consultas preparadas
    $stmt1 = $conProyecto->stmt_init();
    $stmt = $conProyecto->stmt_init();

    // Consulta para obtener el nombre del producto
    $consulta1 = "SELECT nombre, nombre_corto FROM productos WHERE id = ?";
    // Consulta para obtener el stock del producto en distintas tiendas
    $consulta = "SELECT unidades, tienda, producto, tiendas.nombre AS nombreTienda 
                 FROM stocks, tiendas 
                 WHERE tienda = tiendas.id AND producto = ?";

    // Preparamos ambas consultas
    if (!($stmt1->prepare($consulta1)) || !($stmt->prepare($consulta))) {
        die("Error al preparar las consultas: " . $conProyecto->error);
    }

    // Asociamos parámetros a las consultas (tipo 'i' para enteros)
    $stmt1->bind_param('i', $codProd);
    $stmt->bind_param('i', $codProd);

    // Ejecutamos la primera consulta para obtener el nombre del producto
    if (!$stmt1->execute()) {
        die("Error al recuperar producto: " . $stmt1->error);
    }

    // Asociamos las columnas del resultado a variables
    $stmt1->bind_result($n, $nc); // $n = nombre, $nc = nombre_corto
    $stmt1->fetch(); // Recuperamos el único registro de esta consulta
    $stmt1->close(); // Cerramos la consulta

    // Ejecutamos la segunda consulta para obtener el stock
    if (!$stmt->execute()) {
        die("Error al recuperar unidades: " . $stmt->error);
    }

    // Asociamos las columnas del resultado a variables
    $stmt->bind_result($u, $ct, $cp, $nt);

    // Mostramos el nombre del producto
    echo "<h4 class='mt-3 mb-3 text-center'>Unidades del Producto: $n ($nc)</h4>";
    pintarBoton(); // Generamos el botón para consultar otro artículo

    // Creamos la tabla para mostrar los resultados
    echo "<table class='table table-striped table-dark'>";
    echo "<thead>";
    echo "<tr class='font-weight-bold'><th class='text-center'>Nombre Tienda</th><th>Unidades</th><th class='text-center'>Acciones</th></tr>";
    echo "</thead>";
    echo "<tbody>";

    // Iteramos sobre los resultados y generamos filas de la tabla
    while ($stmt->fetch()) {
        echo "<tr class='text-center'><td>$nt</td>";
        echo "<td class='text-center m-auto'>";
        // Creamos un formulario para modificar el stock
        echo "<form name='a' action='{$_SERVER['PHP_SELF']}' method='POST' class='form-inline'>";
        echo "<input type='number' class='form-control' step='1' min='0' name='stock' value='$u'>";
        echo "<input type='hidden' name='ct' value='$ct'>";
        echo "<input type='hidden' name='cp' value='$cp'>";
        echo "</td><td>";
        echo "<input type='submit' class='btn btn-warning ml-2' name='enviar1' value='Actualizar'>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";

    $stmt->close(); // Cerramos la consulta de stock
    cerrarConexion(); // Cerramos la conexión
} elseif (isset($_POST['enviar1'])) { // Comprobamos si se ha enviado el formulario para modificar el stock
    $codTienda = $_POST['ct']; // ID de la tienda
    $codProducto = $_POST['cp']; // ID del producto
    $unidades = $_POST['stock']; // Nuevas unidades

    // Consulta para actualizar el stock
    $update = "UPDATE stocks SET unidades = ? WHERE producto = ? AND tienda = ?";
    $stmt = $conProyecto->stmt_init();

    // Preparamos la consulta
    if (!$stmt->prepare($update)) {
        die("Error al preparar actualización: " . $conProyecto->error);
    }

    // Asociamos parámetros (tres enteros)
    $stmt->bind_param('iii', $unidades, $codProducto, $codTienda);

    // Ejecutamos la consulta para actualizar el stock
    if (!$stmt->execute()) {
        die("Error al actualizar unidades: " . $stmt->error);
    }

    // Mostramos un mensaje de éxito
    echo "<p class='font-weight-bold text-success mt-3'>Unidades Actualizadas Correctamente</p>";
    $stmt->close(); // Cerramos la consulta
    cerrarConexion(); // Cerramos la conexión
    pintarBoton(); // Generamos el botón para consultar otro artículo
} else { // Si no se ha enviado ningún formulario, mostramos el formulario principal
    ?>
    <form name="f1" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <div class="form-group">
            <label for="p" class="font-weight-bold">Elige un producto</label>
            <select class="form-control" id="p" name="producto">
                <?php
                // Consulta para obtener los productos disponibles
                $consulta = "SELECT id, nombre, nombre_corto FROM productos ORDER BY nombre";
                if (!($resultado = $conProyecto->query($consulta))) {
                    die("Error al recuperar los productos: " . $conProyecto->error);
                }
                // Iteramos sobre los resultados y generamos opciones para el select
                while ($fila = $resultado->fetch_assoc()) {
                    echo "<option value='{$fila['id']}'>{$fila['nombre']}</option>";
                }
                $resultado->free(); // Liberamos los resultados
                cerrarConexion(); // Cerramos la conexión
                ?>
            </select>
        </div>
        <div class="mt-2">
            <input type="submit" class="btn btn-info mr-3" value="Consultar Stock" name="enviar">
        </div>
    </form>
    </div>
<?php } ?>
</body>
</html>
