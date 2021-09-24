<?php
    // "../" referenciar un directorio, un nivel anterior
    //una ves q lo levanta c el servidor el archivo ya existe en el servidor
    $nombre = $_POST["nombre"];
    $archivo = $_FILES["archivo"];

    $dir_subida = 'archivos-subidos/';
    if (!file_exists($dir_subida)) {
        mkdir('archivos-subidos/', 0777, true);    
    }
    $extension = explode(".", $archivo["name"]);

    $destino = $dir_subida.$nombre."_".date("m-d-y").".".end($extension);

    if(move_uploaded_file($archivo["tmp_name"],$destino)){
        echo "Archivo movido con exito en destino: ".$destino;
    } else {
        echo "Error";
        var_dump($archivo["error"]);
    }
   
?>