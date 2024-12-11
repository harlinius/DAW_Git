<?php
session_start();
require 'funciones.php';

if (isset($_GET['id'])) {
    $id_cita = $_GET['id'];
    cancelarCita($id_cita);
}

header("Location: index.php");
exit();
