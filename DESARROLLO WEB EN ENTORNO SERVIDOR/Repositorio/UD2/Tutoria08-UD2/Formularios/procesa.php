<?php
var_dump($_REQUEST);
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    echo "<p>Enviado por GET</p>";

    $get = $_GET["get"];
    $get1 = $_GET["get1"];
    $get2 = $_GET["get2"];

    //TREDUCCIÓN -> $modulos = isset($_GET["modulo"]) ? $_GET["modulo"] : [];
    $modulos = $_GET["modulo"] ?? [];

    // Mostramos el nombre
    echo "<p>Get: " . htmlspecialchars($get) . "</p>";
    echo "<p>Get1: " . htmlspecialchars($get1) . "</p>";
    echo "<p>Get2: " . htmlspecialchars($get2) . "</p>";

    // Mostramos los módulos seleccionados
    if (!empty($modulos)) {
        echo "<p>Módulos que cursa:</p><ul>";
        foreach ($modulos as $modulo) {
            echo "<li>" . htmlspecialchars($modulo) . "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>No ha seleccionado ningún módulo.</p>";
    }
}
// Comprobamos si el formulario ha sido enviado
else if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "<p>Enviado por POST</p>";
    // Obtenemos el nombre
    $nombre = $_POST["nombre"];

    // Obtenemos los módulos seleccionados (como array)
    $modulos = $_POST["modulo"] ?? []; // En caso de no haber seleccionados

    // Mostramos el nombre
    echo "<h2>Datos del alumno:</h2>";
    echo "<p>Nombre: " . htmlspecialchars($nombre) . "</p>";

    // Mostramos los módulos seleccionados
    if (!empty($modulos)) {
        echo "<p>Módulos que cursa:</p><ul>";
        foreach ($modulos as $modulo) {
            echo "<li>" . htmlspecialchars($modulo) . "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>No ha seleccionado ningún módulo.</p>";
    }
}