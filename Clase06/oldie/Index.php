<?php
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
                case 'filtro A': //usua
                    include_once "Filtro_A.php";
                break;
                case 'filtro J'://usu
                    include_once "Filtro_J.php";
                break;
                case 'filtro B': //prod
                    include_once "Filtro_B.php";
                break;
                case 'filtro E': //prod
                    include_once "Filtro_E.php";
                break;
                case 'filtro C': //ven
                    include_once "Filtro_C.php";
                break;
                case 'filtro D': //ven
                    include_once "Filtro_D.php";
                break;
                case 'filtro F': //ven
                    include_once "Filtro_F.php";
                break;
                case 'filtro G': //ven
                    include_once "Filtro_G.php";
                break;
                case 'filtro H': //ven
                    include_once "Filtro_H.php";
                break;
                case 'filtro I'://ven
                    include_once "Filtro_I.php";
                break;
                
                case 'filtro K': //ven
                    include_once "Filtro_K.php";
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