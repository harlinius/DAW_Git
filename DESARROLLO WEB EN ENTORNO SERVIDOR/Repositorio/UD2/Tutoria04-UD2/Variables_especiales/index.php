<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Variables especiales de PHP</title>
</head>

<body>
    <form method="post" action="#">
        <label for="email">Correo electrónico:</label>
        <input type="email" name="email" id="email" required>
        <input type="submit" value="Enviar">
    </form>

    <br>
    <?php
    //Ejemplos de $_SERVER
    print ("<p>" . $_SERVER['PHP_SELF'] . "</p>");
    print ("<p>" . $_SERVER['SERVER_ADDR'] . "</p>");
    print ("<p>" . $_SERVER['SERVER_NAME'] . "</p>");
    print ("<p>" . $_SERVER['DOCUMENT_ROOT'] . "</p>");
    print ("<p>" . $_SERVER['REMOTE_ADDR'] . "</p>");
    print ("<p>" . $_SERVER['REQUEST_METHOD'] . "</p>");

    //Ejemplo de $_GET
    if (isset($_GET['nombre'])) {
        $nombre = htmlspecialchars($_GET['nombre']);
        echo "<p>GET - Hola, $nombre!</p>";
    } else {
        echo "<p>GET - No se proporcionó un nombre.</p>";
    }


    //Ejemplo de $_POST
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

    ?>
</body>

</html>