<?php
    require_once "Usuario.php";
    require_once "Producto.php";

    class Venta{
        public $id;
        public $idUsuario;
        public $codigo;
        public $cantidad;
        public $fechaVenta;
        
        public $idProducto;
        #region Propias
        public function __construct(){ }

        function Setter($codigo, $idUsuario, $cantidad, $fechaVenta, $idProducto){//$codigo, $idUsuario, $cantidad+$id
            if($codigo != NULL) { $this->codigo = $codigo; } else { $this->codigo = ""; }
            if($idUsuario != NULL) { $this->idUsuario = $idUsuario; }
            if($cantidad != NULL) { $this->cantidad = $cantidad; }
            if($idProducto != NULL) { $this->idProducto = $idProducto; }
            if($fechaVenta != NULL) { $this->fechaVenta = $fechaVenta; }
        }

        public function Vender(){
            $ventas = "ventas.json";
            $usuarios = Usuario::ReadJSON("usuarios.json");
            $productos = Producto::ReadJson("productos.json");
           
            foreach ($usuarios as $u) {
                if($this->idUsuario == $u->id){ echo "user Ok!";
                    foreach ($productos as $p) {
                        if($this->codigo == $p->codigo){ //echo "prod Ok!";
                            if($this->cantidad <= $p->stock){ 
                                $p->stock -= $this->cantidad;
                                $idVenta = rand(1, 10000);
                                $this->id = $idVenta;
                                $this->SaveJson($ventas);
                                $this->Insert();
                                return "Venta realizada!</BR>";       
                            }                
                        }
                    }           
                }    
            }// “no se pudo hacer“si no se pudo hacer
            return "No se pudo hacer!</BR>";
        }

        public function Vender2(){
            $usuarios = Usuario::SelectAll("usuarios");
            $productos = Producto::SelectAll("productos");
                       
            foreach ($usuarios as $u) {
                if($this->idUsuario == $u->id){ //echo "user Ok!";
                    foreach ($productos as $p) {
                        if($this->codigo == $p->codigo){ //echo "prod Ok!";
                            if($this->cantidad <= $p->stock){ 
                                $p->stock -= $this->cantidad;
            
                                $this->Insert();
                                $p->Update();
                                return "Venta realizada!</BR>";       
                            }                
                        }
                    }           
                }    
            }// “no se pudo hacer“si no se pudo hacer
            return "No se pudo hacer!</BR>";
        }

        function MostrarVenta(){
            echo "<ul>";
            echo "<li>"."VENTA: ".$this->id."</li>";
            echo "  "."<li>"."Fecha: ".$this->fechaVenta."</li>";
            echo "  "."<li>"."Id Usuario: ".$this->idUsuario."</li>";
            echo "  "."<li>"."Id Producto: ".$this->idProducto."</li>";
            echo "  "."<li>"."Codigo: ".$this->codigo."</li>";
            echo "  "."<li>"."Cantidad: ".$this->cantidad."</li>";
            echo "</ul>";
        }

        public static function Listar($lista){
            foreach ($lista as $obj) {
                $obj->MostrarVenta();
            }
        }
        #endregion

        #region Filtros
        public static function Filtro_C($q1, $q2) {
            $lista = array();
            $query = "SELECT * FROM `ventas` WHERE `cantidad`>".$q1." AND `cantidad` <".$q2;
            
            $objetoAccesoDato = archivo::dameUnObjetoAcceso(); 
            $consulta = $objetoAccesoDato->RetornarConsulta($query);
            $consulta->execute();			
            $lista = $consulta->fetchAll(PDO::FETCH_CLASS, "Venta");
            //var_dump($lista);
            Venta::Listar($lista);
        }
        public static function Filtro_D($f1, $f2) {
            $lista = array();
            $query = "SELECT SUM(`cantidad`) FROM ventas WHERE ventas.fechaVenta BETWEEN '".$f1."' AND '".$f2."'";
            
            $objetoAccesoDato = archivo::dameUnObjetoAcceso(); 
            $consulta = $objetoAccesoDato->RetornarConsulta($query);
            $consulta->execute();
            $lista = $consulta->fetchAll(PDO::FETCH_ASSOC);
            echo "Cantidad Total vendida entre ".$f1." y ".$f2.": ".$lista[0]["SUM(`cantidad`)"]."</br>";
        }
        public static function Filtro_F() {
            $lista = array();
            $query = "SELECT usuarios.apellido, productos.nombre FROM ((ventas
            INNER JOIN usuarios ON ventas.idUsuario = usuarios.id)
            INNER JOIN productos ON ventas.idProducto = productos.id);";
            
            $objetoAccesoDato = archivo::dameUnObjetoAcceso(); 
            $consulta = $objetoAccesoDato->RetornarConsulta($query);
            $consulta->execute();			
            $lista = $consulta->fetchAll(PDO::FETCH_ASSOC);
            // var_dump($lista);
            foreach ($lista as $obj) {
                echo "Apellido: ".$obj["apellido"]." - Producto: ".$obj["nombre"]."</br>";
            } //esto no funciono con usuarios.nombre y usuarios.apellido 
        }
        public static function Filtro_G(){
            $lista = array();
            $query = "SELECT ventas.id, SUM(`cantidad` * `precio`) as monto FROM 
            (ventas INNER JOIN productos ON ventas.idProducto=productos.id) GROUP BY ventas.id;";
            
            $objetoAccesoDato = archivo::dameUnObjetoAcceso(); 
            $consulta = $objetoAccesoDato->RetornarConsulta($query);
            $consulta->execute();			
            $lista = $consulta->fetchAll(PDO::FETCH_ASSOC);
            // var_dump($lista);
            echo  "<ul>";
            foreach ($lista as $obj) {
                echo "<li>"."Venta id: ".$obj["id"]." - Monto: ".round($obj["monto"],2)."$</br>";
            }
            echo "</ul>";
        }
        public static function Filtro_H($u, $p){
            $lista = array();
            $query = "SELECT SUM(`cantidad`) FROM ventas WHERE ventas.idUsuario=".$u." AND ventas.idProducto=".$p;
            $objetoAccesoDato = archivo::dameUnObjetoAcceso(); 
            $consulta = $objetoAccesoDato->RetornarConsulta($query);
            $consulta->execute();			
            $lista = $consulta->fetchAll(PDO::FETCH_ASSOC);
            // var_dump($lista);
            echo "Cantidad Total vendida por el usuario ".$u." del producto ".$p.": ".$lista[0]["SUM(`cantidad`)"]."</br>";
        }
        public static function Filtro_I($l){
            $lista = array();
            $query = "SELECT SUM(ventas.cantidad)as cantidad FROM ventas 
            INNER JOIN usuarios ON ventas.idUsuario=usuarios.id WHERE usuarios.localidad='".$l."'"; //echo $query; 
            $objetoAccesoDato = archivo::dameUnObjetoAcceso(); 
            $consulta = $objetoAccesoDato->RetornarConsulta($query);
            $consulta->execute();			
            $lista = $consulta->fetchAll(PDO::FETCH_ASSOC);
            // var_dump($lista);
            echo "Cantidad Total vendida en ".$l.": ".$lista[0]["cantidad"]."</br>";
        }
        public static function Filtro_K($f1, $f2) {
            $lista = array();
            $query = "SELECT * FROM ventas WHERE ventas.fechaVenta BETWEEN '".$f1."' AND '".$f2."'";
            
            $objetoAccesoDato = archivo::dameUnObjetoAcceso(); 
            $consulta = $objetoAccesoDato->RetornarConsulta($query);
            $consulta->execute();			
            $lista = $consulta->fetchAll(PDO::FETCH_CLASS, "Venta");
            //var_dump($lista);
            Venta::Listar($lista);
        }

        #endregion

        #region Archivos
        //$codigo, $idUsuario, $cantidad+$id
        //JSON///////////////////////////////////////////
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
        //SQL////////////////////////////////////////////
        public function Insert() {
            // echo "la concha d la pija!";
            $query = "INSERT into ventas (idProducto, idUsuario, cantidad, fechaVenta)
            values(:idProducto,:idUsuario,:cantidad,:fechaVenta)";

            $objetoAccesoDato = Archivo::dameUnObjetoAcceso(); 
            $consulta =$objetoAccesoDato->RetornarConsulta($query);

            $consulta->bindValue(':idProducto',$this->idProducto, PDO::PARAM_STR);
            $consulta->bindValue(':idUsuario',$this->idUsuario, PDO::PARAM_STR);
            $consulta->bindValue(':cantidad',$this->cantidad, PDO::PARAM_STR);
            $consulta->bindValue(':fechaVenta', $this->fechaVenta, PDO::PARAM_STR);
                       
            $consulta->execute();		
            echo "INSERT COMPLETE!</br>";
            return $objetoAccesoDato->RetornarUltimoIdInsertado();
        }
        public function Delete() {
            $query = "DELETE FROM ventas WHERE id=:id";

            $objetoAccesoDato = Archivo::dameUnObjetoAcceso(); 
            $consulta =$objetoAccesoDato->RetornarConsulta($query);	

            $consulta->bindValue(':id',$this->id, PDO::PARAM_INT);		
            $consulta->execute();
            
            echo "DELETE COMPLETE!";
            return $consulta->rowCount();
        }
        public function Update() {
            $query = "UPDATE ventas SET 
            idProducto=:idProducto, idUsuario=:idUsuario, cantidad=:cantidad, fechaVenta=:fechaVenta 
            WHERE id=:id";
            
            $objetoAccesoDato = Archivo::dameUnObjetoAcceso(); 
            $consulta =$objetoAccesoDato->RetornarConsulta($query);
            
            $consulta->bindValue(':idProducto',$this->idProducto, PDO::PARAM_INT);//es necesario pasar como parar el key
            $consulta->bindValue(':idUsuario',$this->idUsuario, PDO::PARAM_STR);
            $consulta->bindValue(':cantidad',$this->cantidad, PDO::PARAM_INT);
            $consulta->bindValue(':fechaVenta',$this->fechaVenta, PDO::PARAM_STR);
          
            
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
            
                $lista = $consulta->fetchAll(PDO::FETCH_CLASS, "Venta");
                //var_dump($lista);
            
                return $lista;
            }
        }
        #endregion
    }

?>