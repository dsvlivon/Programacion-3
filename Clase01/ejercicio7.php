<?php
/*
Aplicación No 7 (Mostrar impares)
Generar una aplicación que permita cargar los primeros 10 números impares en un Array.
Luego imprimir (utilizando la estructura for) cada uno en una línea distinta 
(recordar que el salto de línea en HTML es la etiqueta <br/>). 
Repetir la impresión de los números utilizando las estructuras while y foreach.
 
 VIZGARRA.LIVON.DANIEL
 */

$miArray = array();
$buffer = 1;

for($i=0; $i<10; $i++){
	$miArray[$i] = $buffer; 
	$buffer += 2;
}	

echo "IMPRESION: FOR NORMAL";
for($j=0;$j<10;$j++){
	echo "<br/>", $miArray[$j];
}

echo "IMPRESION: WHILE";
$k =0;
while($k<10){
	echo "<br/>", $miArray[$k];
	$k++;
}	

echo "IMPRESION: FOREACH";
foreach ($miArray as $num) {
	echo "<br/>", $num;
}
?>