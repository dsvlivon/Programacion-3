<?php
// Aplicación No 20 (Registro CSV)
// Archivo: registro.php
// método:POST
// Recibe los datos del usuario(nombre, clave,mail )por POST ,
// crear un objeto y utilizar sus métodos para poder hacer el alta,
// guardando los datos en usuarios.csv.
// retorna si se pudo agregar o no.
// Cada usuario se agrega en un renglón diferente al anterior.
// Hacer los métodos necesarios en la clase usuario

// VIZGARRA.LIVON.DANIEL
    include_once "Usuario.php";
    echo "Aplicacion 20</br></br>";
    
    $archivo = "usuarios.csv";
    $listaUsuarios = array();

    // $listaUsuarios = Usuario::ReadCSV($archivo);
    
    $nombre = $_POST["nombre"];
    $clave = $_POST["clave"];
    $mail = $_POST["mail"];

    $u = new Usuario($nombre, $mail, $clave);
    array_push($listaUsuarios, $u);
    
    foreach ($listaUsuarios as $obj) {
        Usuario::ListarUsuario($obj);
    }
    Usuario::SaveCSVLista($archivo, $listaUsuarios);
    
?>