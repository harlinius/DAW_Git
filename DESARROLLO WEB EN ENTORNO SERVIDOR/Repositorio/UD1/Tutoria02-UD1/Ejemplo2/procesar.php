<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombre = $_POST['nombre'];
        $edad = $_POST['edad'];
        echo "Hola, $nombre. Tienes $edad años.";
    }
?>
