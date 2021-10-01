<?php
    $opcion = $_GET["opcion"];
    $metodo = $_SERVER['REQUEST_METHOD']; //devuelve el tipo d request q se envio
    $error = "No se puede procesar! </br>'F'iltros van con 'F' mayusc xq no tenia ganas d validarlo";

    switch($metodo){
        case 'POST':
            switch($opcion){
                case 'registro':
                    include_once "Registro.php";
                    break;
                case 'login': //echo "llego REGISTRO!";
                    include_once "Login.php";
                    break;
                case 'alta': //echo "llego DELETE!";
                    include_once "altaProducto.php";
                    break;
                case 'venta': //echo "llego MODIFICACION!";
                    include_once "RealizarVenta.php";
                    break;
                case 'modificacionUsuario': //echo "llego MODIFICACION!";
                    include_once "ModificacionUsuario.php";
                    break;
                case 'modificacionProducto': //echo "llego MODIFICACION!";
                    include_once "ModificacionProducto.php";
                    break;
                default: echo $error; 
                    break;
            } break;
        case 'GET': //echo "llego GET!";
            if($opcion == "Listado.php"){
            } else if($opcion == 'Filtro A' || $opcion == 'Filtro J'){ 
                include_once "FiltrosUsuario.php";
            } else if($opcion == 'Filtro B' || $opcion == 'Filtro E'){ 
                include_once "FiltrosProducto.php";
            } else if($opcion == 'Filtro C' || $opcion == 'Filtro D' || $opcion == 'Filtro F' || $opcion == 'Filtro G'|| $opcion == 'Filtro H'|| $opcion == 'Filtro I' || $opcion == 'Filtro K'){
                include_once "FiltrosVenta.php";
            } else{
                echo $error;
            }
            break;
        case 'PATCH':echo "llego PATCH!";
            break;
        case 'DELETE': echo "llego DEELTE!";
            break;
        default: echo $error;
            break;
    }


?>