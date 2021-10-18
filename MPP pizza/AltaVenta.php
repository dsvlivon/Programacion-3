<?php
// VIZGARRA.LIVON.DANIEL

include_once "Venta.php";
        //email del usuario y el sabor,tipo y cantidad
        echo "INGRESE: mail, sabor, tipo, cantidad</br></br>";   
    
    if(isset($_POST["mail"]) && isset($_POST["sabor"]) && isset($_POST["cantidad"]) && isset($_POST["tipo"])){
        $mail = $_POST["mail"];
        $sabor = $_POST["sabor"];
        $tipo = $_POST["tipo"];
        $cantidad = $_POST["cantidad"];
        $date = new datetime("now");
        $foto = $_FILES["foto"]; 

        $v = new Venta();//fecha, número de pedido y id autoincremental
        //Setter($id, $mail, $numeroPedido, $fechaVenta, $cantidad, $sabor
        $v->Setter(NULL, NULL, $mail, $date->format("Y-m-d"), $cantidad, $sabor, $tipo);
        
        echo $v->Vender($foto);
    } else {
        echo "FALTAN DATOS!";
    }
?>