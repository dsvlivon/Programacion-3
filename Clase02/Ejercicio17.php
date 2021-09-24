<?php
include_once "Auto.php";
// Aplicación No 18 (Auto - Garage)
    // Crear la clase Garage que posea como atributos privados:

    // _razonSocial (String)
    // _precioPorHora (Double)
    // _autos (Autos[], reutilizar la clase Auto del ejercicio anterior)

    // Realizar un constructor capaz de poder instanciar objetos pasándole como parámetros:

    // i. La razón social.
    // ii. La razón social, y el precio por hora.

    // Realizar un método de instancia llamado “MostrarGarage”, que no recibirá parámetros y
    // que mostrará todos los atributos del objeto.
    // Crear el método de instancia “Equals” que permita comparar al objeto de tipo Garaje con un
    // objeto de tipo Auto. Sólo devolverá TRUE si el auto está en el garaje.
    // Crear el método de instancia “Add” para que permita sumar un objeto “Auto” al “Garage”
    // (sólo si el auto no está en el garaje, de lo contrario informarlo).
    // Ejemplo: $miGarage->Add($autoUno);
    // Crear el método de instancia “Remove” para que permita quitar un objeto “Auto” del
    // “Garage” (sólo si el auto está en el garaje, de lo contrario informarlo).
    // Ejemplo: $miGarage->Remove($autoUno);
    // En testGarage.php, crear autos y un garage. Probar el buen funcionamiento de todos los
    // métodos.

// VIZGARRA.LIVON.DANIEL
    echo "Aplicacion 17</br>";

    $d1 = new DateTime('now');
    $d2 = new DateTime('2021-08-31T15:00:00.012345Z');

    $auto1 = new Auto("Audi", "blanco");
    $auto2 = new Auto("Audi", "negro"); 
    $auto3 = new Auto("Fiat", "rojo", 2000.52);
    $auto4 = new Auto("Fiat", "rojo", 3000.52);
    $auto5 = new Auto("Ford", "gris", 4000.52, $d1);
    $auto6 = new Auto("Ford", "gris", 4000.52, $d2);
  
    $auto4->AgregarImpuestos(1500.00);
    $auto5->AgregarImpuestos(1500.00);
    $auto6->AgregarImpuestos(1500.00);


    echo("<br/>La suma de valores es: ".$auto1->_precio + $auto2->_precio."<br/><br/>");
  
    if($auto1->Equals($auto2) && $auto2->Equals($auto5)){
        echo ("Los autos 1, 2 y 5 son iguales<br/><br/>");
    }
    else{echo("Los autos 1, 2 y 5 NO son iguales<br/><br/>");}
  
    Auto::MostrarAuto($auto1);
    Auto::MostrarAuto($auto3);
    Auto::MostrarAuto($auto3);
    //echo (5 % 2 ? 'Impar' : 'Par');
?>