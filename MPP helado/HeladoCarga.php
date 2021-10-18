<?php

// VIZGARRA.LIVON.DANIEL

include_once "Helado.php";
   
    if(isset($_GET["sabor"]) && isset($_GET["cantidad"]) && isset($_GET["tipo"]) && isset($_GET["precio"])){
        $archivo = "Helado.json";
        $sabor = $_GET["sabor"]; 
        $tipo = $_GET["tipo"];
        $cantidad = $_GET["cantidad"];
        $precio = $_GET["precio"];
        $id = rand(1,10000);
        
        $p = new Helado();//$id, $sabor, $tipo, $cantidad, $precio
        $p->Setter($id, $sabor, $tipo, $cantidad, $precio);
    
        $lista = Helado::ReadJson($archivo);
        // Helado::Listar($lista);

        Helado::validarStock($lista, $p, $archivo);
    } else {
        echo "FALTAN DATOS!";
    }
?>