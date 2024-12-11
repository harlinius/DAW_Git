<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejemplo</title>
</head>

<body>
    <?php
    if (isset($_POST["enviado"])) {
        $conProyecto = new mysqli('localhost', 'gestor', 'secreto', 'proyecto');

        $cod = $_POST["input"];
        
        //Hacemos que mariadb permita la ejecución de varias sentencias al mismo tiempo
        $resultado = $conProyecto->multi_query("INSERT INTO familias(cod) VALUES ('$cod');");
    } else {
    ?>
        <form method="POST">
            <input type="text" name="input" value="DAW'); DELETE FROM familias WHERE 1; --" />
            <button type="submit" name="enviado">Enivar</button>
        </form>
    <?php
    }
    ?>
</body>

</html>