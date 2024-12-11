<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio Resuelto Condicionales</title>
</head>

<body>
    <h1>Seleccione el tipo de motor</h1>
    <form method="POST" action="">
        <label for="motor">Tipo de motor:</label>
        <select name="motor" id="motor">
            <option value="1">Gasolina</option>
            <option value="2">Diésel</option>
            <option value="3">Motocicleta</option>
            <option value="4">Eléctrico</option>
        </select>
        <button type="submit">Enviar</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Recoger el valor del formulario
        $motor = $_POST['motor'];

        echo "<h2>Resultado:</h2>";
        
        // 1.- Con if elseif else ---------------------------------------------
        if ($motor == 1) {
            echo "El motor es de Gasolina<br>";
        } elseif ($motor == 2) {
            echo "El motor es Diesel<br>";
        } elseif ($motor == 3) {
            echo "El motor es de una Motocicleta<br>";
        } elseif ($motor == 4) {
            echo "El motor es Eléctrico<br>";
        } else {
            echo "Error, el tipo de motor NO es válido<br>";
        }

        // 2.- Con switch -----------------------------------------------------
        echo "<h3>Con switch:</h3>";
        switch ($motor) {
            case 1:
                echo "El motor es de Gasolina<br>";
                break;
            case 2:
                echo "El motor es Diesel<br>";
                break;
            case 3:
                echo "El motor es de una Motocicleta<br>";
                break;
            case 4:
                echo "El motor es Eléctrico<br>";
                break;
            default:
                echo "Error, el tipo de motor NO es válido<br>";
        }
    }
    ?>

    <br>
    <a href="index.php">Ejercicio simple</a>
</body>

</html>
