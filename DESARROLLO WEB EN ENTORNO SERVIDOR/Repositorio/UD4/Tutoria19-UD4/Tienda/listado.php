<?php
session_start();

// Si no hay sesión iniciada, redirigir al login
if (!isset($_SESSION['nombre'])) {
    header('Location: login.php');
    exit();
}

require_once 'conexion.php';

// Consulta para obtener los productos
$consulta = "SELECT id, nombre, pvp FROM productos ORDER BY nombre";
$stmt = $conProyecto->prepare($consulta);

try {
    $stmt->execute();
} catch (PDOException $ex) {
    cerrarTodo($conProyecto, $stmt);
    die("Error al recuperar los productos: " . $ex->getMessage());
}

// Vaciar la cesta
if (isset($_POST['vaciar'])) {
    unset($_SESSION['cesta']);
}

// Añadir producto a la cesta
if (isset($_POST['comprar'])) {
    $datos = consultarProducto($_POST['id']); // Asume que esta función está definida en conexion.php
    $_SESSION['cesta'][$datos->id] = $datos->id;
}
?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda Online</title>
    <!-- CSS Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- CSS FontAwesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
          integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
</head>
<body style="background: gray;">
    <!-- Barra superior -->
    <div class="float-right d-inline-flex mt-2">
        <i class="fa fa-shopping-cart mr-2 fa-2x"></i>
        <?php
        if (isset($_SESSION['cesta'])) {
            $cantidad = count($_SESSION['cesta']);
            echo "<input type='text' disabled class='form-control mr-2 bg-transparent text-white' value='$cantidad' size='2'>";
        } else {
            echo "<input type='text' disabled class='form-control mr-2 bg-transparent text-white' value='0' size='2'>";
        }
        ?>
        <i class="fas fa-user mr-2 fa-2x"></i>
        <input type="text" size="10" value="<?php echo htmlspecialchars($_SESSION['nombre']); ?>"
               class="form-control mr-2 bg-transparent text-white" disabled>
        <a href="cerrar.php" class="btn btn-warning mr-2">Salir</a>
    </div>
    <br><br>

    <!-- Título -->
    <h4 class="container text-center mt-4 font-weight-bold">Tienda Online</h4>

    <!-- Tabla de productos -->
    <div class="container mt-3">
        <!-- Botones de acciones -->
        <form class="form-inline" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <a href="cesta.php" class="btn btn-success mr-2">Ir a Cesta</a>
            <input type="submit" value="Vaciar Carro" class="btn btn-danger" name="vaciar">
        </form>

        <!-- Tabla -->
        <table class="table table-striped table-dark mt-3">
            <thead>
            <tr class="text-center">
                <th scope="col">Añadir</th>
                <th scope="col">Nombre</th>
                <th scope="col">Añadido</th>
            </tr>
            </thead>
            <tbody>
            <?php while ($filas = $stmt->fetch(PDO::FETCH_OBJ)): ?>
                <tr>
                    <th scope="row" class="text-center">
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                            <input type="hidden" name="id" value="<?php echo $filas->id; ?>">
                            <input type="submit" class="btn btn-primary" name="comprar" value="Añadir">
                        </form>
                    </th>
                    <td><?php echo htmlspecialchars($filas->nombre); ?>, Precio: <?php echo $filas->pvp; ?> (€)</td>
                    <td class="text-center">
                        <?php if (isset($_SESSION['cesta'][$filas->id])): ?>
                            <i class="fas fa-check fa-2x text-success"></i>
                        <?php else: ?>
                            <i class="far fa-times-circle fa-2x text-danger"></i>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
            <?php cerrarTodo($conProyecto, $stmt); ?>
            </tbody>
        </table>
    </div>
</body>
</html>
