<?php

class Persona{

    public $nombre;
    private $apellido;
    private $dni;
    private $edad;
    private $ciudad;
    public $fecha;

    #region Constructor+getter/setter
    function __construct($nombre, $fecha, $apellido = NULL, $dni = NULL, $edad = NULL, $ciudad = NULL) {
        if($nombre != null){ $this->nombre = $nombre; }
        if($apellido != null){ $this->apellido = $apellido; }
        if($dni != null){ $this->dni = $dni; }
        if($edad != null){ $this->edad = $edad; }        
        if($ciudad != null){ $this->ciudad = $ciudad; }
        if($fecha != null){ $this->fecha = $fecha; }
    }

    function getCiudad() { return $this->ciudad; }
    function SetCiudad($value) { $this->ciudad = $value; }

    function getApellido() { return $this->apellido; }
    function SetApellido($value) { $this->apellido = $value; }

    function getDni() { return $this->dni; }
    function SetDni($value) { $this->dni = $value; }

    function getEdad() { return $this->edad; }
    function SetEdad($value) { $this->edad = $value; }

    #endregion

    public static function MostrarPersona($obj){
        if($obj->fecha != null){
            $date = ($obj->fecha)->format("Y-m-d");
        } else { $date = "";}
        // $nombre $apellido $dni $edad $ciudad $fecha
        echo "Nombre: ".$obj->getNombre()."</br>Apellido: ".$obj->getApellido()."</br>Dni: ".$obj->getDni()."</br>Edad: ".$obj->getEdad()."-------------";
        if($obj->ciudad != null){ echo " - Ciudad: ".$obj->ciudad."</br>"; } 
        if($obj->fecha != null){ echo " - Fecha: ".$obj->fecha."</br>";}
    }

    // public function Equals(Persona $p){
    //     if(get_class($this) == get_class($p)){
    //         if($this->dni == $p->dni){
    //         return TRUE;
    //         }
    //     }
    //     return FALSE;
    // }
    
    // static function Add($auto1, $auto2){
    //     if($auto1->Equals($auto2) && $auto1->_color == $auto2->_color){
    //         return $auto1->_precio + $auto2->_precio;
    //     }
    //     else{
    //         echo "Add: No hay coincidencia!";
    //         return 0;
    //     }
    // }    
    #region Archivos
    function SaveCSV($archivo){
        if($this->fecha != null){
            $date = ($this->fecha)->format("Y-m-d");
        } else { $date = "";}
        // $nombre $apellido $dni $edad $ciudad $fecha
        $line = $this->getNombre().",".$this->getApellido().",".$this->getDni().",".getEdad().",".$this->ciudad.",".$date."\n";
        Archivo::GuardarCSV($archivo, $line);
    } 

    public static function ReadCSV($archivo){
        $lista = Archivo::LeerCSV($archivo);
        $exp = array();
        $listaObj = array();
        foreach ($lista as $line) {
            $exp = explode(",", $line);
            $date = new DateTime($exp[5]);
            // $nombre $apellido $dni $edad $ciudad $fecha
            $obj = new Auto($exp[0],$exp[1],$exp[2],$exp[3],$exp[4],$date);
            // Persona::Mostrar($obj);
            array_push($listaObj, $obj);
        }
        return $listaObj;
    }

    public static function SaveCSVLista($archivo, $lista){
        $auxLista = array();
        foreach ($lista as $obj) {
            if($obj->fecha != null){
                $date = ($obj->fecha)->format("Y-m-d");
            } else { $date = "";}
            // $nombre $apellido $dni $edad $ciudad $fecha            
            $line = $this->getNombre().",".$this->getApellido().",".$this->getDni().",".getEdad().",".$this->ciudad.",".$date."\n";            array_push($auxLista, $line);
            array_push($auxLista, $line);
        }   
        Archivo::GuardarCSVLista($archivo, $auxLista);
    }
    #endregion
}

?>