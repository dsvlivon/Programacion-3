<?php
// Funciones de filtrado:
// se deben realizar la funciones que reciban datos por parámetros y puedan
// ejecutar la consulta para responder a los siguientes requerimientos

// B. Obtener los detalles completos de todos los productos y poder ordenarlos
// alfabéticamente de forma ascendente y descendente.

// VIZGARRA.LIVON.DANIEL

include_once "Producto.php";

    echo "Filtro B</br></br>"; 
    echo "INGRESE: orden</br></br>"; 
    
    if(isset($_GET["orden"])){
        $orden = $_GET["orden"];
       Producto::Filtro_B($orden);
    } else {
        echo "FALTAN DATOS!";
    }
?>