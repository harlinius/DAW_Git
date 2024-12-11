<?php
// Conexión a la base de datos
// Recomendación: mover la conexión a un archivo separado y usar require_once
$host = "localhost";
$db = "proyecto";
$user = "gestor";
$pass = "secreto";
$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

try {
    // Crear conexión PDO
    $conProyecto = new PDO($dsn, $user, $pass);
    $conProyecto->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
} catch (PDOException $e) {
    echo "<p class='text-danger'>Error al conectar con la base de datos: " . $e->getMessage() . "</p>";
    exit();
}

// Función para pintar un botón de consulta
function pintarBoton()
{
    echo "<a href='{$_SERVER['PHP_SELF']}' class='btn btn-success mb-2'>Consultar Otro Artículo</a>";
}
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSS para usar Bootstrap -->
    <link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
          crossorigin="anonymous">
    <title>Ejercicio Tema 3</title>
</head>
<body style="background: antiquewhite">
<h3 class="text-center mt-2 font-weight-bold">Ejercicio Resuelto</h3>
<div class="container mt-3">
    <?php
    if (isset($_POST['enviar'])) { 
        // Si se envió el formulario
        $codigo = intval($_POST['producto']); // Aseguramos que sea un entero
        // Consultas SQL
        $consultaDatos = $conProyecto->prepare("SELECT unidades, tienda, producto, tiendas.nombre AS nombreTienda 
                                                FROM stocks 
                                                JOIN tiendas ON tienda = tiendas.id 
                                                WHERE producto = ?");
        $consultaProducto = $conProyecto->prepare("SELECT nombre, nombre_corto 
                                                   FROM productos 
                                                   WHERE id = ?");
        
        $consultaProducto->execute([$codigo]);
        $consultaDatos->execute([$codigo]);

        $fila = $consultaProducto->fetch(PDO::FETCH_OBJ); // Solo devuelve una fila
        if ($fila) {
            echo "<h4 class='mt-3 mb-3 text-center'>Unidades del Producto: {$fila->nombre} ({$fila->nombre_corto})</h4>";
            pintarBoton();

            echo "<table class='table table-striped table-dark'>";
            echo "<thead>";
            echo "<tr class='font-weight-bold'><th class='text-center'>Nombre Tienda</th>";
            echo "<th class='text-center'>Unidades</th></tr>";
            echo "</thead>";
            echo "<tbody>";

            while ($filas = $consultaDatos->fetch(PDO::FETCH_OBJ)) {
                echo "<tr class='text-center'><td>{$filas->nombreTienda}</td>";
                echo "<td>{$filas->unidades}</td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
        } else {
            echo "<p class='text-danger'>No se encontraron datos para el producto seleccionado.</p>";
        }

        // Cerramos la conexión
        $conProyecto = null;
    } else { 
        // Si no se envió ningún formulario
        ?>
        <form name="f1" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <div class="form-group">
                <label for="p" class="font-weight-bold">Elige un producto</label>
                <select class="form-control" id="p" name="producto">
                    <?php
                    $consulta = "SELECT id, nombre, nombre_corto FROM productos ORDER BY nombre";
                    $datos = $conProyecto->query($consulta);
                    while ($filas = $datos->fetch(PDO::FETCH_OBJ)) {
                        echo "<option value='{$filas->id}'>{$filas->nombre}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mt-2">
                <input type="submit" class="btn btn-info mr-3" value="Consultar Stock" name="enviar">
            </div>
        </form>
        <?php
        // Cerramos la conexión
        $conProyecto = null;
    }
    ?>
</div>
</body>
</html>
