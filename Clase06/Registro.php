<?php
// Aplicación Nº 27 (Registro BD)
// Archivo: registro.php
// método:POST
// Recibe los datos del usuario(nombre,apellido, clave,mail,localidad )por POST ,
// crear un objeto con la fecha de registro y utilizar sus métodos para poder hacer el alta,
// guardando los datos la base de datos
// retorna si se pudo agregar o no.

// VIZGARRA.LIVON.DANIEL

include_once "Usuario.php";

    echo "Aplicacion 27 - Registro DB</br></br>";   
    echo "INGRESE: nombre, apellido, clave, mail, localidad</br></br>";
    

    if(isset($_POST["nombre"]) && isset($_POST["apellido"]) && isset($_POST["clave"]) && 
    isset($_POST["mail"]) && isset($_POST["localidad"])){
        //nombre, apellido, clave, mail, localidad)+fecha
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $clave = $_POST["clave"];
        $mail = $_POST["mail"];
        $localidad = $_POST["localidad"];
    
        $date = new datetime("now");
    
        $u = new Usuario();
        //function Setter($id, $nombre, $apellido, $fechaRegistro, $clave, $mail, $localidad){
        $u->Setter(NULL, $nombre, $apellido, $date->format("Y-m-d"), $clave, $mail, $localidad);
        $u->Mostrar($u->Insert());
    } else {
        echo "FALTAN DATOS!</BR>";
    }

?>