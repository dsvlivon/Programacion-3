<?php
// VIZGARRA.LIVON.DANIEL

include_once "Venta.php";   
    if(isset($_POST["mail"]) && isset($_POST["sabor"]) && isset($_POST["cantidad"]) && isset($_POST["tipo"])){
        $mail = $_POST["mail"];
        $sabor = $_POST["sabor"];
        $tipo = $_POST["tipo"];
        $cantidad = $_POST["cantidad"];
        $date = new datetime("now");
        $foto = $_FILES["foto"]; 

        $x = new Venta();//fecha, número de pedido y id autoincremental
    
        $x->Setter(NULL, NULL, $mail, $date->format("Y-m-d"), $cantidad, $sabor, $tipo);
        $x->MostrarVenta();
        echo $x->Vender($foto);
    } else {
        echo "FALTAN DATOS!";
    }
?>