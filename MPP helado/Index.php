<?php
    $opcion = $_GET["opcion"];
    $metodo = $_SERVER['REQUEST_METHOD']; //devuelve el tipo d request q se envio
    $error = "No se puede procesar! </br>Entro al default";

    switch($metodo){
        case 'POST':
            switch($opcion){
                case 'HeladoConsultar':
                    include_once "HeladoConsultar.php";
                    break;
                case 'AltaVenta':
                    include_once "AltaVenta.php";
                    break;
                case 'HeladoCarga2':
                    include_once "HeladoCarga2.php";
                    break;
                default: echo $error; 
                    break;
            } 
            break;
        case 'GET': //echo "llego GET!";
            if($opcion == "HeladoCarga"){
                include_once "HeladoCarga.php";
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