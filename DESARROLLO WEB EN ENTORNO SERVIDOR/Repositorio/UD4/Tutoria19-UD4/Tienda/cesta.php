<?php
session_start();

// Si no hay sesión iniciada, redirigir al login
if (!isset($_SESSION['nombre'])) {
    header('Location: login.php');
    exit();
}

require_once 'conexion.php';

// Comprobar si hay productos en la cesta
if (isset($_SESSION['cesta'])) {
    $listado = []; // Inicializar el listado de productos
    foreach ($_SESSION['cesta'] as $k => $v) {
        $producto = consultarProducto($k); // Asume que esta función está definida en conexion.php
        $listado[$k] = [$producto->nombre, $producto->pvp];
        $producto = null;
    }
    cerrar($conProyecto); // Cierra la conexión con la base de datos
}
?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Carrito de Compras</title>
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
    $cantidad = isset($_SESSION['cesta']) ? count($_SESSION['cesta']) : 0;
    echo "<input type='text' disabled class='form-control mr-2 bg-transparent text-white' value='$cantidad' size='2'>";
    ?>
    <i class="fas fa-user mr-2 fa-2x"></i>
    <input type="text" size="10" value="<?php echo htmlspecialchars($_SESSION['nombre']); ?>"
           class="form-control mr-2 bg-transparent text-white" disabled>
    <a href="cerrar.php" class="btn btn-warning mr-2">Salir</a>
</div>
<br><br>

<!-- Título -->
<h4 class="container text-center mt-4 font-weight-bold">Carrito de Compras</h4>

<!-- Contenedor de carrito -->
<div class="container mt-3">
    <div class="card text-white bg-success mb-3 m-auto" style="width:40rem">
        <div class="card-body">
            <h5 class="card-title"><i class="fa fa-shopping-cart mr-2"></i>Carrito</h5>
            <?php
            if (!isset($_SESSION['cesta']) || empty($listado)) {
                echo "<p class='card-text'>Carrito Vacío</p>";
            } else {
                $total = 0;
                echo "<p class='card-text'>";
                echo "<ul>";
                foreach ($listado as $k => $v) {
                    echo "<li>$v[0], PVP ($v[1]) €.</li>";
                    $total += $v[1];
                }
                echo "</ul>";
                echo "</p>";
                echo "<hr style='border:none; height:2px; background-color:white'>";
                echo "<p class='card-text'><b>Total</b><span class='ml-3'>$total (€)</span></p>";
            }
            ?>
            <a href="listado.php" class="btn btn-primary mr-2">Volver</a>
            <a href="pagar.php" class="btn btn-danger">Pagar</a>
        </div>
    </div>
</div>

</body>
</html>
