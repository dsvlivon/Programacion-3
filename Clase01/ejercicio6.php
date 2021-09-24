<?php
/*
Aplicación No 6 (Carga aleatoria)
Definir un Array de 5 elementos enteros y asignar a cada uno de ellos un número (utilizar la
función rand). Mediante una estructura condicional, determinar si el promedio de los números
son mayores, menores o iguales que 6. Mostrar un mensaje por pantalla informando el
resultado.
 
 VIZGARRA.LIVON.DANIEL
 */
	$miArray = array(rand(0,10),rand(0,10),rand(0,10),rand(0,10),rand(0,10));

	$promedio = array_sum($miArray) / count($miArray);
	
	echo "El promedio es: ", $promedio, "<br/>";

	if($promedio > 6)
	{
		echo "El promedio es MAYOR a 6";
	}
	elseif($promedio < 6)
	{
		echo "El promedio es MENOR a 6";
	}
	else
	{
		echo "El promedio es IGUAL a 6";
	}
?>