<?php
// Funciones de filtrado:
// se deben realizar la funciones que reciban datos por parámetros y puedan
// ejecutar la consulta para responder a los siguientes requerimientos

// C. Obtener todas las compras filtradas entre dos cantidades.
// D. Obtener la cantidad total de todos los productos vendidos entre dos fechas.
// F. Mostrar los nombres del usuario y los nombres de los productos de cada venta.
// G. Indicar el monto (cantidad * precio) por cada una de las ventas.
// H. Obtener la cantidad total de un producto (ejemplo:1003) vendido por un usuario (ejemplo: 104).
// I. Obtener todos los números de los productos vendidos por algún usuario filtrado por localidad (ejemplo: ‘Avellaneda’).
// K. Mostrar las ventas entre dos fechas del año.

// VIZGARRA.LIVON.DANIEL

include_once "Venta.php";
    $opcion = $_GET["opcion"];

    switch($opcion){
        case 'Filtro C': 
            echo "Filtro C</br>"; 
            echo "INGRESE: cantidad 1, cantidad 2</br></br>"; 
            
            if(isset($_GET["cantidad1"]) && isset($_GET["cantidad2"])){
                $q1 = $_GET["cantidad1"];
                $q2 = $_GET["cantidad2"];
                Venta::Filtro_C($q1, $q2);
            } else {
                echo "FALTAN DATOS!";
            }
        break;
        case 'Filtro D': 
            echo "Filtro D</br>"; 
            echo "INGRESE: fecha 1, fecha 2 (Formato: yyyy-mm-dd)</br></br>"; 
            
            if(isset($_GET["fecha1"]) && isset($_GET["fecha2"])){
                $fecha1 = $_GET["fecha1"];
                $fecha2 = $_GET["fecha2"];
                Venta::Filtro_D($fecha1, $fecha2);
            } else {
                echo "FALTAN DATOS!";
            }   
        break;
        case 'Filtro F': 
            echo "Filtro F</br>"; 
            echo "NO INGRESE parametros opcionales!</br></br>"; 
            Venta::Filtro_F();
        break;
        case 'Filtro G': 
            echo "Filtro G</br>"; 
            echo "NO INGRESE parametros opcionales!</br></br>"; 
            Venta::Filtro_G();
        break;
        case 'Filtro H': 
            echo "Filtro H</br>"; 
            echo "INGRESE: idUsuario, idProducto</br></br>"; 
            
            if(isset($_GET["idUsuario"]) && isset($_GET["idProducto"])){
                $idUsuario = $_GET["idUsuario"];
                $idProucto = $_GET["idProducto"];
                Venta::Filtro_H($idUsuario, $idProucto);
            } else {
                echo "FALTAN DATOS!";
            }
        break;
        case 'Filtro I': 
            echo "Filtro I</br>"; 
            echo "INGRESE: localidad</br></br>"; 
            
            if(isset($_GET["localidad"])){
                $localidad = $_GET["localidad"];
                Venta::Filtro_I($localidad);
            } else {
                echo "FALTAN DATOS!";
            }
        break;
        case 'Filtro K': 
            echo "Filtro K</br>"; 
            echo "INGRESE: fecha 1, fecha 2 (Formato: yyyy-mm-dd)</br></br>"; 
            
            if(isset($_GET["fecha1"]) && isset($_GET["fecha2"])){
                $fecha1 = $_GET["fecha1"];
                $fecha2 = $_GET["fecha2"];
                Venta::Filtro_K($fecha1, $fecha2);
            } else {
                echo "FALTAN DATOS!";
            }
        break;
        default: echo "¿¿¿F???";
        break;
    }
?>