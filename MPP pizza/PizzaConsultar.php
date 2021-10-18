<?php

// VIZGARRA.LIVON.DANIEL

include_once "Pizza.php";
    echo "INGRESE: sabor, tipo</br></br>";
 
    if(isset($_POST["sabor"]) && isset($_POST["tipo"])){
        $archivo = "Pizza.json";
        $sabor = $_POST["sabor"]; 
        $tipo = $_POST["tipo"];

        $p = new Pizza();//$id, $sabor, $tipo, $cantidad, $precio
        $p->Setter(NULL, $sabor, $tipo, NULL, NULL);
            
        $lista = Pizza::ReadJson($archivo);
        // Pizza::Listar($lista);

        echo Pizza::buscarStock($lista, $p);
    } else {
        echo "FALTAN DATOS!";
    }
?>