<?php
// Aplicación Nº 28 ( Listado BD)
// Archivo: listado.php
// método:GET
// Recibe qué listado va a retornar(ej:usuarios,productos,ventas)
// cada objeto o clase tendrán los métodos para responder a la petición
// devolviendo un listado <ul> o tabla de html <table>

// VIZGARRA.LIVON.DANIEL

include_once "Usuario.php";

    echo "Aplicacion 28 - Listado</br></br>";   
    echo "INGRESE: listado (ej:usuarios,productos,ventas)</br></br>";


    if(isset($_GET["archivo"])){
        $archivo = $_GET["archivo"];
        Usuario::ListarUsuarios(Usuario::SelectAll($archivo));

    } else {
        echo "FALTAN DATOS!</BR>";
    }
?>