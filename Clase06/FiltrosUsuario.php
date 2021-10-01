<?php
// Funciones de filtrado:
// se deben realizar la funciones que reciban datos por parámetros y puedan
// ejecutar la consulta para responder a los siguientes requerimientos

// A. Obtener los detalles completos de todos los usuarios y poder ordenarlos
// alfabéticamente de forma ascendente o descendente.
// J. Obtener los datos completos de los usuarios filtrando por letras en su nombre o
// apellido.

// VIZGARRA.LIVON.DANIEL

include_once "Usuario.php";
    $opcion = $_GET["opcion"];
    
    if($opcion == 'Filtro A'){
        echo "Filtro A</br></br>"; 
        echo "INGRESE: orden</br></br>"; 
        
        if(isset($_GET["orden"])){
            $orden = $_GET["orden"];
            Usuario::Filtro_A($orden);
        } else {
            echo "FALTAN DATOS!";
        }
    } elseif ($opcion == 'Filtro J') {
        echo "Filtro J</br></br>"; 
        echo "INGRESE: letra</br></br>"; 
        
        if(isset($_GET["letra"])){
            $letra = $_GET["letra"];
            Usuario::Filtro_J($letra);
        } else {
            echo "FALTAN DATOS!";
        }
    }

?>