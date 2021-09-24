<?php
/*
Aplicación No 9 (Arrays asociativos)
Realizar las líneas de código necesarias para generar un Array asociativo $lapicera, que
contenga como elementos: ‘color’, ‘marca’, ‘trazo’ y ‘precio’. Crear, cargar y mostrar tres
lapiceras.
 
 VIZGARRA.LIVON.DANIEL
 */

$lapiceras = array();

$lapicera1 = ["color" => "azul", "marca" => "bic", "trazo" => "fino", "precio" => 15];
$lapicera2 = ["color" => "rojo", "marca" => "coco", "trazo" => "grueso", "precio" => 12.345];
$lapicera3 = ["color" => "amarillo", "marca" => "faber", "trazo" => "interdmedio", "precio" => 25.5];
array_push($lapiceras, $lapicera1, $lapicera2, $lapicera3);

foreach ($lapiceras as $val) {
	echo "Color: ", $val["color"],"<br/>";
	echo "Marca: ", $val["marca"],"<br/>";
	echo "Trazo: ", $val["trazo"],"<br/>";
	echo "Precio: $", $val["precio"],"<br/><br/>";
}
?>