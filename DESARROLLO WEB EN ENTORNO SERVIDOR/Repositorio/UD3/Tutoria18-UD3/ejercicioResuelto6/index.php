<?php
/**
 * Crea una página web en la que se muestren las unidades existentes de un determinado producto en cada una de las tiendas. Para seleccionar el producto concreto utiliza un cuadro de selección dentro de un formulario en esa misma página. 
 */
// Establecemos la conexión con la base de datos utilizando PDO
try {
    $conProyecto = new PDO('mysql:host=localhost;dbname=proyecto', 'gestor', 'secreto');
    // Configuramos PDO para lanzar excepciones en caso de error
    $conProyecto->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Si hay un error de conexión, detenemos la ejecución con die() y mostramos el error
    die('Error de Conexión: ' . $e->getMessage());
}

// Función para cerrar la conexión con la base de datos
function cerrarConexion(&$conProyecto) {
    $conProyecto = null; // Cerramos la conexión asignando null
}
?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Incluimos el CSS de Bootstrap para estilos -->
    <link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
          crossorigin="anonymous">
    <title>Ejercicio Tema 3: Conjuntos de resultados en PDO</title>
</head>
<body style="background: antiquewhite">
<h3 class="text-center mt-2 font-weight-bold">Ejercicio Resuelto</h3>
<div class="container mt-3">
    <?php
    // Comprobamos si se ha enviado el formulario
    if (isset($_POST['enviar'])) {
        // Recuperamos el ID del producto seleccionado
        $codProd = $_POST['producto'];

        try {
            // Consulta para obtener el nombre y el nombre corto del producto seleccionado
            $consultaNombre = $conProyecto->prepare("SELECT nombre, nombre_corto FROM productos WHERE id = :id");
            $consultaNombre->bindParam(':id', $codProd, PDO::PARAM_INT);
            $consultaNombre->execute();

            // Consulta para obtener las unidades disponibles y los nombres de las tiendas relacionadas con el producto
            $consultaEspecifica = $conProyecto->prepare("SELECT unidades, tiendas.nombre AS tienda 
                               FROM stocks, tiendas 
                               WHERE tienda = tiendas.id AND producto = :id");
            $consultaEspecifica->bindParam(':id', $codProd, PDO::PARAM_INT);
            $consultaEspecifica->execute();

            // Recuperamos la información del producto (solo se espera una fila)
            $fila = $consultaNombre->fetch(PDO::FETCH_ASSOC);
            echo "<h4 class='mt-3 mb-3 text-center'>Unidades del Producto: ";
            echo $fila['nombre'] . " ({$fila['nombre_corto']})";
            echo "</h4>";

            // Botón para consultar otro artículo
            echo "<a href='{$_SERVER['PHP_SELF']}' class='btn btn-success mb-2'>Consultar Otro Artículo</a>";

            // Iniciamos la tabla para mostrar los resultados
            echo "<table class='table table-striped table-dark'>";
            echo "<thead>";
            echo "<tr class='text-center font-weight-bold'><th>Nombre Tienda</th><th>Stock</th></tr>";
            echo "</thead>";
            echo "<tbody>";

            // Recorremos los resultados y mostramos las tiendas y las unidades disponibles
            while ($filas = $consultaEspecifica->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr><td>{$filas['tienda']}</td><td class='text-center'>{$filas['unidades']}</td></tr>";
            }
            echo "</tbody>";
            echo "</table>";

        } catch (PDOException $e) {
            // Mostramos un mensaje de error si ocurre algún problema con las consultas
            die("Error al recuperar el stock o producto: " . $e->getMessage());
        }

        cerrarConexion($conProyecto); // Cerramos la conexión a la base de datos
    } else {
        // Si no se ha enviado el formulario, mostramos el formulario para seleccionar un producto
        ?>
        <form name="f1" action="#" method="POST">
            <div class="form-group">
                <label for="p" class="font-weight-bold">Elige un producto</label>
                <select class="form-control" id="p" name="producto">
                    <?php
                    try {
                        // Consulta para obtener todos los productos disponibles ordenados por nombre
                        $consultaProductos = $conProyecto->query("SELECT id, nombre, nombre_corto FROM productos ORDER BY nombre");

                        // Recorremos los productos y los mostramos como opciones en el select
                        while ($fila = $consultaProductos->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value='{$fila['id']}'>{$fila['nombre']}</option>";
                        }
                    } catch (PDOException $e) {
                        die("Error al recuperar los productos: " . $e->getMessage());
                    }

                    cerrarConexion($conProyecto); // Cerramos la conexión
                    ?>
                </select>
            </div>
            <div class="mt-2">
                <!-- Botón para enviar el formulario -->
                <input type="submit" class="btn btn-info mr-3" value="Consultar Stock" name="enviar">
            </div>
        </form>
        </div>
    <?php } ?>
</body>
</html>
