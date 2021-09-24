<?php
// Aplicación Nº 28 ( Listado BD)
// Archivo: listado.php
// método:GET
// Recibe qué listado va a retornar(ej:usuarios,productos,ventas)
// cada objeto o clase tendrán los métodos para responder a la petición
// devolviendo un listado <ul> o tabla de html <table>

// VIZGARRA.LIVON.DANIEL

include_once "Usuario.php";

    echo "Aplicacion 28</br></br>";   
    //nombre, apellido, clave, mail, localidad)+fecha
    // $nombre = $_POST["nombre"];
    // $apellido = $_POST["apellido"];
    // $clave = $_POST["clave"];
    // $mail = $_POST["mail"];
    // $localidad = $_POST["localidad"];

    // $date = new datetime("now");

    // $u = new Usuario(); //$nombre, $apellido, $fecha, $clave, $mail, $localidad
    // $u->Setter($nombre, $apellido, $date->format("Y-m-d"), $clave, $mail, $localidad);
    // $u->Mostrar($u->SaveSQL());

    $archivo = $_GET["archivo"];
    Usuario::ListarUsuarios(Usuario::SelectAll($archivo));

?>