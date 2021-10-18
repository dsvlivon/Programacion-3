<?php

// VIZGARRA.LIVON.DANIEL

include_once "Pizza.php";
    echo "INGRESE: sabor, precio, tipo, cantidad</br></br>";
 
    if(isset($_GET["sabor"]) && isset($_GET["cantidad"]) && isset($_GET["tipo"]) && isset($_GET["precio"])){
        $archivo = "Pizza.json";
        $sabor = $_GET["sabor"]; 
        $tipo = $_GET["tipo"];
        $cantidad = $_GET["cantidad"];
        $precio = $_GET["precio"];
        $id = rand(1,10000);
        
        $p = new Pizza();//$id, $sabor, $tipo, $cantidad, $precio
        $p->Setter($id, $sabor, $tipo, $cantidad, $precio);
    
        $lista = Pizza::ReadJson($archivo);
        // Pizza::Listar($lista);

        Pizza::validarStock($lista, $p, $archivo);
    } else {
        echo "FALTAN DATOS!";
    }
?>