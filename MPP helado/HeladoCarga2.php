<?php

// VIZGARRA.LIVON.DANIEL

include_once "Helado.php";
    if(isset($_POST["sabor"]) && isset($_POST["cantidad"]) && isset($_POST["tipo"]) && isset($_POST["precio"])){
        $archivo = "Helado.json";
        $sabor = $_POST["sabor"]; 
        $tipo = $_POST["tipo"];
        $cantidad = $_POST["cantidad"];
        $precio = $_POST["precio"];
        $id = rand(1,10000);
        
        
        $p = new Helado();//$id, $sabor, $tipo, $cantidad, $precio
        $p->Setter($id, $sabor, $tipo, $cantidad, $precio);
    
        $lista = Helado::ReadJson($archivo);
        // Pizza::Listar($lista);

        Helado::validarStock($lista, $p, $archivo);
    } else {
        echo "FALTAN DATOS!";
    }
?>