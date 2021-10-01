<?php
// Funciones de filtrado:
// se deben realizar la funciones que reciban datos por parámetros y puedan
// ejecutar la consulta para responder a los siguientes requerimientos

// E. Mostrar los primeros “N” números de productos que se han enviado.

// VIZGARRA.LIVON.DANIEL

include_once "Producto.php";

    echo "Filtro E</br></br>"; 
    echo "INGRESE: cantidad</br></br>"; 
    
    if(isset($_GET["cantidad1"])){
        $cantidad = $_GET["cantidad1"];
        Producto::Filtro_E($cantidad);
    } else {
        echo "FALTAN DATOS!";
    }
?>