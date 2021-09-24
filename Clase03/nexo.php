<?php
    require_once "Usuario.php";
    $opcion = $_GET["tarea"];
    $nombre = $_POST["nombre"];
    $clave = $_POST["clave"];

    var_dump($opcion);

    $lista = array();

    switch($opcion){
        case 'mostrar':
            Usuario::MostrarUsuario($nombre);
            break;
        case 'crear':
            $usuario = new Usuario($nombre,$clave);
            // Usuario::MostrarUsuario($usuario);
            array_push($lista, $usuario);
            $usuario->SaveCSV("usuario.csv");
            break;
        case 'leer':
            Usuario::ReadCSV("usuario.csv",$lista);
            // var_dump($lista);
            break;
    }


?>