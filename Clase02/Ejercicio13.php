<?php
// Aplicación No 13 (Invertir palabra)
// Crear una función que reciba como parámetro un string ($palabra) y un entero ($max). La
// función validará que la cantidad de caracteres que tiene $palabra no supere a $max y además
// deberá determinar si ese valor se encuentra dentro del siguiente listado de palabras válidas:
// “Recuperatorio”, “Parcial” y “Programacion”. Los valores de retorno serán:
// 1 si la palabra pertenece a algún elemento del listado.
// 0 en caso contrario.

// VIZGARRA.LIVON.DANIEL

$palabra = "Parcialx";
$palabra2 = "Parcial";
$max = 7;

function funcionQueNoIviertePalabra($cadena, $numero){
        $listadoVerificado = ["Recuperatorio", "Parcial", "Programacion"];
        if(strlen($cadena)<=$numero){ //echo strlen($cadena);
                echo "buscando: ". $cadena . "</br>";        
                foreach ($listadoVerificado as $val) {// echo $val."</br>";
                    if(strcmp($cadena, $val)==0){
                        echo "se encontro: ". $val;
                    }
                    // else{echo "no hay coincidencias!</br>";}
                }
        }
        else{
            echo "</br> Fuera de parametros!";
        }
    }
    
    funcionQueNoIviertePalabra($palabra, $max);
    funcionQueNoIviertePalabra($palabra2, $max);
?>