<?php
// VIZGARRA.LIVON.DANIEL

include_once "Venta.php";
$method = $_SERVER['REQUEST_METHOD'];
if ('PUT' === $method) { 
    parse_str(file_get_contents('php://input'), $_PUT);
    
    $numeroPedido = $_PUT["numeroPedido"]; //echo "n°: ".$numeroPedido."</br>";
    $mail = $_PUT["mailUsuario"]; //echo "mail: ".$mailUsuario."</br>";
    $sabor = $_PUT["sabor"]; //echo "sabor: ".$sabor."</br>";
    $tipo = $_PUT["tipo"];
    $cantidad = $_PUT["cantidad"]; //echo "cantidad: ".$cantidad;
    
    $v = new Venta();
    // $id, $numeroPedido, $mail, $fechaVenta, $cantidad, $sabor, $tipo
    $v->Setter(NULL, $numeroPedido, $mail, NULL, $cantidad, $sabor, $tipo);
    
    echo $v->Modificar();
} else {
    echo "FALTAN DATOS!";
}
?>