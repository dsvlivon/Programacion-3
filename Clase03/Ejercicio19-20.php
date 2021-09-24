<?php
include_once "Auto.php";
include_once "Garage.php";
include_once "Archivo.php";
//  Aplicación No 19-20 (Garage + Auto)

// VIZGARRA.LIVON.DANIEL
    echo "Aplicacion 19-20</br></br>";
    
    $d1 = new DateTime('now');
    //Instancio Garage
    // $garagePA = new Garage("Garage PA",200);
    // $lista = Auto::ReadCSV("autos.csv");
    // $garagePA->setList($lista);

    //Cargo el garage
    $garagePA = Garage::ReadCSV("garage.csv");

    $garagePA->MostrarGarage(); 
    
    //Instancio un auto
    $auto = new Auto("Bmw", "Negro", 12700.52, $d1);
    
    //Agrego el auto al garage
    $garagePA->Add($auto);

    $garagePA->Remove($auto);

    $garagePA->MostrarGarage();
    
    $garagePA->SaveCSV2("Garage.csv");
        
?>