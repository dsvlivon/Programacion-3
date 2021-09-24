<?php
// Aplicación No 24 ( Listado JSON y array de usuarios)
// Archivo: listado.php
// método:GET
// Recibe qué listado va a retornar(ej:usuarios,productos,vehículos,...etc),por ahora solo tenemos
// usuarios).
// En el caso de usuarios carga los datos del archivo usuarios.json.
// se deben cargar los datos en un array de usuarios.
// Retorna los datos que contiene ese array en una lista

// VIZGARRA.LIVON.DANIEL
    include_once "Usuario.php";
    include_once "Persona.php";
    echo "Aplicacion 24</br></br>";
    
    $archivo = $_GET["archivo"];
    echo "archivo: ".$archivo."\n"."</br>";
    
    // $p = new Usuario("peter","clave1","peter@asd.com","2021-09-17");
    // $p->Mostrar();
    // Persona::MostrarPersona($p);
    $listaUsuarios = Usuario::ReadJSON($archivo);
       
    Usuario::ListarUsuarios($listaUsuarios);
    
?>