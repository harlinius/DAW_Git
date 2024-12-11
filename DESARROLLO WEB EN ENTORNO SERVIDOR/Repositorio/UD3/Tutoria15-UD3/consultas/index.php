<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    @$conProyecto = new mysqli('localhost', 'gestor', 'secreto', 'proyecto');
    $error = $conProyecto->connect_errno;
    if ($error == null) {
        $resultado = $conProyecto->query('DELETE FROM stocks WHERE unidades=0');
        if ($resultado) {
            echo "<p>Se han borrado {$conProyecto->affected_rows} registros.</p>"; //$conProyecto->affected_rows me dará las filas afectadas por la sentencia inmediatamente anterior.
        }

        $resultado = $conProyecto->query('SELECT producto, unidades FROM stocks');
        var_dump($resultado);
        // Verificar si hay resultados
        echo ("<h2>Filas encontradas: " . $resultado->num_rows . " </h2>");
        if ($resultado && $resultado->num_rows > 0) {
            echo "<table border='1'>";
            echo "<tr><th>Producto</th><th>Unidades</th></tr>";

            // Iterar sobre los resultados
            while ($fila = $resultado->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($fila['producto']) . "</td>";
                echo "<td>" . htmlspecialchars($fila['unidades']) . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "No se encontraron datos en la tabla de stocks.";
        }

        //Tutoría 16 => USE_RESULT VS STORE_RESULT
        $resultado->free();

        if ($conProyecto->connect_error) {
            die("Error en la conexión: " . $conProyecto->connect_error);
        }

        // Consulta usando MYSQLI_USE_RESULT
        $resultado = $conProyecto->query('SELECT * FROM stocks', MYSQLI_USE_RESULT);

        echo ("<h2>Filas encontradas: " . $resultado->num_rows . " </h2>");
        if ($resultado) {
            // Procesar los resultados progresivamente
            while ($fila = $resultado->fetch_assoc()) {
                echo "Producto: " . $fila['producto'] . " - Unidades: " . $fila['unidades'] . "<br>";
            }
            // Nota: No puedes hacer más consultas aquí hasta que termines con el resultado actual.
            $resultado->free();
        } else {
            echo "Error en la consulta: " . $conProyecto->error;
        }

        //Tutoría 16 => real_query()

        // Ejecutar la consulta SELECT con real_query() con use_result()
        $query = 'SELECT producto, unidades FROM stocks';

        if ($conProyecto->real_query($query)) {
            // Recuperar los resultados con store_result()
            $resultado = $conProyecto->store_result();

            echo ("<h2>Filas encontradas: " . $resultado->num_rows . " </h2>");
            if ($resultado && $resultado->num_rows > 0) {
                // Mostrar resultados en una tabla HTML
                echo "<table border='1'>";
                echo "<tr><th>Producto</th><th>Unidades</th></tr>";
                while ($fila = $resultado->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($fila['producto']) . "</td>";
                    echo "<td>" . htmlspecialchars($fila['unidades']) . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "No se encontraron datos en la tabla de stocks.";
            }

            // Liberar resultados
            $resultado->free();
        } else {
            echo "Error en la consulta: " . $conProyecto->error;
        }

        
        // Ejecutar la consulta SELECT con real_query() con use_result()
        $query = 'SELECT producto, unidades FROM stocks';

        if ($conProyecto->real_query($query)) {
            // Recuperar los resultados con use_result()
            $resultado = $conProyecto->use_result();

            echo ("<h2>Filas encontradas: " . $resultado->num_rows . " </h2>");
            if ($resultado) {
                // Mostrar resultados en una tabla HTML
                echo "<table border='1'>";
                echo "<tr><th>Producto</th><th>Unidades</th></tr>";
                while ($fila = $resultado->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($fila['producto']) . "</td>";
                    echo "<td>" . htmlspecialchars($fila['unidades']) . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "No se encontraron datos en la tabla de stocks.";
            }

            // Liberar resultados
            $resultado->free();
        } else {
            echo "Error en la consulta: " . $conProyecto->error;
        }
        $conProyecto->close();
    }
    ?>
</body>

</html>