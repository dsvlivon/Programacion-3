<?php
// Aplicación No 12 (Invertir palabra)
// Realizar el desarrollo de una función que reciba un Array de caracteres y que invierta el orden
// de las letras del Array.
// Ejemplo: Se recibe la palabra “HOLA” y luego queda “ALOH”.

// VIZGARRA.LIVON.DANIEL
    $miArray = array();
    $miArray = ["a","b","c","d","e"];
    
    function arrayReverse($array){
        $j = count($array)-1;
        
        for ($i=0; $i <= count($array); $i++) { 
            // echo "<br>". $array[$i];
            echo "<br>",$array[$j];
            $j --;
        }
    }
    arrayReverse($miArray);
?>