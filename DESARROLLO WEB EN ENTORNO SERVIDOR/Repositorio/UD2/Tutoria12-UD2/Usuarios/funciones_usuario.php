<?php

//Comprobamos que la sesión no esté iniciada y si es así, la iniciamos
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

//session_start();

function cargarUsuarios() {
    $_SESSION["usuarios"]["admin"] = ['password' => '1234', 'nombre' => 'Administrador'];
}

function autenticarUsuario($usuario, $password) {
    cargarUsuarios();
    
    if (isset($_SESSION["usuarios"][$usuario]) && $_SESSION["usuarios"][$usuario]['password'] === $password) {
        $_SESSION['u_logueado'] = [
            'nombre' => $_SESSION["usuarios"][$usuario]['nombre'],
            'username' => $usuario,
        ];
        return true;
    }
    return false;
}

function registrarUsuario($usuario, $password, $nombre) {
    if (isset($_SESSION['usuarios'][$usuario])) {
        return false; // Usuario ya existe.
    }
    
    // Guardamos el nuevo usuario en la sesión.
    $_SESSION['usuarios'][$usuario] = [
        'password' => $password,
        'nombre' => $nombre,
    ];
    
    // Iniciamos la sesión
    $_SESSION['u_logueado'] = [
        'nombre' => $nombre,
        'username' => $usuario,
    ];
    
    return true;
}

function esUsuarioAutenticado() {
    return isset($_SESSION['u_logueado']);
}

function cerrarSesion() {
    unset($_SESSION['u_logueado']);
}
?>
