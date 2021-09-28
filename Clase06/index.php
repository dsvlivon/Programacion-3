<?php
    require_once "Usuario.php";
    $opcion = $_GET["opcion"];
    $metodo = $_SERVER['REQUEST_METHOD']; //devuelve el tipo d request q se envio
    $error = "No se puede procesar!";

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
            switch($opcion){
                case 'listado':
                    include_once "Listado.php";
                break;
                default: echo $error; 
                break;
            } break;

        case 'PATCH':echo "llego PATCH!";
            break;
        case 'DELETE': echo "llego DEELTE!";
        default: echo $error;
    }


?>