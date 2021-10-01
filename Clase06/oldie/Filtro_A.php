<?php
// Funciones de filtrado:
// se deben realizar la funciones que reciban datos por parámetros y puedan
// ejecutar la consulta para responder a los siguientes requerimientos

// A. Obtener los detalles completos de todos los usuarios y poder ordenarlos
// alfabéticamente de forma ascendente o descendente.

// VIZGARRA.LIVON.DANIEL

include_once "Usuario.php";

    echo "Filtro A</br></br>"; 
    echo "INGRESE: orden</br></br>"; 
    
    if(isset($_GET["orden"])){
        $orden = $_GET["orden"];
        Usuario::Filtro_A($orden);
    } else {
        echo "FALTAN DATOS!";
    }
?>