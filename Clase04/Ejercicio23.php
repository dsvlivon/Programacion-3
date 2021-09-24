<?php
// Aplicación No 23 (Registro JSON)
// Archivo: registro.php
// método:POST
// Recibe los datos del usuario(nombre, clave,mail )por POST ,
// crea un ID autoincremental(emulado, puede ser un random de 1 a 10.000).
// crear un dato con la fecha de registro , toma todos los datos y utilizar sus métodos para
// poder hacer el alta,
// guardando los datos en usuarios.json y subir la imagen al servidor en la carpeta
// Usuario/Fotos/.
// retorna si se pudo agregar o no.
// Cada usuario se agrega en un renglón diferente al anterior.
// Hacer los métodos necesarios en la clase usuario.

// VIZGARRA.LIVON.DANIEL
    include_once "Usuario.php";
    echo "Aplicacion 23</br></br>";
    
    $nombre = $_POST["nombre"];
    $clave = $_POST["clave"];
    $mail = $_POST["mail"];

    $foto = $_FILES["foto"]; 
    
    $id = rand(1, 10000);
    $date = new datetime("now");
    $archivo = "usuarios.json";

    $u = new Usuario($nombre, $clave, $mail);
    $u->_id = $id;
    $u->_fecha = $date->format("Y-m-d");
    $u->GuardarPic($foto);

    $u->SaveJson($archivo);
    
?>