<?php
    require_once "Usuario.php";
    require_once "Producto.php";

    class Venta{
        public $id;
        public $idUsuario;
        public $codigo;
        public $cantidad;

        function __construct($codigo, $idUsuario, $cantidad){//$codigo, $idUsuario, $cantidad+$id
            $this->codigo = $codigo;
            $this->idUsuario = $idUsuario;
            $this->cantidad = $cantidad;
        }

        public function Vender(){
            // Verificar que el usuario y el producto exista y tenga stock.
            $ventas = "ventas.json";
            $usuarios = Usuario::ReadJSON("usuarios.json");
            $productos = Producto::ReadJson("productos.json");

            foreach ($usuarios as $u) {
                if($this->idUsuario == $u->id){ //echo "user Ok!";
                    foreach ($productos as $obj) {
                        if($this->codigo == $obj->codigo){ //echo "prod Ok!";
                            if($this->cantidad <= $obj->stock){ 
                                $obj->stock -= $this->cantidad;
                                // $obj->SaveJson("productos.json");//Mmm...aca habria q guardar todos los registros otra vez, 
                                // crea un ID autoincremental(emulado, puede ser un random de 1 a 10.000).
                                $idVenta = rand(1, 10000);
                                $this->id = $idVenta;
                                // carga los datos necesarios para guardar la venta en un nuevo renglón.
                                $this->SaveJson($ventas);
                                // // Retorna un: “venta realizada”Se hizo una venta
                                return "Venta realizada!</BR>";       
                            }                
                        }
                    }           
                }    
            }// “no se pudo hacer“si no se pudo hacer
            return "No se pudo hacer!</BR>";
        }

        function MostrarVenta(){
            echo "Venta: ".$this->id."</br>";
            echo "  Codigo: ".$this->codigo."</br>";
            echo "  Id Usuario: ".$this->idUsuario."</br>";
            echo "  Cantidad: ".$this->cantidad."</br>";
            echo "-----------------------</br>";
        }
        #region Archivos
        //$codigo, $idUsuario, $cantidad+$id
        function SaveJson($archivo){
            $line = json_encode($this);
            //echo $line;
            if(!Archivo::GuardarJSON($archivo, $line)){
                echo "Fallo!";   
            } else { 
                echo "Exito: ";
                echo $line;
            }
        }
        static function ReadJSON($archivo){
            $lista=array();
            if($archivo!=null)
            {
                $auxLista = archivo::LeerJSON($archivo);
                foreach ($auxLista as $obj){
                    $x = new  usuario($obj->codigo, $obj->idUsuario, $obj->cantidad);
                    $x->id = $obj->id;
                    // $x->Mostrar();
                    array_push($lista, $x);
                }
            }
            return $lista;
        }
        #endregion
    }

?>