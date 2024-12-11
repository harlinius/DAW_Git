<?php
// Conexión a la base de datos (recomendación: mover a un archivo separado e incluir con require_once)
$error = false;
$mensaje = "";
$host = "localhost";
$db = "proyecto";
$user = "gestor";
$pass = "secreto";
$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

try {
    // Crear conexión PDO
    $conProyecto = new PDO($dsn, $user, $pass);
    $conProyecto->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $ex) {
    $mensaje = $ex->getMessage();
    $error = true;
}

// Función para pintar el botón "Consultar Otro Artículo"
function pintarBoton()
{
    global $error;
    if (!$error) {
        echo "<a href='{$_SERVER['PHP_SELF']}' class='btn btn-success mb-2'>Consultar Otro Artículo</a>";
    }
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
    <title>Ejercicio Tema 3: Excepciones</title>
</head>
<body style="background: antiquewhite">
<h3 class="text-center mt-2 font-weight-bold">Ejercicio Resuelto</h3>
<div class="container mt-3">
    <?php
    if (isset($_POST['enviar']) && !$error) { 
        // Consultar unidades del producto
        $codigo = $_POST['producto'];

        // Consultas SQL
        $consulta = "SELECT unidades, tienda, producto, tiendas.nombre AS nombreTienda 
                     FROM stocks 
                     JOIN tiendas ON tienda = tiendas.id 
                     WHERE producto = :prod";
        $consulta1 = "SELECT nombre, nombre_corto FROM productos WHERE id = :id";

        try {
            // Preparar y ejecutar consultas
            $stmt = $conProyecto->prepare($consulta);
            $stmt1 = $conProyecto->prepare($consulta1);

            $stmt->execute([':prod' => $codigo]);
            $stmt1->execute([':id' => $codigo]);

            $fila = $stmt1->fetch(PDO::FETCH_OBJ); // Obtener el nombre del producto
            if ($fila) {
                echo "<h4 class='mt-3 mb-3 text-center'>Unidades del Producto: {$fila->nombre} ({$fila->nombre_corto})</h4>";
                pintarBoton();

                echo "<table class='table table-striped table-dark'>";
                echo "<thead>";
                echo "<tr class='font-weight-bold'><th class='text-center'>Nombre Tienda</th><th>Unidades</th><th class='text-center'>Acciones</th></tr>";
                echo "</thead>";
                echo "<tbody>";

                // Mostrar las unidades por tienda
                while ($filas = $stmt->fetch(PDO::FETCH_OBJ)) {
                    echo "<tr class='text-center'><td>{$filas->nombreTienda}</td>";
                    echo "<td class='text-center'>";
                    echo "<form name='a' action='{$_SERVER['PHP_SELF']}' method='POST' class='form-inline'>";
                    echo "<input type='number' class='form-control' step='1' min='0' name='stock' value='{$filas->unidades}'>";
                    echo "<input type='hidden' name='ct' value='{$filas->tienda}'>";
                    echo "<input type='hidden' name='cp' value='{$filas->producto}'>";
                    echo "</td><td>";
                    echo "<input type='submit' class='btn btn-warning ml-2' name='enviar1' value='Actualizar'>";
                    echo "</form>";
                    echo "</td></tr>";
                }
                echo "</tbody>";
                echo "</table>";
            } else {
                echo "<p class='text-danger'>Producto no encontrado.</p>";
            }
        } catch (PDOException $ex) {
            $error = true;
            $mensaje = $ex->getMessage();
        }
    } elseif (isset($_POST['enviar1']) && !$error) { 
        // Actualizar las unidades del producto
        $codTienda = $_POST['ct'];
        $codProducto = $_POST['cp'];
        $unidades = $_POST['stock'];

        $update = "UPDATE stocks SET unidades = :u WHERE producto = :p AND tienda = :t";

        try {
            $stmt = $conProyecto->prepare($update);
            $stmt->execute([':u' => $unidades, ':p' => $codProducto, ':t' => $codTienda]);
            echo "<p class='font-weight-bold text-success mt-3'>Unidades Actualizadas Correctamente</p>";
            pintarBoton();
        } catch (PDOException $ex) {
            $error = true;
            $mensaje = $ex->getMessage();
        }
    } else if (!$error) { 
        // Formulario principal para seleccionar producto
        ?>
        <form name="f1" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <div class="form-group">
                <label for="p" class="font-weight-bold">Elige un producto</label>
                <select class="form-control" id="p" name="producto">
                    <?php
                    try {
                        $consulta = "SELECT id, nombre, nombre_corto FROM productos ORDER BY nombre";
                        $stmt = $conProyecto->prepare($consulta);
                        $stmt->execute();

                        while ($filas = $stmt->fetch(PDO::FETCH_OBJ)) {
                            echo "<option value='{$filas->id}'>{$filas->nombre}</option>";
                        }
                    } catch (PDOException $ex) {
                        $error = true;
                        $mensaje = $ex->getMessage();
                    }
                    ?>
                </select>
            </div>
            <div class="mt-2">
                <?php
                if (!$error) {
                    echo "<input type='submit' class='btn btn-info mr-3' value='Consultar Stock' name='enviar'>";
                } else {
                    echo "<input type='submit' class='btn btn-info mr-3' value='Consultar Stock' name='enviar' disabled>";
                }
                ?>
            </div>
        </form>
        <?php
    }
    if ($error) {
        echo "<div class='container mt-3'><p class='text-danger font-weight-bold'>$mensaje</p></div>";
    }
    ?>
</div>
</body>
</html>
