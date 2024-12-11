<?php
//Comprobamos que la sesión no esté iniciada y si es así, la iniciamos
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Función para agregar una tarea
function agregarTarea($nombre, $descripcion, $prioridad, $fecha)
{
    //Dos formas de hacer el if -> (return)=(sentencia a analizar)?(true):(false)
    //(sentencia a analizar)?(hacer si true):(hacer si false)
    /**
    *if (count($_SESSION["tareas"] ?? []) > 0) {
    *    $id = max(array_column($_SESSION["tareas"], 'id')) + 1;
    *} else {
    *    $id = 1;
    *}
    **/
    $id = count($_SESSION["tareas"] ?? []) > 0
        ? max(array_column($_SESSION["tareas"], 'id')) + 1
        : 1;
    $_SESSION["tareas"][] = ['id' => $id, 'nombre' => $nombre, 'descripcion' => $descripcion, 'prioridad' => $prioridad, 'fecha' => $fecha];
}

// Función para obtener todas las tareas
function obtenerTareas()
{
    return $_SESSION["tareas"] ?? [];
}

// Función para eliminar las tareas
function eliminarTareas()
{
    $_SESSION["tareas"] = [];
}

// Función para buscar una tarea por su ID
function obtenerTareaPorId($id)
{
    foreach ($_SESSION["tareas"] ?? [] as $tarea) {
        if ($tarea['id'] == $id) {
            return $tarea;
        }
    }
    return null;
}

// Función para actualizar una tarea
function actualizarTarea($id, $nombre, $descripcion, $prioridad, $fecha)
{
    if (isset($_SESSION["tareas"])) {
        foreach ($_SESSION["tareas"] as &$tarea) {
            if ($tarea['id'] == $id) {
                $tarea['nombre'] = $nombre;
                $tarea['descripcion'] = $descripcion;
                $tarea['prioridad'] = $prioridad;
                $tarea['fecha'] = $fecha;
                break;
            }
        }
    }
}

// Función para eliminar una tarea
function eliminarTarea($id)
{
    foreach ($_SESSION["tareas"] as $key => $tarea) {
        if ($tarea['id'] == $id) {
            unset($_SESSION["tareas"][$key]);
            $_SESSION["tareas"] = array_values($_SESSION["tareas"]); // Reindexa el array
            break;
        }
    }
}
