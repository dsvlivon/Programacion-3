<?php
// Funciones de filtrado:
// se deben realizar la funciones que reciban datos por parámetros y puedan
// ejecutar la consulta para responder a los siguientes requerimientos

// D. Obtener la cantidad total de todos los productos vendidos entre dos fechas.

// VIZGARRA.LIVON.DANIEL

include_once "Venta.php";

    echo "Filtro D</br></br>"; 
    echo "INGRESE: fecha 1, fecha 2 (Formato: yyyy-mm-dd)</br></br>"; 
    
    if(isset($_GET["fecha1"]) && isset($_GET["fecha2"])){
        $fecha1 = $_GET["fecha1"];
        $fecha2 = $_GET["fecha2"];
        Venta::Filtro_D($fecha1, $fecha2);
    } else {
        echo "FALTAN DATOS!";
    }
?>