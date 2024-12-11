<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Variables especiales de PHP</title>
</head>

<body>
    <form method="get" action="#">
        <label for="nombre">Correo electrónico:</label>
        <input type="text" name="nombre" id="nombre" required>
        <input type="submit" value="Enviar">
    </form>

    <br>

    <form method="post" action="#">
        <label for="email">Correo electrónico:</label>
        <input type="email" name="email" id="email" required>
        <input type="submit" value="Enviar">
    </form>

    <br>

    <!-- Formulario HTML para subir un archivo -->
    <form method="POST" enctype="multipart/form-data">
        <input type="file" name="archivo" required>
        <input type="submit" value="Subir archivo">
    </form>
    <?php
    //Ejemplos de $_SERVER
    //guion que se está ejecutando actualmente.
    print ("<p>" . $_SERVER['PHP_SELF'] . "</p>");
    //dirección IP del servidor web.
    print ("<p>" . $_SERVER['SERVER_ADDR'] . "</p>");
    //nombre del servidor web.
    print ("<p>" . $_SERVER['SERVER_NAME'] . "</p>");
    //directorio raíz bajo el que se ejecuta el guión actual.
    print ("<p>" . $_SERVER['DOCUMENT_ROOT'] . "</p>");
    //dirección IP desde la que el usuario está viendo la página.
    print ("<p>" . $_SERVER['REMOTE_ADDR'] . "</p>");
    //método utilizado para acceder a la página ('GET', 'HEAD', 'POST' o 'PUT')
    print ("<p>" . $_SERVER['REQUEST_METHOD'] . "</p>");

    //Ejemplo de $_GET 
    //?nombre=Esther -> ?key=value
    if (isset($_GET['nombre'])) {
        $nombre = htmlspecialchars($_GET['nombre']);
        echo "<p>GET - Hola, $nombre!</p>";
    } else {
        echo "<p>GET - No se proporcionó un nombre.</p>";
    }


    //Ejemplo de $_POST
    //Envío de datos desde el formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['email'])) {
            $email = htmlspecialchars($_POST['email']);
            echo "<p>POST - El correo electrónico ingresado es: $email</p>";
        }
    }

    //Ejemplo de $_COOKIE
    if (isset($_COOKIE['usuario'])) {
        echo "<p>COOKIE - Bienvenido de nuevo, " . htmlspecialchars($_COOKIE['usuario']) . "</p>";
    } else {
        setcookie('usuario', 'Esther', time() + 3600); // cookie válida por 1 hora
        echo "<p>COOKIE - Cookie creada. Vuelve a cargar la página.</p>";
    }

    //Ejemplo de $_REQUEST
    if (isset($_REQUEST['nombre'])) {
        $nombre = htmlspecialchars($_REQUEST['nombre']);
        echo "<p>REQUEST - Hola, $nombre!</p>";
    }
    if (isset($_REQUEST['email'])) {
        $email = htmlspecialchars($_REQUEST['email']);
        echo "<p>REQUEST - Hola, $email!</p>";
    }
    if (isset($_REQUEST['usuario'])) { //No incluye las cookies como parámetros de formulario.
        $usuario = htmlspecialchars($_REQUEST['usuario']);
        echo "<p>REQUEST - Hola, $usuario!</p>";
    }

    var_dump($_REQUEST);
    

    // Ejemplo de variables de entorno
    // Establecer una variable de entorno
    putenv('MI_VARIABLE=Hola Mundo');
    echo '<p>VARIABLES DE ENTORNO - La variable de entorno MI_VARIABLE es: ' . getenv('MI_VARIABLE') . '</p>';

    //Ejemplo de $_FILES
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_FILES['archivo'])) {
            $archivo = $_FILES['archivo'];
            var_dump($archivo);
            // Comprobar si se subió correctamente
            if ($archivo['error'] === UPLOAD_ERR_OK) {
                // Mover el archivo a una ubicación en el servidor
                move_uploaded_file($archivo['tmp_name'], 'uploads/' . $archivo['name']);
                echo '<p>FILES - Archivo subido: ' . $archivo['name'] . "</p>";
            } else {
                echo '<p>FILES - Error al subir el archivo.</p>';
            }
        }
    }

    //Ejemplo de $_SESSION
    
    // Establecer una variable de sesión
    $_SESSION['usuario'] = 'Esther';

    // Acceder a la variable de sesión
    echo '<p>SESSION - El usuario actual es: ' . $_SESSION['usuario'] . '</p>';

    // Eliminar la variable de sesión
    unset($_SESSION['usuario']);
    //echo '<p>SESSION - El usuario actual es: ' . $_SESSION['usuario'] . '</p>';
    
    //Ejemplo de $GLOBALS
    $variable_global = 'Soy una variable global';

    function mostrarVariableGlobal()
    {
        //Lo que vimos en la tutoría 2
        /*
        global $variableGlobal;
        echo $variableGlobal;
        */
        // Acceder a la variable global usando $GLOBALS
        echo '<p>GLOBALS - Desde la función: ' . $GLOBALS['variable_global'] . '</p>';
    }

    mostrarVariableGlobal();

    ?>
</body>

</html>