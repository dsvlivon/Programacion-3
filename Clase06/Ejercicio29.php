<?php
// Aplicación Nº 29( Login con bd)
// Archivo: Login.php
// método:POST
// Recibe los datos del usuario(clave,mail )por POST ,
// crear un objeto y utilizar sus métodos para poder verificar si es un usuario registrado en la
// base de datos,
// Retorna un :
// “Verificado” si el usuario existe y coincide la clave también.
// “Error en los datos” si esta mal la clave.
// “Usuario no registrado si no coincide el mail“
// Hacer los métodos necesarios en la clase usuario.

// VIZGARRA.LIVON.DANIEL
    include_once "Usuario.php";
    echo "Aplicacion 29</br></br>"."\n";
    
    $lista = array();

    $clave = $_POST["clave"];
    $mail = $_POST["mail"];
    
    $archivo = $_GET["archivo"];

    $lista = Usuario::SelectAll($archivo);
       
    $u = new Usuario(); //$nombre, $apellido, $fecha, $clave, $mail, $localidad
    $u->Setter(NULL, NULL, NULL, $clave, $mail, NULL);
    Usuario::LoginUsuario($lista, $u);
    
?>