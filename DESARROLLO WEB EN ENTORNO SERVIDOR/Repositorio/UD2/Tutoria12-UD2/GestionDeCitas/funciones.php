<?php
function agregarCita($nombre, $fecha, $hora, $motivo) {
    $_SESSION['citas'][] = [
        'id' => uniqid("cita_"), //Genera un id respecto a la fecha en milisegudnos
        'nombre' => $nombre,
        'fecha' => $fecha,
        'hora' => $hora,
        'motivo' => $motivo
    ];
}

function obtenerCitas() {
    return isset($_SESSION['citas']) ? $_SESSION['citas'] : [];
    //o bien $_SESSION['citas'] ?? []
}

function cancelarCita($id) {
    foreach ($_SESSION['citas'] as $key => $cita) {
        if ($cita['id'] == $id) {
            unset($_SESSION['citas'][$key]);
            break;
        }
    }
    $_SESSION['citas'] = array_values($_SESSION['citas']);
}

function reprogramarCita($id, $nueva_fecha, $nueva_hora) {
    //& para que sobreescriba el valor en la variable original
    foreach ($_SESSION['citas'] as &$cita) {
        if ($cita['id'] == $id) {
            $cita['fecha'] = $nueva_fecha;
            $cita['hora'] = $nueva_hora;
            break;
        }
    }
}

function validarDia($fecha) {
    $diaSemana = date('N', strtotime($fecha));
    return ($diaSemana >= 1 && $diaSemana <= 5);
}

function validarHora($hora) {
    return ($hora >= "09:00" && $hora <= "18:00");
}

function obtenerCitaPorId($id) {
    foreach ($_SESSION['citas'] as $cita) {
        if ($cita['id'] == $id) {
            return $cita;
        }
    }
    return null;
}
?>
