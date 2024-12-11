<?php
//Hacemos la conexión
$conProyecto=new mysqli('localhost', 'gestor', 'secreto', 'proyecto');

$resultado = $conProyecto->query('SELECT producto, unidades FROM stocks WHERE unidades < 2');

// Obtenemos el primer registro
$stock = $resultado->fetch_array();
$producto = $stock['producto']; // O también $stock[0]
$unidades = $stock['unidades']; // O también $stock[1]
echo "<p>Producto $producto: $unidades unidades.</p>";

// Obtenemos el primer registro
$stock = $resultado->fetch_array();
$producto = $stock[0]; // O también $stock[0]
$unidades = $stock[1]; // O también $stock[1]
echo "<p>Producto $producto: $unidades unidades.</p>";

//DEVUELVE UN ARRAY NUMÉRICO Y ASOCIATIVO
$stock = $resultado->fetch_array();
var_dump($stock);

echo "<br><br>";

//DEVUELVE UN ARRAY NUMÉRICO
$stock = $resultado->fetch_array(MYSQLI_NUM);
var_dump($stock);

echo "<br><br>";

//LO MISMO
$stock = $resultado->fetch_row();
var_dump($stock);

echo "<br><br>";

//DEVUELVE UN ARRAY ASOCIATIVO
$stock = $resultado->fetch_array(MYSQLI_ASSOC);
var_dump($stock);

echo "<br><br>";

//LO MISMO
$stock = $resultado->fetch_assoc();
var_dump($stock);

echo "<br><br>";

// = $conProyecto->query('SELECT producto, unidades FROM stocks WHERE unidades < 2');
// Recorremos todos los registros
$stock = $resultado->fetch_object(); //DEVUELVE UN OBJETO EN LUGAR DE UN ARRAY
var_dump($stock);
echo "<br><br>";
/*
$stock = (object) [
    "producto" => 2,
    "unidades" => 1
];
*/
while ($stock != null) {
    echo "<p>Producto $stock->producto: $stock->unidades unidades.</p>";
    $stock = $resultado->fetch_object();
}