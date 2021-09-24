<?php
// Aplicación No 25 ( AltaProducto)
// Archivo: altaProducto.php
// método:POST
// Recibe los datos del producto(código de barra (6 sifras ),nombre ,tipo, stock, precio )por POST
// ,
// crea un ID autoincremental(emulado, puede ser un random de 1 a 10.000).
// crear un objeto y utilizar sus métodos para poder verificar si es un producto existente,
// si ya existe el producto se le suma el stock , de lo contrario se agrega al documento en un
// nuevo renglón
// Retorna un :
// “Ingresado” si es un producto nuevo
// “Actualizado” si ya existía y se actualiza el stock.
// “no se pudo hacer“si no se pudo hacer
// Hacer los métodos necesarios en la clase

// VIZGARRA.LIVON.DANIEL

include_once "Producto.php";
    echo "Aplicacion 25</br></br>";
    
    $archivo = "productos.json";
    $nombre = $_POST["nombre"]; 
    $codigo = $_POST["codigo"];
    $tipo = $_POST["tipo"];
    $stock = $_POST["stock"];
    $precio = $_POST["precio"];
    $id = rand(1, 10000);
    
    $p = new Producto($nombre, $codigo, $tipo, $stock, $precio);
    $p->id =$id;
    // $p->SaveJson($archivo);
    
    $lista = Producto::ReadJson($archivo);
       
    Producto::validarStock($lista, $p, $archivo);
?>