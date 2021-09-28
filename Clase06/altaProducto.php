<?php
// Aplicación Nº 30 ( AltaProducto BD)
// Archivo: altaProducto.php
// método:POST
// Recibe los datos del producto(código de barra (6 sifras ),nombre ,tipo, stock, precio )por POST
// , carga la fecha de creación y crear un objeto ,se debe utilizar sus métodos para poder
// verificar si es un producto existente, si ya existe el producto se le suma el stock , de lo contrario se agrega .
// Retorna un:
// “Ingresado” si es un producto nuevo
// “Actualizado” si ya existía y se actualiza el stock.
// “no se pudo hacer“si no se pudo hacer
// Hacer los métodos necesarios en la clase

// VIZGARRA.LIVON.DANIEL

include_once "Producto.php";
    echo "Aplicacion 30 - AltaProducto DB</br></br>";   
    echo "INGRESE: codigo, nombre, tipo, stock, precio</br></br>";
 
    if(isset($_POST["nombre"]) && isset($_POST["codigo"]) && isset($_POST["tipo"]) && isset($_POST["stock"]) && isset($_POST["precio"])){
        $archivo = "productos";
        $nombre = $_POST["nombre"]; 
        $codigo = $_POST["codigo"];
        $tipo = $_POST["tipo"];
        $stock = $_POST["stock"];
        $precio = $_POST["precio"];
        $date = new datetime("now");
        
        $p = new Producto();
        //function Setter($id, $nombre, $codigo, $tipo, $stock, $precio, $fechaDeCreacion, $ultimaModificacion)
        $p->Setter(NULL, $nombre, $codigo, $tipo, $stock, $precio,$date->format("Y-m-d"),$date->format("Y-m-d"));
    
        $lista = Producto::SelectAll($archivo);
        //Producto::Listar($lista);

        Producto::validarStock($lista, $p, $archivo);
    } else {
        echo "FALTAN DATOS!";
    }
?>