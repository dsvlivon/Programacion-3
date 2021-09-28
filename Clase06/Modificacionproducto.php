<?php
// Aplicación Nº 33 ( ModificacionProducto BD)
// Archivo: modificacionproducto.php
// método:POST
// Recibe los datos del producto(código de barra (6 sifras ),nombre ,tipo, stock, precio )por POST
// ,
// crear un objeto y utilizar sus métodos para poder verificar si es un producto existente,
// si ya existe el producto el stock se sobrescribe y se cambian todos los datos excepto:
// el código de barras .
// Retorna un :
// “Actualizado” si ya existía y se actualiza
// “no se pudo hacer“si no se pudo hacer
// Hacer los métodos necesarios en la clase

// VIZGARRA.LIVON.DANIEL

include_once "Producto.php";

    echo "Aplicacion 33 - Modificacion DB</br></br>"; 
    echo "INGRESE: codigo, nombre, tipo, stock, precio</br></br>"; 
    
    if(isset($_POST["codigo"]) && isset($_POST["nombre"]) && isset($_POST["tipo"]) && isset($_POST["stock"]) && isset($_POST["precio"])){
        $codigo = $_POST["codigo"];
        $nombre = $_POST["nombre"];
        $tipo = $_POST["tipo"];
        $stock = $_POST["stock"];
        $precio = $_POST["precio"];
        $date = new datetime("now");

        $p = new Producto();
                  //$id, $nombre, $codigo, $tipo, $stock, $precio, $fechaDeCreacion, $ultimaModificacion
        $p->Setter(NULL, $nombre, $codigo, $tipo, $stock, $precio,NULL,$date->format("Y-m-d"));
       
        echo $p->Modificar();
    } else {
        echo "FALTAN DATOS!";
    }
?>