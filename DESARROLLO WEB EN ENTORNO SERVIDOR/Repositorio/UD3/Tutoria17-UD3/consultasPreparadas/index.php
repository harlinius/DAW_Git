<?php
$conProyecto = new mysqli('localhost', 'gestor', 'secreto', 'proyecto');

//Ejemplo sin parámetros
//mysqli_stmt 
$preparada = $conProyecto->stmt_init();
$preparada->prepare('INSERT INTO familias (cod, nombre) VALUES ("RASPBERRY_PI", "Raspberry pi")');
$preparada->execute();
$preparada->close();

//Ejemplo con parámetros
$preparada = $conProyecto->stmt_init();
$preparada->prepare('INSERT INTO familias (cod, nombre) VALUES (?, ?)');
$cod_producto = "TABLET";
$nombre_producto = "Tablet PC";
$preparada->bind_param('ss', $cod_producto, $nombre_producto); // 'ss' indica dos cadenas
$preparada->execute();
$preparada->close();

//Consultas que devuelven resultados
$preparadaConResultados = $conProyecto->stmt_init();
$preparadaConResultados->prepare('SELECT cod, nombre FROM familias');
$preparadaConResultados->execute();
$preparadaConResultados->bind_result($cod, $nombre);
while ($preparadaConResultados->fetch()) {
    echo "<p>Codigo $cod: $nombre nombre.</p>";
}
$preparadaConResultados->close();

//Control de errores
$preparadaErrores = $conProyecto->stmt_init();
$consulta = "SELECT nombre FROM productos WHERE id = ?";
if (!$preparadaErrores->prepare($consulta)) {
    echo "Error preparando la consulta: " . $conProyecto->error;
    die();
}
$preparadaErrores->bind_param('i', $id);
if (!$preparadaErrores->execute()) {
    echo "Error ejecutando la consulta.";
}
$preparadaErrores->close();
$conProyecto->close();
