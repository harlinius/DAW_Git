<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Condicionales</title>
</head>

<body style="background-color: antiquewhite">
    <?php

    //Ejemplo de goto
    $a = 1;
    goto salto;
    $a++;  //esta sentencia no se ejecuta
    salto:
    echo $a;  // el valor obtenido es 1
    
    //Ejemplo de if / elseif / else
    $a = 4;
    $b = 4;
    if ($a < $b){
        print "<p> IF/ELSEIF/ELSE - a es menor que b</p>";
    }
    elseif ($a > $b){
        print "<p> IF/ELSEIF/ELSE - a es mayor que b</p>";
    }
    else{
        print "<p> IF/ELSEIF/ELSE - a es igual a b</p>";
    }

    //Ejemplo de switch
    switch ($a) {
        case 0:
            print "<p> SWITCH - a vale 0</p>";
            break;
        case 1:
            print "<p> SWITCH - a vale 1</p>";
            break;
        default:
            print "<p> SWITCH - a no vale 0 ni 1</p>";
    }
    ?>
</body>

</html>