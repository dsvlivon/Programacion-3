<?php
// Recibe qué listado va a retornar(ej:usuarios,productos,vehículos,...etc),por ahora solo tenemos
// usuarios).
// En el caso de usuarios carga los datos del archivo usuarios.csv.
// se deben cargar los datos en un array de usuarios.
// Retorna los datos que contiene ese array en una lista

// VIZGARRA.LIVON.DANIEL
    include_once "Usuario.php";
    echo "Aplicacion 21</br></br>";
    
    $archivo = $_GET["archivo"];
    echo "archivo: ".$archivo;
    
    $listaUsuarios = Usuario::ReadCSV($archivo);
       
    Usuario::ListarUsuario($listaUsuarios);
    
?>