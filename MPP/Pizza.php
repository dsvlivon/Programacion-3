<?php
    require_once "Archivo.php";
    
    class Pizza{//Sabor, precio, Tipo (“molde” o “piedra”), cantidad
        public $id;
        public $sabor;
        public $precio;
        public $tipo;
        public $cantidad;

        function __construct(){}

        function Setter($id, $sabor, $tipo, $cantidad, $precio) {
            if($id != NULL) { $this->id = $id; }
            if($sabor != NULL) { $this->sabor = $sabor;}
            if($cantidad != NULL) { $this->cantidad = $cantidad; }
            if($tipo != NULL) { $this->tipo = $tipo; }
            if($precio != NULL) { $this->precio = $precio; }
        }

        #region Propias
        // function getId() { return $this->id; }
        // function SetId($value) { $this->id = $value; }
        function Mostrar(){
            echo "Id: ".$this->id."</br>";
            echo "Nombre: ".$this->sabor."</br>";
            echo "tipo: ".$this->tipo."</br>";
            echo "Cantidad: ".$this->cantidad."</br>";
            echo "precio: ".$this->precio."</br>";
            echo "-----------------------</br>";
        }

        public static function Listar($lista){
            foreach ($lista as $obj) {
                echo "<ul>";
                echo "<li>"."Id: ".$obj->id."</li>";
                echo "<li>"."sabor: ".$obj->sabor."</li>";
                echo "<li>"."tipo: ".$obj->tipo;
                echo "<li>"."cantidad: ".$obj->cantidad."</li>";
                echo "<li>"."precio: ".$obj->precio;
                echo "</ul>";
            }
        }

        public function Equals(Pizza $obj){
            if(get_class($this) == get_class($obj)){
                if($this->tipo == $obj->tipo
                && $this->sabor == $obj->sabor){
                    return TRUE;
                }
            }
            return FALSE;
        }
        //Sí el sabor y tipo ya existen , se actualiza el precio y se suma al stock existente.
        public static function validarStock($lista, $p, $archivo){
            $foto = $_FILES["foto"]; 
            $status = FALSE;       
            if($lista != NULL && $p != NULL){
                foreach ($lista as $obj) {
                    if($p->Equals($obj)) {
                        $msg = "Pizaa Existente!"."</br>"."Stock anterior: ".$obj->cantidad."</br>"."Nuevo Stock: ".$p->cantidad+$obj->cantidad;
                        $obj->cantidad += $p->cantidad;
                        $msg = $msg."</br>Precio anterior: ".$obj->precio."</br>"."Precio nuevo : ".$p->precio;
                        $obj->precio = $p->precio+0;
                        echo "ACTUALIZANDO: </br>";
                        // var_dump($obj);
                        $status = FALSE;
                        break;
                    } else {
                        $msg = "Producto Inexistente!"."</br>"."Se ingresa nuevo producto!";
                        $status = TRUE;
                    }
                }
                if($status) {
                    array_push($lista, $p);
                    $p->GuardarPic($foto);
                }
                Archivo::GuardarJson($lista, $archivo);

                echo $msg;
            }
        }
        //Pizza::buscarStock($lista, $sabor, $tipo, $archivo);
        public static function buscarStock($lista, $p){
            if($lista != NULL && $p != NULL){
                echo "Solicitud: ".$p->sabor." - ".$p->tipo."</br>";
                echo "Menu: </br>";
                foreach ($lista as $obj) {
                    echo $obj->sabor." - ".$obj->tipo."</br>";
                    if($p->Equals($obj)) {
                        $msg = "Si hay";
                        break;
                    } else {
                        $msg = "No existe!";
                    }
                }
                return $msg;
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
        public function GuardarPic($foto){
            $dir_subida = 'ImagenesDePizzas/';
            if (!file_exists($dir_subida)) {
                mkdir('Usuario/Fotos/', 0777, true);    
            }
            $extension = explode(".", $foto["name"]);
            
            $destino = $dir_subida.$this->tipo."-".$this->sabor.".".end($extension);
        
            if(move_uploaded_file($foto["tmp_name"],$destino)){
                echo "Archivo movido con exito en destino: ".$destino;
                $this->foto = $destino;
            } else {
                echo "Error";
                var_dump($foto["error"]);
            }
        }
        #endregion

        #region archivos 
        //JSON////////////////////////////////////////////
        // function SaveJson($archivo){
        //     $line = json_encode($this);//json_encode no funciona c attr privados
        //     if(!Archivo::GuardarJSON($archivo, $line)){
        //         echo "[JSON -Fail-]";   
        //     } else { 
        //         echo "[JSON OK]";
        //         //echo $line;
        //     }
        // }
        static function ReadJson($archivo){
            $lista=array();
            if($archivo!=null)
            {
                $auxLista = archivo::LeerJSON($archivo);
                foreach ($auxLista as $obj){
                    $x = new  Pizza();//$id, $sabor, $tipo, $cantidad, $precio
                    $x->Setter($obj->id, $obj->sabor, $obj->tipo, $obj->cantidad, $obj->precio);
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