<?php
// Aplicación Nº 31 (RealizarVenta BD )
// Archivo: RealizarVenta.php
// método:POST
// Recibe los datos del producto(código de barra), del usuario (el id )y la cantidad de ítems ,por
// POST .
// Verificar que el usuario y el producto exista y tenga stock.
// Retorna un :
// “venta realizada”Se hizo una venta
// “no se pudo hacer“si no se pudo hacer
// Hacer los métodos necesarios en las clases

// VIZGARRA.LIVON.DANIEL

include_once "Venta.php";

    echo "Aplicacion 31 - RealizarVenta</br></br>";   
    echo "INGRESE: codigo, idProducto, cantidad, idUsuario</br></br>";   
    
    if(isset($_POST["codigo"]) && isset($_POST["idProducto"]) && isset($_POST["cantidad"]) && isset($_POST["idUsuario"])){
        $codigo = $_POST["codigo"];
        $idProducto = $_POST["idProducto"];
        $cantidad = $_POST["cantidad"];
        $idUsuario = $_POST["idUsuario"];
        $date = new datetime("now");

        $v = new Venta();
        //function Setter($codigo, $idUsuario, $cantidad, $fechaVenta, $idProducto)
        $v->Setter($codigo, $idUsuario, $cantidad, $date->format("Y-m-d"), $idProducto);
        $v->MostrarVenta();
        echo $v->Vender2();
    } else {
        echo "FALTAN DATOS!";
    }
?>