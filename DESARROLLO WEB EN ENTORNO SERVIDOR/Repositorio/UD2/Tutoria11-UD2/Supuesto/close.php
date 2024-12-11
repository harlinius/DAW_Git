<?php
include 'functions.php';

eliminarTareas();
session_destroy();

header('Location: index.php'); // Redirigimos a la página principal
exit;
?>
