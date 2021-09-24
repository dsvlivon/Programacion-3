<?php
// Aplicación No 17 (Auto)
//region enunciado
// Realizar una clase llamada “Auto” que posea los siguientes atributos privados:
    // _color (String)
    // _precio (Double)
    // _marca (String).
    // _fecha (DateTime)
// Realizar un constructor capaz de poder instanciar objetos pasándole como parámetros:
    // i. La marca y el color.
    // ii. La marca, color y el precio.
    // iii. La marca, color, precio y fecha.
// Realizar un método de instancia llamado “AgregarImpuestos”, que recibirá un doble por 
// parámetro y que se sumará al precio del objeto.
// Realizar un método de clase llamado “MostrarAuto”, que recibirá un objeto de tipo “Auto”
// por parámetro y que mostrará todos los atributos de dicho objeto.
// Crear el método de instancia “Equals” que permita comparar dos objetos de tipo “Auto”. Sólo
// devolverá TRUE si ambos “Autos” son de la misma marca.
// Crear un método de clase, llamado “Add” que permita sumar dos objetos “Auto” (sólo si son
// de la misma marca, y del mismo color, de lo contrario informarlo) y que retorne un Double con
// la suma de los precios o cero si no se pudo realizar la operación.
// Ejemplo: $importeDouble = Auto::Add($autoUno, $autoDos);
//endregion
class Auto{
    public $_color;// (String)
    public $_precio;// (Double)
    public $_marca;// (String).
    public $_fecha;// (DateTime)

    function __construct($_marca, $_color, $_precio=null, $_fecha=null) {
        $this->_color = $_color;
        $this->_marca = $_marca;
        if($_precio != null){
            $this->_precio = $_precio;
        }
        if($_fecha != null){
            $this->_fecha = $_fecha;
        }
    }

    function AgregarImpuestos($valorAgregado) {
        $this->_precio += $valorAgregado;
    }

    static function MostrarAuto($auto){
        if($auto->_fecha != null){ // echo($date->format("Y-m-d"));
            $date = ($auto->_fecha)->format("Y-m-d");
        } else { $date = "";}
        echo "Marca: ".$auto->_marca."</br>Color: ".$auto->_color."</br>Precio: ".$auto->_precio."</br>Fecha: ".$date."</br></br>";
    }

    public function Equals(Auto $auto2){
        if(get_class($this) == get_class($auto2)){
            if($this->_marca == $auto2->_marca){
            return TRUE;
            }
        }
        return FALSE;
    }
    static function Add($auto1, $auto2){
        if($auto1->Equals($auto2) && $auto1->_color == $auto2->_color){
            return $auto1->_precio + $auto2->_precio;
        }
        else{
            echo "Add: No hay coincidencia!";
            return 0;
        }
    }
}

?>