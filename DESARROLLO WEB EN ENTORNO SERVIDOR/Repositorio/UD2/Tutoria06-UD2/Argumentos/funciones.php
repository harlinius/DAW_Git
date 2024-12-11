<?php
//un número primo debe tener exactamente dos divisores positivos: 1 y él mismo.

function isPrimo($num)
{
    if ($num == 1)
        return false;
    for ($i = 2; $i < $num; $i++) {
        if ($num % $i == 0)
            return false; //si encuentro un divisor distinto de 1 o $num el $num no es primo
        if ($i > $num / 2) //Cuando lleve la mitad paro por que ya no hay opción
            break; //si no he encontrado divisores a la mitad, no los encontaré depués
    }
    return true;
}