<?php
    require_once "Archivo.php";
    
    class Producto{
        public $id;
        public $codigo;
        public $nombre;
        public $tipo;
        public $stock;
        public $precio;
        public $fechaDeCreacion;
        public $ultimaModificacion;

        function __construct(){}

        function Setter($id, $nombre, $codigo, $tipo, $stock, $precio, $fechaDeCreacion, $ultimaModificacion) {
            if($id != NULL) { $this->id = $id; }
            if($codigo != NULL) { $this->codigo = $codigo;}
            if($nombre != NULL) { $this->nombre = $nombre; }
            if($tipo != NULL) { $this->tipo = $tipo; }
            if($stock != NULL) { $this->stock = $stock; }
            if($precio != NULL) { $this->precio = $precio; }
            if($fechaDeCreacion != NULL) { $this->fechaDeCreacion = $fechaDeCreacion; }
            if($ultimaModificacion != NULL) { $this->ultimaModificacion = $ultimaModificacion; }
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
            echo "Fecha Creacion: ".$this->fechaDeCreacion."</br>";
            echo "Ultima Modificacion: ".$this->ultimaModificacion."</br>";
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

        public static function validarStock($lista, $p, $archivo){
            $status = FALSE;       
            if($lista != NULL && $p != NULL){
                foreach ($lista as $obj) {
                    if($p->Equals($obj)) {
                        $prev = $obj->stock;
                        $obj->stock += $p->stock;
                        $obj->ultimaModificacion = $p->ultimaModificacion;
                        
                        $msg = "Producto Existente!"."</br>"."Stock anterior: ".$prev."</br>"."Nuevo Stock: ".$obj->stock;
                        echo "ACTUALIZANDO: </br>";
                        // var_dump($obj);
                        $obj->Update();
                        $status = FALSE;
                        break;
                    } else {
                        $msg = "Producto Inexistente!"."</br>"."Se ingresa nuevo producto!";
                        $status = TRUE;
                        $p->fechaDeCreacion = $p->ultimaModificacion;   
                    }
                }
                echo $msg;
                if($status) {
                    array_push($lista, $p);
                    $p->SaveJson($archivo);
                    $p->Insert();
                }
            }
        }

        public function Modificar(){
            $lista = array();
            $lista = Producto::SelectAll("productos");
            
            if($lista != NULL){
                foreach ($lista as $p) {
                    //if($this->Equals($p)) {
                    if($this->codigo == $p->codigo) {
                        $this->stock += $p->stock;
                        $this->id = $p->id;
                        $this->fechaDeCreacion = $p->fechaDeCreacion;
                        $msg = "Actualizado";
                        $this->Update();
                        break;
                    } else {
                        $msg = "No se puedo hacer!";
                    }
                }
                return $msg;
            }
        } 
        
        #region archivos 
        // $nombre, $codigo, $tipo, $stock, $precio, $fechaDeCreacion, $ultimaModificacion + $id
        //CSV////////////////////////////////////////////
        function SaveCSV($archivo){
            $line = $this->id.",".$this->nombre.",".$this->codigo.",".$this->tipo.",".$this->stock.",".$this->precio."\n";
            if(!Archivo::GuardarCSV($archivo, $line)){
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
        //JSON////////////////////////////////////////////
        function SaveJson($archivo){
            $line = json_encode($this);//json_encode no funciona c attr privados
            if(!Archivo::GuardarJSON($archivo, $line)){
                echo "[JSON -Fail-]";   
            } else { 
                echo "[JSON OK]";
                //echo $line;
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
        //SQL////////////////////////////////////////////
        public function Insert() {
            $query = "INSERT into productos (nombre, codigo, tipo, stock, precio, fechaDeCreacion, ultimaModificacion)
            values(:nombre,:codigo,:tipo,:stock,:precio,:fechaDeCreacion,:ultimaModificacion)";

            $objetoAccesoDato = Archivo::dameUnObjetoAcceso(); 
            $consulta =$objetoAccesoDato->RetornarConsulta($query);

            $consulta->bindValue(':nombre',$this->nombre, PDO::PARAM_STR);
            $consulta->bindValue(':codigo',$this->codigo, PDO::PARAM_STR);
            $consulta->bindValue(':tipo',$this->tipo, PDO::PARAM_STR);
            $consulta->bindValue(':stock', $this->stock, PDO::PARAM_STR);
            $consulta->bindValue(':precio', $this->precio, PDO::PARAM_STR);
            $consulta->bindValue(':fechaDeCreacion', $this->fechaDeCreacion, PDO::PARAM_STR);
            $consulta->bindValue(':ultimaModificacion', $this->ultimaModificacion, PDO::PARAM_STR);
            
            $consulta->execute();		
            echo "INSERT COMPLETE!</br>";
            return $objetoAccesoDato->RetornarUltimoIdInsertado();
        }
        public function Delete() {
            $query = "DELETE FROM productos WHERE id=:id";

            $objetoAccesoDato = Archivo::dameUnObjetoAcceso(); 
            $consulta =$objetoAccesoDato->RetornarConsulta($query);	

            $consulta->bindValue(':id',$this->id, PDO::PARAM_INT);		
            $consulta->execute();
            
            echo "DELETE COMPLETE!";
            return $consulta->rowCount();
        }
        public function Update() {
            $query = "UPDATE productos SET 
            codigo=:codigo, nombre=:nombre, tipo=:tipo, stock=:stock, precio=:precio, ultimaModificacion=:ultimaModificacion 
            WHERE id=:id";
            
            $objetoAccesoDato = Archivo::dameUnObjetoAcceso(); 
            $consulta =$objetoAccesoDato->RetornarConsulta($query);
            
            $consulta->bindValue(':id',$this->id, PDO::PARAM_INT);//es necesario pasar como parar el key
            $consulta->bindValue(':nombre',$this->nombre, PDO::PARAM_STR);
            $consulta->bindValue(':codigo',$this->codigo, PDO::PARAM_INT);
            $consulta->bindValue(':tipo',$this->tipo, PDO::PARAM_STR);
            $consulta->bindValue(':stock', $this->stock, PDO::PARAM_STR);
            $consulta->bindValue(':precio', $this->precio, PDO::PARAM_STR);//no es float!!
            // $consulta->bindValue(':fechaDeCreacion', $this->fechaDeCreacion, PDO::PARAM_STR);
            $consulta->bindValue(':ultimaModificacion', $this->ultimaModificacion, PDO::PARAM_STR);
            
            $consulta->execute();
            echo "UPDATE COMPLETE!</br>";
            return $this;
        }
        static function SelectAll($archivo) {   
            $lista = array();
            $query = "SELECT* FROM ".$archivo;
            
            if($archivo != NULL) {
                $objetoAccesoDato = Archivo::dameUnObjetoAcceso(); 
                $consulta =$objetoAccesoDato->RetornarConsulta($query);
                $consulta->execute();			
            
                $lista = $consulta->fetchAll(PDO::FETCH_CLASS, "Producto");
                //var_dump($lista);
            
                return $lista;
            }
        }
        #endregion
    }
    
?>