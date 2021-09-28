<?php
// Aplicación Nº 32(Modificacion BD)
// Archivo: ModificacionUsuario.php
// método:POST
// Recibe los datos del usuario(nombre, clavenueva, clavevieja,mail )por POST ,
// crear un objeto y utilizar sus métodos para poder hacer la modificación,
// guardando los datos la base de datos
// retorna si se pudo agregar o no.
// Solo pueden cambiar la clave

// VIZGARRA.LIVON.DANIEL

include_once "Usuario.php";

    echo "Aplicacion 32 - Modificacion DB</br></br>"; 
    echo "INGRESE: claveNueva, claveVieja, mail</br></br>"; 
    
    if(isset($_POST["claveNueva"]) && isset($_POST["claveVieja"]) && isset($_POST["mail"])){
        $claveNueva = $_POST["claveNueva"];
        $claveVieja = $_POST["claveVieja"];
        $mail = $_POST["mail"];
        
        Usuario::cambiarClave($mail, $claveVieja, $claveNueva);
    } else {
        echo "FALTAN DATOS!";
    }
?>