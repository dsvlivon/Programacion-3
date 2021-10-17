<?php
    $opcion = $_GET["opcion"];
    $metodo = $_SERVER['REQUEST_METHOD']; //devuelve el tipo d request q se envio
    $error = "No se puede procesar! </br>'F'iltros van con 'F' mayusc xq no tenia ganas d validarlo";

    switch($metodo){
        case 'POST':
            switch($opcion){
                case 'PizzaConsultar':
                    include_once "PizzaConsultar.php";
                    break;
                case 'AltaVenta':
                    include_once "AltaVenta.php";
                    break;
                case 'PizzaCargar2':
                    include_once "PizzaCarga2.php";
                    break;
                default: echo $error; 
                    break;
            } 
            break;
        case 'GET': //echo "llego GET!";
            if($opcion == "PizzaCarga"){
                include_once "PizzaCarga.php";
            } else if ($opcion == "ConsultasVentas"){
                include_once "ConsultasVentas.php";
            }
            break;
        case 'PUT': //echo "llego PATCH!";
            include_once "ModificarVenta.php";
            break;
        case 'DELETE': //echo "llego DELETE!";
            include_once "BorrarVenta.php";
            break;
        default: echo $error;
            break;
    }


?>