<?php
    echo("Clase 03 - archivos");
    //int fopen(archivo, modo);
    //$archivo = fopen("saludar.txt","w");
    
    // $archivo = fopen("saludar.txt","r");
    // $line= fread($archivo,20);
    // echo("</br>".$line); //LEYENDO TODOOO

    //unlink p borrar(si no existe ret false)
    $list = array();
    $archivo = fopen("saludar.txt","r");
    $count = 0;
    if($archivo){
        // while(!feof($archivo)){
        //     $line= fgets($archivo);
        //     if($line == "\n"){
        //         echo($line."</br>"); 
        //         array_push($list,$line);
        //         $count++;
        //     }
        //     else("?");

        // }
        while (($bufer = fgets($archivo)) !== false) {
            echo $bufer;
        }
        if (!feof($archivo)) {
            echo "Error: fallo inesperado de fgets()\n";
        }
    }
    var_dump($list);
    echo($count);
    fclose($archivo);
?>  