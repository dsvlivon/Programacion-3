<?php
// VIZGARRA.LIVON.DANIEL

    include_once "Venta.php";
    $method = $_SERVER['REQUEST_METHOD'];
    if ('DELETE' === $method) { 
        parse_str(file_get_contents('php://input'), $_DELETE);
        
        $numeroPedido = $_DELETE["numeroPedido"]; //echo "n°: ".$numeroPedido."</br>";
        echo "SE VA A BORRAR EL REGISTRO N°: ".$numeroPedido."</br>";

        echo Venta::Borrar($numeroPedido);
    } else {
        echo "FALTAN DATOS!";
    }
?>