<?php
/*
 Aplicación Nº 2 (Mostrar fecha y estación)
 Obtenga la fecha actual del servidor (función date ) y luego imprímala dentro de la página con
 distintos formatos (seleccione los formatos que más le guste). Además indicar que estación del
 año es. Utilizar una estructura selectiva múltiple.
 
 VIZGARRA.LIVON.DANIEL
 */
 
$value = date('d/m/Y');
echo "fecha actual: ",$value, "<br/>";

$dia=date("d");
$mes=date("m");     
echo "Dia: ", $dia, "<br/>";
echo "Mes: ", $mes, "<br/>";

switch ($mes) {
    case '1':
        echo "Es Verano";
        break;
    case '2':
        echo "Es Verano";
        break;
    case '3':
        echo "Es Verano";
        break;
    case '4':
        echo "Es Otoño";
        break;
    case '5':
        echo "Es Otoño";
        break;
    case '6':
        if($dia > 20) {echo "Es Invierno";}
        else{echo "Es Otoño";}
        break;
    case '7':
        echo "Es Invierno";
        break;
    case '8':
        echo "Es Invierno";
        break;
    case '9':
        if($dia > 20) {echo "Es Primavera";}
        else{echo "Es Invierno";}
        break;
    case '10':
        echo "Es Primavera";
        break;
    case '11':
        echo "Es Primera";
        break;
    case '12':
        if($dia > 20) {echo "Es Verano";}
        else{echo "Es Primavera";}
        break;
    default:
        # code...
        break;
}

// Verano (21 de diciembre a 20 de marzo). >1221 && <0320 
// Otoño (21 de marzo a 20 de junio).
// Invierno (21 de junio a 20 de septiembre).
// Primavera (21 de septiembre a 20 de diciembre).
?>