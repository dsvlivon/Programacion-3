<?php
    // session_start();
    // $_SESSION["clave"] = ["clave"]; 
    // echo $_SESSION;
    
    //p cookies, al momento d logear se envia una cookie, la idea seria usar 
    //el setcookie() para guardar lso datos de dominio Publico
    //setcookie() devuelve un bool y necesita como parametro obligatorio un name y dps
    //value, expire, path, domain, 
        $nombre = $_POST["nombre"];
        setcookie($nombre,"nueva cookie");
        var_dump($_COOKIE[$nombre]);

?>