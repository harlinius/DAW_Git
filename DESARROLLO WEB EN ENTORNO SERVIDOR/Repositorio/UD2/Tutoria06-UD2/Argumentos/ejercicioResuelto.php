<!DOCTYPE html>
<?php 
    //incluimos el archivo "funciones.php"
    include "funciones.php";
    function mostrarPrimos($inicio, $cantidad=10){
        //si no especifico nada, cantidad=10
        $cont=0;
        while($cont<$cantidad){
            if(isPrimo($inicio)){
                echo '<strong>'. ++$cont . '=></strong> '. $inicio. '<br>';
            }
            $inicio++;
        }
    }
?>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Funciones - Ejercicio Primos</title>
</head>
<body style="background:bisque">
<h3 style="text-align:center; font-weight:bold">Solución Propuesta Ejercicio Primos</h3>
<p>Con la ayuda de las funciones que necesites, haz un programa que, dados dos número enteros positivos, inicio y cantidad, nos muestre la cantidad de números primos a partir de inicio, si no pasamos ningún valor cantidad=10.</p>
<?php
    $cantidad=20;
    $inicio=5;
    mostrarPrimos($inicio, $cantidad);
    //Nos deberá mostrar los primeros 10 primos a partir del número 1
?>
</body>
</html>