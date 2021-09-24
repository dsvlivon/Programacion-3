<?php
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

    class Garage{
         
        private $_razonSocial;// (String)
        private $_precioPorHora;// (Double)
        private $_autos = array();// (Autos[], reutilizar la clase Auto del ejercicio anterior)
        
        function __construct($rSocial, $pXhora=null, $autos=null){
            $this->_razonSocial = $rSocial;
            if($pXhora != null){
                $this->_precioPorHora = $pXhora;
            }
            if($autos != null){
                $this->_autos = $autos;
            }
        }

        function MostrarGarage(){
            echo("GARAGE</br>Razon Social: ".$this->_razonSocial."</br>Precio por Hora: ".$this->_precioPorHora."</br>");
            echo($this->MostrarLista()."</br></br>");
        }

        function MostrarLista(){
            if($this->_autos != null){
                echo "AUTOS: ".count($this->_autos)."</br>";
                foreach ($this->_autos as $obj) {
                    Auto::MostrarAuto($obj);
                }
            }
            else{ echo("AUTOS: 0</br>");}
        }

        public function Equals(Auto $auto){
            $list = $this->_autos;
            foreach ( $list as $obj) {
                if($obj->Equals($auto) && $obj->_color == $auto->_color){
                    return TRUE;
                }
                return FALSE;
            }
        }

        public function Add(Auto $auto){
            if($this->Equals($auto)){
                echo("El auto ya existe!</br>");
            }
            else{
                array_push($this->_autos, $auto);
            }
        }

        public function Remove(Auto $auto){//VER ARRAY FILTER!!!
            $list = $this->_autos;
            $i=0;
            $flag=False;
            foreach ( $list as $obj) {
                if($obj->Equals($auto) && $obj->_color == $auto->_color){
                    $flag = True;
                    unset($list[$i]);
                }
                else{

                }
                $i++;                
            }
            if($flag){
                echo("Se elimino el auto!</br>");
                $this->_autos=$list;
            }
            else{
                echo("El auto no existe!</br>");
            }
        }
    }
?>