<?php
    /********************************************************
    Aplicación No 22 ( Login)
    Archivo: Login.php
    método:POST
    Recibe los datos del usuario(clave,mail )por POST ,
    crear un objeto y utilizar sus métodos para poder verificar si es un usuario registrado,
    Retorna un :
    "Verificado" si el usuario existe y coincide la clave también.
    “Error en los datos” si esta mal la clave.
    “Usuario no registrado" si no coincide el mail
    Hacer los métodos necesarios en la clase usuario
    *********************************************************/
	include "usuario.php";
   
    $l = array();
    $l = usuario::_CargaLista("usuarios.csv");

    $n = $_POST["nombre"];
    $c = $_POST["clave"];
    $m = $_POST["mail"];

    $nuevoUsuario = new usuario($n, $c, $m);

    echo usuario::_validarUsuario($nuevoUsuario);
    
?>

