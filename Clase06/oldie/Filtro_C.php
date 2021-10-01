<?php
// Funciones de filtrado:
// se deben realizar la funciones que reciban datos por parámetros y puedan
// ejecutar la consulta para responder a los siguientes requerimientos

// C. Obtener todas las compras filtradas entre dos cantidades.
// VIZGARRA.LIVON.DANIEL

include_once "Venta.php";

    echo "Filtro C</br></br>"; 
    echo "INGRESE: cantidad 1, cantidad 2</br></br>"; 
    
    if(isset($_GET["cantidad1"]) && isset($_GET["cantidad2"])){
        $q1 = $_GET["cantidad1"];
        $q2 = $_GET["cantidad2"];
        Venta::Filtro_C($q1, $q2);
    } else {
        echo "FALTAN DATOS!";
    }
?>