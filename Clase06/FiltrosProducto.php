<?php
// Funciones de filtrado:
// se deben realizar la funciones que reciban datos por parámetros y puedan
// ejecutar la consulta para responder a los siguientes requerimientos

// B. Obtener los detalles completos de todos los productos y poder ordenarlos
// alfabéticamente de forma ascendente y descendente.
// E. Mostrar los primeros “N” números de productos que se han enviado.

// VIZGARRA.LIVON.DANIEL

include_once "Producto.php";

    $opcion = $_GET["opcion"];
        
    if($opcion == 'Filtro B'){
        echo "Filtro B</br></br>"; 
        echo "INGRESE: orden</br></br>"; 
        
        if(isset($_GET["orden"])){
            $orden = $_GET["orden"];
        Producto::Filtro_B($orden);
        } else {
            echo "FALTAN DATOS!";
        }
    } else if($opcion == 'Filtro E'){
        echo "Filtro E</br></br>"; 
        echo "INGRESE: cantidad</br></br>"; 
        
        if(isset($_GET["cantidad1"])){
        $cantidad = $_GET["cantidad1"];
        Producto::Filtro_E($cantidad);
        } else {
            echo "FALTAN DATOS!";
        }
    }
?>