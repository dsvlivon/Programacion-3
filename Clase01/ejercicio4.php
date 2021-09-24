<?php
/*
Aplicación No 4 (Calculadora)
Escribir un programa que use la variable $operador que pueda almacenar los símbolos
matemáticos: ‘+’, ‘-’, ‘/’ y ‘*’; y definir dos variables enteras $op1 y $op2. De acuerdo al
símbolo que tenga la variable $operador, deberá realizarse la operación indicada y mostrarse el
resultado por pantalla.
 
 VIZGARRA.LIVON.DANIEL
 */
	$op1= 5;
	$op2= 1;
	$operador= "/";
	$resultado= 0;

	switch ($operador) {
		case '+':
			$resultado = $op1 + $op2;
			break;
		case '-':
			$resultado = $op1 - $op2;
			break;
		case '*':
			$resultado = $op1 * $op2;
			break;
		case '/':
			if($op2 == 0)
			{
				$resultado = "No se puede dividir por 0";
			}
			else
			{
				$resultado = $op1 / $op2;
			}
			break;
		
		default:
			# code...
			break;
	}

	echo "Resultado: ".$resultado;

?>