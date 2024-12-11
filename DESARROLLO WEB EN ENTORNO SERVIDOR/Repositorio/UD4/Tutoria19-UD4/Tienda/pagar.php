<?php
session_start();
if (!isset($_SESSION['nombre'])) {
    header('Location: login.php');
    exit();
}
?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tema 4</title>
    <!-- CSS Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- CSS FontAwesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
          integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
</head>
<body style="background: grey;">

    <!-- Barra Superior -->
    <div class="float-right d-inline-flex mt-2 mr-3">
        <i class="fas fa-user mr-2 fa-2x text-white"></i>
        <input type="text" size="10" value="<?php echo htmlspecialchars($_SESSION['nombre']); ?>"
               class="form-control mr-2 bg-transparent text-white" disabled>
        <a href="cerrar.php" class="btn btn-warning">Salir</a>
    </div>
    <br><br>

    <!-- Título Principal -->
    <h4 class="container text-center mt-4 font-weight-bold text-white">Tienda Online</h4>

    <!-- Mensaje de Confirmación -->
    <div class="container mt-5">
        <p class="font-weight-bold text-white">Pedido realizado correctamente.</p>
        <a href="listado.php" class="btn btn-info mt-3">Hacer otra Compra</a>
    </div>

</body>
</html>
