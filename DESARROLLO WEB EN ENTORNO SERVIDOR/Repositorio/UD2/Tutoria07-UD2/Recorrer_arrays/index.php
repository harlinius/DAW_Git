<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recorrer arrays</title>
</head>
<body>
    <?php
    $modulos = array("PR" => "Programación", "BD" => "Bases de datos", "DWES" => "Desarrollo web en entorno servidor");
    var_dump($modulos);
    
    foreach ($modulos as $item) {
        echo "<p>Módulo: ".$item. "</p>";
    }
    

    echo "<br><br>";
    foreach ($modulos as $clave => $modulo) {
        echo  "<p>El código del módulo ".$modulo." es ".$clave."</p>";
    }
    echo "<br><br>";
    $modulos2 = array("Programación", "Bases de datos", "Desarrollo web en entorno servidor");
    for ($i=0; $i < count($modulos2); $i++) {
        echo "<p>Módulo: ".$modulos2[$i]. "</p>";
    }
    ?>
    <a href="ejercicioResuelto.php">Ejercicio resuelto</a>
</body>
</html>