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

    echo "</br>a- la cantidad de pizzas vendidas: ".Venta::Filtro_a();

    if(isset($_GET["fecha1"]) && isset($_GET["fecha2"])){
        $fecha1 = $_GET["fecha1"];
        $fecha2 = $_GET["fecha2"];
        echo "</br>b- el listado de ventas entre dos fechas ordenado por sabor: ";  
        Venta::Listar(Venta::Filtro_b($fecha1, $fecha2));
    } else {
        echo "</br>FALTAN DATOS PARA EL FILTRO 'b'";
    }
    if(isset($_GET["mail"])){
        echo "</br>c- el listado de ventas de un usuario ingresado: ";
        Venta::Listar(Venta::Filtro_c($_GET["mail"]));
    } else {
        echo "</br>FALTAN DATOS PARA EL FILTRO 'c'";
    }
    if(isset($_GET["sabor"])){
        echo "</br>d- el listado de ventas de un sabor ingresado: "; 
        Venta::Listar(Venta::Filtro_d($_GET["sabor"]));
    } else {
        echo "</br>FALTAN DATOS PARA EL FILTRO 'c'";
    }
?>