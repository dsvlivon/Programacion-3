<?php

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