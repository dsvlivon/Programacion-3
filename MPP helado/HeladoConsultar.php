<?php

// VIZGARRA.LIVON.DANIEL

include_once "Helado.php";
 
    if(isset($_POST["sabor"]) && isset($_POST["tipo"])){
        $archivo = "Helado.json";
        $sabor = $_POST["sabor"]; 
        $tipo = $_POST["tipo"];

        $x = new Helado();//$id, $sabor, $tipo, $cantidad, $precio
        $x->Setter(null, $sabor, $tipo, null, null);
    
        $lista = Helado::ReadJson($archivo);
        // Helado::Listar($lista);

        echo Helado::buscarStock($lista, $x);
    } else {
        echo "FALTAN DATOS!";
    }
?>