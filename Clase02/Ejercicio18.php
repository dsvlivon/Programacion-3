<?php
include_once "Auto.php";
include_once "Garage.php";
// Aplicación No 18 (Auto - Garage)
    // En testGarage.php, crear autos y un garage. Probar el buen funcionamiento de todos los
    // métodos.

// VIZGARRA.LIVON.DANIEL
    echo "Aplicacion 18</br>";

    //Instancio autos 4,5 y 6
    $d1 = new DateTime('now');
    $d2 = new DateTime('2021-08-31T15:00:00.012345Z');
    //echo($d2->format("Y-m-d")."</br>");

    $auto4 = new Auto("Fiat", "rojo", 3000.52);
    $auto5 = new Auto("Ford", "gris", 4000.52);
    $auto6 = new Auto("Renault", "Negro", 2000.52, $d1);

    //Agrego impuestos a los autos 4,5 y 6
    $auto4->AgregarImpuestos(1500.00);
    $auto5->AgregarImpuestos(1500.00);
    $auto6->AgregarImpuestos(1500.00);

    //Instancio Garage PB y PA
    $garagePB = new Garage("Garage PB"); // i. La razón social.
    $garagePA = new Garage("Garage PA",200); // ii. La razón social, y el precio por hora.

    //Agrego a PB auto 4
    $garagePB->Add($auto4);
    //Agrego a PA autos 5 y 6
    $garagePA->Add($auto5);
    $garagePA->Add($auto6);
    //Agrego a PB auto 4(ya existe)
    $garagePB->Add($auto4);
    //Muestro Garage PB    
    $garagePB->MostrarGarage();
    //Muestro Garage PA
    $garagePA->MostrarGarage();
    //Remuevo el auto4 del garage PA (No existe)
    $garagePA->Remove($auto4);
    //Remuevo el auto5 del garage PA
    $garagePA->Remove($auto5);
    //Muestro otra vez Garage PA
    $garagePA->MostrarGarage();
?>