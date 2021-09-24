<?php
    /********************************************************
    Aplicación No 20 (Registro CSV)
    *********************************************************/
	include "usuario.php";
    
    $n = $_POST["nombre"];
    $c = $_POST["clave"];
    $m = $_POST["mail"];

    $nuevoUsuario = new usuario($n, $c, $m);
    //var_dump($estado);
    usuario::_Persistir($nuevoUsuario);
?>

