<?php
/*
Aplicación No 5 (Números en letras)
Realizar un programa que en base al valor numérico de una variable $num, pueda mostrarse
por pantalla, el nombre del número que tenga dentro escrito con palabras, para los números
entre el 20 y el 60.
Por ejemplo, si $num = 43 debe mostrarse por pantalla “cuarenta y tres”.
 
 VIZGARRA.LIVON.DANIEL
 */
	$num= 50;
	$resultado= 0;
	$cadena = (string)$num;
	// echo $cadena;
	$auxCadena = substr($cadena, 1,1);
	// echo $auxCadena;
	if($num > 60 || $num <20){
		echo "Fuera de rango!";
	}
	else{
		if($num == 60){
			echo "Sesenta";
		}
		else if($num <= 29){
			if($num == 20){
				echo "Veinte";
			}
			else{
				echo "Veinti ";
			}
		}
		else if($num <= 39){
			if($auxCadena == 0){
				echo "Treinta";
			}
			else{
				echo "Treinta y ";
			}
		}
		elseif ($num <=49){
			if($auxCadena == 0){
				echo "Cuarenta";
			}
			else{
				echo "Cuarenta y ";
			}
		}
		elseif($num <=59){
			if($auxCadena == 0){
				echo "Cincuenta";
			}
			else{
				echo "Cincuenta y ";
			}
		}   

		switch ($auxCadena){
			case '1':
				echo "uno";
				break;
			case '2':
				echo "dos";
				break;
			case '3':
				echo "tres";
				break;
			case '4':
				echo "cuatro";
				break;    
			case '5':
				echo "cinco";
				break;
			case '6':
				echo "seis";
				break;
			case '7':
				echo "siete";
				break;
			case '8':
				echo " ocho";
				break;
			case '9':
				echo "nueve";
				break;
			default:
				// code...
				break;
		}
	}
?>