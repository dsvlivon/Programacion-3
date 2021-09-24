<?php
// Aplicación No 22 ( Login)
// Archivo: Login.php
// método:POST
// Recibe los datos del usuario(clave,mail )por POST ,
// crear un objeto y utilizar sus métodos para poder verificar si es un usuario registrado,
// Retorna un :
// “Verificado” si el usuario existe y coincide la clave también.
// “Error en los datos” si esta mal la clave.
// “Usuario no registrado si no coincide el mail“
// Hacer los métodos necesarios en la clase usuario

// VIZGARRA.LIVON.DANIEL
    include_once "Usuario.php";
    echo "Aplicacion 22</br></br>"."\n";
    
    $nombre = $_POST["nombre"];
    $clave = $_POST["clave"];
    $mail = $_POST["mail"];
    $archivo = "usuarios.csv";
    
    $listaUsuarios = Usuario::ReadCSV($archivo);
       
    $u = new Usuario($nombre, $clave, $mail);
    // Usuario::ListarUsuarios($listaUsuarios);
    Usuario::LoginUsuario($listaUsuarios, $u);
    
?>