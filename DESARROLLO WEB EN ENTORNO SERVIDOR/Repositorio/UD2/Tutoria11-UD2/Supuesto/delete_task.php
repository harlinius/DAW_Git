<?php
include 'functions.php';

$id = $_GET['id'];
eliminarTarea($id); // Eliminamos la tarea

header('Location: index.php'); // Redirigimos a la página principal
exit;
?>
