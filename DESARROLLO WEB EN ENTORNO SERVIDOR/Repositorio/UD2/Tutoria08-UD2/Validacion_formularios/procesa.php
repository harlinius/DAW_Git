<?php
$errores = [];
function existenModulos()
{
    global $errores;
    if (!isset($_POST['modulo'])) {
        $errores[] = "No has elegido ningun módulo revíselo";
        return false;
    }
    return true;
}

function comprobarCadenas($cadena, $tipo)
{
    global $errores;
    switch ($tipo) {
        case 'Nombre':
            if(strlen($cadena)<=0){
                $errores[] = "Error en el nombre";
            }
            break;
        case 'Apellidos':
            if(strlen($cadena)<=0 || strlen($cadena)>=60){
                $errores[] = "Error en el apellido";
            }
            break;
        default:
            echo "<p>Esta función no admite esos parámetros.</p>";
            break;
    }
    return true;
}
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no,
          initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formularios</title>
</head>
<body style="background: gainsboro">
<?php
$nombre = trim($_POST['nombre']);
comprobarCadenas($nombre, "Nombre");
$apellidos = trim($_POST['apellidos']);
comprobarCadenas($apellidos, "Apellidos");
$mail = trim($_POST['mail']);
if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
    $errores[] = "<p>La dirección de correo '$mail' no es válida.</p>";
}
//Podría ser un fallo de seguridad no comprobar la edad.
$edad = $_POST['edad'];
if (existenModulos()) {
    foreach ($_POST['modulo'] as $key => $valor) {
        $modulos[] = $valor;
    }
}
if (count($errores) > 0) {
    if(count($errores) == 1){
        echo "<p>Ha habido " . count($errores) . " error, este ha sido:</p>";
    }
    else{
        echo "<p>Ha habido " . count($errores) . " errores, estos han sido:</p>";
    }
    echo "<ol>";
    foreach ($errores as $key => $valor) {
        echo "<li> $valor";
    }
    echo "<ol>";
} else {
    echo "<p>Sin errores. Los datos son: </p>";
    echo "<p>Apellidos, Nombre: " . htmlspecialchars($apellidos) . ", " . htmlspecialchars($nombre) . "</p>";
    echo "<p>e-mail: " . htmlspecialchars($mail). "</p>";
    echo "<p>Edad: " . htmlspecialchars($edad) . " años</p>";
    echo "<p>Módulos matriculados: </p>";
    echo "<ol>";
    foreach ($modulos as $key => $valor) {
        echo "<li> $valor";
    }
    echo "</ol>";
}
?>
</body>
</html>