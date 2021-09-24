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
        public $_update;
        function __construct($rSocial, $pXhora=null, $autos=null){
            $this->_razonSocial = $rSocial;
            if($pXhora != null){
                $this->_precioPorHora = $pXhora;
            }
            if($autos != null){
                $this->_autos = $autos;
            }
        }

        function getList() {
            return $this->_autos;
        }
        
        function SetList($value) {
            $this->_autos = $value;
        }

        function MostrarGarage(){
            echo "------------------------------</br>";
            echo "GARAGE        Fe.:".$this->_update;
            echo "</br>Razon Social: ".$this->_razonSocial."</br>Precio por Hora: ".$this->_precioPorHora."</br>";
            echo $this->MostrarLista()."</br></br>";
        }

        function MostrarLista(){
            if($this->_autos != null){
                echo "AUTOS: ".count($this->_autos)."</br>";
                echo "------------------------------</br>";
                foreach ($this->_autos as $obj) {
                    Auto::MostrarAuto($obj);
                }
            }
            else{ 
                echo("AUTOS: 0</br>");
                echo "------------------------------</br>";
            }
        }

        function Equals(Auto $auto){
            $list = $this->_autos;
            foreach ( $list as $obj) {
                if($obj->Equals($auto) && $obj->_color == $auto->_color){
                    return TRUE;
                }
                return FALSE;
            }
        }

        function Add(Auto $auto){
            if($this->Equals($auto)){
                echo("El auto ya existe!</br>");
            }
            else{
                array_push($this->_autos, $auto);
            }
        }

        function Remove(Auto $auto){//VER ARRAY FILTER!!!
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
        #region Archivos
        function SaveCSV($archivo){
            $guardar = false;
            $line = $this->_razonSocial.",".$this->_precioPorHora.",".count($this->_autos)."\n";
            Archivo::GuardarCSV($archivo, $line);
            $lista = Auto::ReadCSV("autos.csv");
            foreach ($this->_autos as $obj) {
                foreach ($lista as $subObj) {
                    if($obj->Equals($subObj) == true){
                        $guardar = false;
                        break;
                    }
                    else{
                        $guardar = true;
                    }
                }
                if($guardar){
                    $obj->SaveCSV("autos.csv");
                }
            }
        } 
        
        function SaveCSV2($archivo){
            $guardar = false;
            $date = new DateTime('now');
            $line = $this->_razonSocial.",".$this->_precioPorHora.",".count($this->_autos).",".$date->format("Y-m-d")."\n"; //echo $line;
            Archivo::GuardarCSV($archivo, $line);
            Auto::SaveCSVLista("autos.csv", $this->_autos);
        }
    
        public static function ReadCSV($archivo){
            $lista = Archivo::LeerCSV($archivo);
            $exp = array();
            $qty = null;
            $upd = null;
            foreach ($lista as $line) {
                $exp = explode(",", $line);
                //echo "exp: ".$exp[0]." - ".$exp[1]." - ".$exp[2]." - ".$exp[3];
                $obj = new Garage($exp[0],$exp[1]);
                $qty = $exp[2];
                $upd = $exp[3];
                // array_push($auxLista, $x); VER SINGLETON
            }
            $autos = Auto::ReadCSV("autos.csv");
            if($qty == count($autos)){
                $obj->setList($autos);
                $obj->_update = $upd;
            } else {
                echo "El regristro de autos no coincide!</br>"."AUTOS EXISTENTES= 0</br></br>";
            }                
            return $obj;
        }
        #endRegion
    }
?>