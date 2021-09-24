<!--comentarrio html-->
<?php
    /*
    Aplicación No 1 (Sumar números)
    Confeccionar un programa que sume todos los números enteros desde 1 mientras la suma no
    supere a 1000. Mostrar los números sumados y al finalizar el proceso indicar cuantos números
    se sumaron.
    
    VIZGARRA LIVON DANIEL
    */
    $suma = 0;
    $cantidad = 0;

    while($suma + $cantidad < 1000){
        $suma = $suma + $cantidad;
        //printf("<br>sumando: ".$suma);
        $cantidad ++;
        //printf("<br>Conteo: ".$cantidad);
    }
    printf("<br><br>Cantidad: " .$cantidad);
    printf("<br>Suma: " .$suma);
    //990 y 44

?>

<?php
