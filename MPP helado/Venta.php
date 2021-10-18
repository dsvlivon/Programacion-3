<?php
    require_once "Helado.php";

    class Venta{
        //fecha, número de pedido y id autoincremental
        //$v->Setter($mail, $sabor, $cantidad, $date->format("Y-m-d"));
        public $id;
        public $mail;
        public $numeroPedido;
        public $cantidad;
        public $fechaVenta;
        public $tipo;
        public $sabor;
        
        #region Propias
        public function __construct(){ }

        function Setter($id, $numeroPedido, $mail, $fechaVenta, $cantidad, $sabor, $tipo){
            if($id != NULL) { $this->id = $id; }
            if($mail != NULL) { $this->mail = $mail; }
            if($cantidad != NULL) { $this->cantidad = $cantidad; }
            if($numeroPedido != NULL) { $this->numeroPedido = $numeroPedido; }
            if($fechaVenta != NULL) { $this->fechaVenta = $fechaVenta; }
            if($sabor != NULL) { $this->sabor = $sabor; }
            if($tipo != NULL) {$this->tipo = $tipo;}
        }
        public function Vender($foto){
            $lista = Helado::ReadJson("Helado.json");
            // Helado::Listar($lista);      
            $x = new Helado(); //$id, $sabor, $tipo, $cantidad, $precio
            $x->Setter(NULL, $this->sabor, $this->tipo, $this->cantidad, NULL);

            foreach ($lista as $obj) {
                if($x->Equals($obj) && $this->cantidad <= $obj->cantidad){ //echo "prod Ok!";
                    $obj->cantidad -= $this->cantidad;
                    // $this->id = rand(1, 10000);
                    $this->numeroPedido = Venta::getNumeroPedido();
                    $this->GuardarPic($foto);
                    $this->Insert();
                    Archivo::GuardarJSON($lista,"Helado.json");
                    return "Venta realizada!</BR>";       
                }
            }
            return "No se pudo hacer!</BR>".$x->sabor." - ".$x->tipo."No disponible";
        }
        public function GuardarPic($foto){
            $dir_subida = 'ImagenesDeLaVenta/';
            if (!file_exists($dir_subida)) {
                mkdir('Usuario/Fotos/', 0777, true);    
            }
            $extension = explode(".", $foto["name"]);
            $x= explode("@", $this->mail );
            $destino = $dir_subida.$this->tipo."-".$this->sabor."-".$x[0]."-".$this->fechaVenta.".".end($extension);
        
            if(move_uploaded_file($foto["tmp_name"],$destino)){
                echo "Archivo movido con exito en destino: ".$destino;
                $this->foto = $destino;
            } else {
                echo "Error";
                var_dump($foto["error"]);
            }
        }
        public static function getNumeroPedido(){
            $ventas = Venta::SelectAll("ventash");
            return count($ventas)+1;
        }
        public function MostrarVenta(){
            echo "<ul>";
            echo "<li>"."VENTA: ".$this->id."</li>";
            echo "  "."<li>"."Fecha: ".$this->fechaVenta."</li>";
            echo "  "."<li>"."sabor: ".$this->sabor."</li>";
            echo "  "."<li>"."tipo: ".$this->tipo."</li>";
            echo "  "."<li>"."Cantidad: ".$this->cantidad."</li>";
            echo "</ul>";
        }
        public static function Listar($lista){
            foreach ($lista as $obj) {
                $obj->MostrarVenta();
            }
        }
        public function Modificar(){
            //$v->Setter(NULL, $numeroPedido, $mail, NULL, $cantidad, $sabor, $tipo);
            $lista = Venta::SelectAll("ventash");
            foreach ($lista as $obj) {
                if($obj->numeroPedido == $this->numeroPedido){
                    $obj->mail = $this->mail;
                    $obj->tipo = $this->tipo;
                    $obj->sabor = $this->sabor;
                    $obj->cantidad = $this->cantidad;
                    $obj->numeroPedido = $this->numeroPedido;
                    $obj->Update();
                    $msg = "</br>Item actualizado!</br>";
                    break;
                } else {
                    $msg = "Item inexistente!";
                }
            }
            return $msg;
        }
        public static function Borrar($n){
            if($n != NULL){
                $lista = Venta::SelectAll("ventash");

                foreach ($lista as $obj) {
                    if($n+0 == ($obj->numeroPedido)+0){
                        $x = explode("@", $obj->mail );
                        $nombre = $obj->tipo."-".$obj->sabor."-".$x[0]."-".$obj->fechaVenta.".png";
                        $origen = 'ImagenesDeLaVenta/'.$nombre;
                        $destino = 'BACKUPVENTAS/'.$nombre;
                        if (!copy($origen, $destino)) {
                            $msg = "Error al copiar ".$nombre."</br>";
                        } else {
                            $msg = "</br>Se movio!</br>";
                        }
                        Venta::Delete($n);
                        break;
                    } else {
                        $msg = "</br>El registro no existe!";
                    }
                }
                return $msg;
            }
        }
        #endregion

        #region Filtros
        public static function Filtro_a(){
            $query = "SELECT SUM(`cantidad`) as VALUE FROM ventash";
            
            $objetoAccesoDato = archivo::dameUnObjetoAcceso(); 
            $consulta = $objetoAccesoDato->RetornarConsulta($query);
            $consulta->execute();			
            $value = $consulta->fetchAll(PDO::FETCH_ASSOC);
            // var_dump($value);
            return $value[0]["VALUE"];            
        }
        public static function Filtro_b($f1, $f2) {
            $lista = array();
            $query = "SELECT ventash.mail FROM ventash WHERE ventash.fechaVenta BETWEEN '".$f1."' AND '".$f2."'";
            
            $objetoAccesoDato = archivo::dameUnObjetoAcceso(); 
            $consulta = $objetoAccesoDato->RetornarConsulta($query);
            $consulta->execute();			
            $lista = $consulta->fetchAll(PDO::FETCH_CLASS, "Venta");
            // var_dump($lista);
            return $lista;
        }
        public static function Filtro_c($m){
            $lista = array();
            $query = "SELECT * FROM ventash WHERE ventash.mail='".$m."'";
            
            $objetoAccesoDato = archivo::dameUnObjetoAcceso(); 
            $consulta = $objetoAccesoDato->RetornarConsulta($query);
            $consulta->execute();			
            $lista = $consulta->fetchAll(PDO::FETCH_CLASS, "Venta");
            //var_dump($lista);
            return $lista;
        }
        public static function Filtro_d($t){
            $lista = array();
            $query = "SELECT * FROM ventash WHERE ventash.tipo='".$t."'";
            
            $objetoAccesoDato = archivo::dameUnObjetoAcceso(); 
            $consulta = $objetoAccesoDato->RetornarConsulta($query);
            $consulta->execute();			
            $lista = $consulta->fetchAll(PDO::FETCH_CLASS, "Venta");
            //var_dump($lista);
            return $lista;
        }

        #endregion

        #region Archivos
        //$codigo, $idUsuario, $cantidad+$id
        //SQL////////////////////////////////////////////
        public function Insert() {
            $query = "INSERT into ventash (mail, sabor, tipo, cantidad, fechaVenta, numeroPedido)
            values(:mail,:sabor,:tipo,:cantidad,:fechaVenta,:numeroPedido)";

            $objetoAccesoDato = Archivo::dameUnObjetoAcceso(); 
            $consulta =$objetoAccesoDato->RetornarConsulta($query);

            // $consulta->bindValue(':id',$this->id, PDO::PARAM_INT);
            $consulta->bindValue(':mail',$this->mail, PDO::PARAM_STR);
            $consulta->bindValue(':sabor',$this->sabor, PDO::PARAM_STR);
            $consulta->bindValue(':tipo',$this->tipo, PDO::PARAM_STR);
            $consulta->bindValue(':cantidad',$this->cantidad, PDO::PARAM_STR);
            $consulta->bindValue(':fechaVenta', $this->fechaVenta, PDO::PARAM_STR);
            $consulta->bindValue(':numeroPedido',$this->numeroPedido, PDO::PARAM_INT);

            $consulta->execute();		
            echo "INSERT COMPLETE!</br>";
            return $objetoAccesoDato->RetornarUltimoIdInsertado();
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
        public static function Delete($n) {
            $query = "DELETE FROM ventash WHERE numeroPedido=:numeroPedido";

            $objetoAccesoDato = Archivo::dameUnObjetoAcceso(); 
            $consulta =$objetoAccesoDato->RetornarConsulta($query);	

            $consulta->bindValue(':numeroPedido',$n, PDO::PARAM_INT);		
            $consulta->execute();
            
            echo "DELETE COMPLETE!";
            return $consulta->rowCount();
        }
        public function Update() { //$v->Setter(NULL, $numeroPedido, $mail, NULL, $cantidad, $sabor, $tipo);
            $query = "UPDATE ventash SET mail=:mail, cantidad=:cantidad, sabor=:sabor, tipo=:tipo 
            WHERE numeroPedido=:numeroPedido";
            
            $objetoAccesoDato = Archivo::dameUnObjetoAcceso(); 
            $consulta =$objetoAccesoDato->RetornarConsulta($query);
            
            $consulta->bindValue(':numeroPedido',$this->numeroPedido, PDO::PARAM_INT);
            $consulta->bindValue(':mail',$this->mail, PDO::PARAM_STR);
            $consulta->bindValue(':cantidad',$this->cantidad, PDO::PARAM_INT);
            $consulta->bindValue(':sabor',$this->sabor, PDO::PARAM_STR);
            $consulta->bindValue(':tipo', $this->tipo, PDO::PARAM_STR);
            
            $consulta->execute();
            echo "UPDATE COMPLETE!</br>";
            return $this;
        }
        #endregion
    }

?>