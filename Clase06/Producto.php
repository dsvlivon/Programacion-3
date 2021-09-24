<?php
    require_once "Archivo.php";
    
    class Producto{
        public $nombre;
        public $codigo;
        public $tipo;
        public $stock;
        public $precio;
        
        public $id;
        
        //código de barra (6 sifras ),nombre ,tipo, stock, precio
        function __construct($nombre, $codigo, $tipo, $stock, $precio){
            if($nombre != NULL) { $this->nombre = $nombre; }
            if($codigo != NULL) { $this->codigo = $codigo;}
            if($tipo != NULL) { $this->tipo = $tipo; }
            if($stock != NULL) { $this->stock = $stock; }
            if($precio != NULL) { $this->precio = $precio; }
        }

        // function getId() { return $this->id; }
        // function SetId($value) { $this->id = $value; }

        function Mostrar(){
            echo "Id: ".$this->id."</br>";
            echo "Nombre: ".$this->nombre."</br>";
            echo "codigo: ".$this->codigo."</br>";
            echo "tipo: ".$this->tipo."</br>";
            echo "stock: ".$this->stock."</br>";
            echo "precio: ".$this->precio."</br>";
            echo "-----------------------</br>";
        }

        public static function Listar($lista){
            foreach ($lista as $obj) {
                echo "<ul>";
                echo "<li>"."Id: ".$obj->id."</li>";
                echo "<li>"."Nombre: ".$obj->nombre."</li>";
                echo "<li>"."codigo: ".$obj->codigo."</li>";
                echo "<li>"."tipo: ".$obj->tipo;
                echo "<li>"."stock: ".$obj->stock."</li>";
                echo "<li>"."precio: ".$obj->precio;
                echo "</ul>";
            }
        }

        public function Equals(Producto $obj){
            if(get_class($this) == get_class($obj)){
                if($this->tipo == $obj->tipo
                && $this->codigo == $obj->codigo 
                && $this->nombre == $obj->nombre){
                    return TRUE;
                }
            }
            return FALSE;
        }

        public static function validarStock($lista, $x, $archivo){
            $stat = FALSE;       

            foreach ($lista as $obj) {
                if($x->Equals($obj)) {
                    $prev = $obj->stock;
                    $obj->stock += $x->stock;
                    $msg = "Producto Existente!"."</br>"."Stock anterior: ".$prev."</br>"."Nuevo Stock: ".$obj->stock;
                    $stat = FALSE;
                    break;
                } else {
                    $msg = "Producto Inexistente!"."</br>"."Se ingresa nuevo producto!";
                    $stat = TRUE;
                }
            }
            echo $msg;
            if($stat) {
                array_push($lista, $x);
                $x->SaveJson($archivo);
            }
        }

        
        #region archivos 
        //__construct($nombre, $codigo, $tipo, $stock, $precio) +id
        function SaveCSV($archivo){
            $line = $this->id.",".$this->nombre.",".$this->codigo.",".$this->tipo.",".$this->stock.",".$this->precio."\n";
            if(!Archivo::GuardarCSV2($archivo, $line)){
                echo "Fallo";   
            } else { 
                echo "Exito";
            }
        }
        public static function SaveCSVLista($archivo, $lista){
            $auxLista = array();
            foreach ($lista as $obj) {        
                $line = $obj->id.",".$obj->nombre.",".$obj->codigo.",".$obj->tipo.",".$obj->stock.",".$obj->precio."\n";
                array_push($auxLista, $line);
            }   
            if(!Archivo::GuardarCSVLista($archivo, $auxLista)){
                echo "Fallo";   
            } else { 
                echo "Exito";
            }
        }
        public static function ReadCSV($archivo){
            $lista = Archivo::LeerCSV($archivo);
            $exp = array();
            $auxLista = array();
            //var_dump($lista);
            foreach ($lista as $obj) {
                $exp = explode(",", $obj);
                $last = substr(end($exp), 0, strlen(end($exp))-1);//ESTO ES X EL "\n"
                $x = new Usuario($exp[0], $exp[1], $exp[2], $exp[3], $exp[4], $last);//siempre revisar c/ cuantos campos se esta instanciando
                array_push($auxLista, $x);
            }
            return $auxLista;
        }

        function SaveJson($archivo){
            $line = json_encode($this);//json_encode no funciona c attr privados
            if(!Archivo::GuardarJSON($archivo, $line)){
                echo "Fallo!";   
            } else { 
                echo "Exito: ";
                echo $line;
            }
        }
        static function ReadJson($archivo){
            $lista=array();
            if($archivo!=null)
            {
                $auxLista = archivo::LeerJSON($archivo);
                foreach ($auxLista as $obj){
                    $x = new  Producto($obj->nombre, $obj->codigo, $obj->tipo, $obj->stock, $obj->precio);
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