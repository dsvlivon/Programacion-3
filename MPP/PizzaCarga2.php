<?php

// VIZGARRA.LIVON.DANIEL

include_once "Pizza.php";
    echo "INGRESE: sabor, precio, tipo, cantidad</br></br>";
 
    if(isset($_POST["sabor"]) && isset($_POST["cantidad"]) && isset($_POST["tipo"]) && isset($_POST["precio"])){
        $archivo = "Pizza.json";
        $sabor = $_POST["sabor"]; 
        $tipo = $_POST["tipo"];
        $cantidad = $_POST["cantidad"];
        $precio = $_POST["precio"];
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