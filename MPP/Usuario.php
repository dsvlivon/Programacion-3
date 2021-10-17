<?php
    require_once "Archivo.php";
    
    class Usuario {//nombre,apellido, clave,mail,localidad
        public $nombre;
        public $apellido;
        public $fechaRegistro;//parent
        public $clave;
        public $mail;//constr
        public $localidad;
        //public $foto;//setted
        public $id;

        #region Propias
        public function __construct(){}

        function Setter($id, $nombre, $apellido, $fechaRegistro, $clave, $mail, $localidad){
            if($nombre != NULL) { $this->nombre = $nombre; }
            if($apellido != NULL) { $this->apellido = $apellido; }
            if($fechaRegistro != NULL) { $this->fechaRegistro = $fechaRegistro; }
            if($clave != NULL) { $this->clave = $clave; }
            if($mail != NULL) { $this->mail = $mail; }
            if($localidad != NULL) { $this->localidad = $localidad; }
            if($id != NULL) { $this->id = $id; }
        }

        function Mostrar(){
            echo "Nombre: ".$this->nombre."</br>";
            echo "Apellido: ".$this->apellido."</br>";
            echo "Fecha: ".$this->fechaRegistro."</br>";
            echo "Mail: ".$this->mail."</br>";
            echo "Clave: ".$this->clave."</br>";
            echo "Localidad: ".$this->localidad."</br>";
            //echo "Id: ".$this->id."</br>";
            echo "-----------------------</br>";
        }

        public static function ListarUsuarios($lista){
            foreach ($lista as $obj) {
                echo "<ul>";
                //echo "<li>"."Id: ".$obj->id."</li>";
                echo "<li>"."Nombre: ".$obj->nombre."</li>";
                echo "<li>"."Apellido: ".$obj->apellido."</li>";
                echo "<li>"."Fecha: ".$obj->fechaRegistro."</li>";
                echo "<li>"."Mail: ".$obj->mail."</li>";
                echo "<li>"."Clave: ".$obj->clave;
                echo "<li>"."Localidad: ".$obj->localidad."</li>";
                // echo "<li>"."Foto: ".$obj->foto;
                echo "</ul>";
            }
        }

        public function Equals(Usuario $obj){
            if(get_class($this) == get_class($obj)){
                if(/*$this->nombre == $u->nombre
                && */$this->mail == $obj->mail 
                && $this->clave == $obj->clave){
                    return TRUE;
                }
            }
            return FALSE;
        }

        public function GuardarPic($foto){

            $dir_subida = 'Usuario/Fotos/';
            if (!file_exists($dir_subida)) {
                mkdir('Usuario/Fotos/', 0777, true);    
            }
            $extension = explode(".", $foto["name"]);
            //$destino = $dir_subida.$nombre."_".date("m-d-y").".".end($extension);
            $destino = $dir_subida.$this->nombre.".".end($extension);
        
            if(move_uploaded_file($foto["tmp_name"],$destino)){
                echo "Archivo movido con exito en destino: ".$destino;
                $this->foto = $destino;
            } else {
                echo "Error";
                var_dump($foto["error"]);
            }

        }

        public static function LoginUsuario($lista, $u){
            
            $flag = FALSE;
            // var_dump($u->_mail);
            foreach ($lista as $obj) {
                if (strcmp($u->mail, $obj->mail) == 0 && strcmp($u->clave, $obj->clave) == 0) {
                    $status = /*"Bienvenido!"*/"Verificado!".$u->nombre."</br>";
                    $flag = TRUE;
                    break;
                } elseif (strcmp($u->mail, $obj->mail) == 0 && strcmp($u->clave, $obj->clave) != 0) {
                    //$status = "Clave incorrecta!"."</br>";
                    $status = "Error en los datos!"."</br>";
                } elseif (strcmp($u->mail, $obj->mail) != 0 && strcmp($u->clave, $obj->clave) == 0) {
                    // $status = "Mail incorrecto!"."</br>";
                    $status = "Usuario no registrado!"."</br>";
                } else {
                    $status = "Usuario inexistente!"."</br>";
                }
                // var_dump (explode("\n",$obj->_mail));
            }
            echo $status;
            return $flag;
        }

        public static function cambiarClave($mail, $claveVieja, $claveNueva){
            $lista = array();
            $lista = Usuario::SelectAll("usuarios");
            //$date = new datetime("now");

            foreach ($lista as $u) {
                if (strcmp($u->mail, $mail) == 0 && strcmp($u->clave, $claveVieja) == 0) {
                    $u->clave = $claveNueva;
                    $msg = "Se cambio la clave de ".$u->nombre."</br>";
                    $u->Update();
                    break;
                } else {
                    $msg = "No se pudo hacer el cambio!";
                }
            }
            echo $msg;
        }
        #endregion
        
        #region Filtros
        public static function Filtro_A($orden) { //echo "llego Filtro_Ordenar";
            $lista = array();
            $query = "SELECT * FROM `usuarios` ORDER BY `nombre`";
            if($orden == "ascendente"){ //echo "as ok";
                $query = $query." ASC";
            }  else if ($orden == "descendente") { //echo "des ok";
                $query = $query." DESC";
            } else {
                echo "Orden incompatible!!!</br>";
                $query = NULL;
            }       
            if($query != NULL){
                $objetoAccesoDato = archivo::dameUnObjetoAcceso(); 
                $consulta =$objetoAccesoDato->RetornarConsulta($query);
                $consulta->execute();			
                $lista = $consulta->fetchAll(PDO::FETCH_CLASS, "Usuario");
                //var_dump($lista);
                Usuario::ListarUsuarios($lista);
            }            
        }
        public static function Filtro_J($l) { //echo "llego Filtro_Ordenar";
            $lista = array();
            $query = "SELECT * FROM usuarios WHERE usuarios.nombre LIKE '%".$l."%' OR usuarios.apellido LIKE '%".$l."%'";

            $objetoAccesoDato = archivo::dameUnObjetoAcceso(); 
            $consulta = $objetoAccesoDato->RetornarConsulta($query);
            $consulta->execute();			
            $lista = $consulta->fetchAll(PDO::FETCH_CLASS, "Usuario");
            // var_dump($lista);
            Usuario::ListarUsuarios($lista);
        }
        #endregion
        
        #region archivos 
        //nombre, apellido, clave, mail, localidad)+fecha
        function SaveCSV($archivo){
            $line = $this->nombre.",".$this->clave.",".$this->mail.",".$this->fechaRegistro."\n";
            if(!Archivo::GuardarCSV($archivo, $line)){
                echo "Fallo";   
            } else { 
                echo "Exito";
            }
        }
        public static function SaveCSVLista($archivo, $lista){
            $auxLista = array();
            foreach ($lista as $obj) {        
                $line = $obj->nombre.",".$obj->clave.",".$obj->mail.",".$obj->fechaRegistro."\n";
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
                $u = new Usuario($exp[0], $exp[1], $exp[2], $last);//siempre revisar c/ cuantos campos se esta instanciando
                array_push($auxLista, $u);
            }
            return $auxLista;
        }

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
                    $u = new  usuario($obj->nombre, $obj->clave, $obj->mail, $obj->fechaRegistro);
                    $u->id = $obj->id;
                    $u->foto = $obj->foto;
                    // $u->Mostrar();
                    array_push($lista, $u);
                }
            }
            return $lista;
        }

        public function Insert() {
            $query = "INSERT into usuarios (nombre, apellido, clave,mail, fechaRegistro, localidad)
            values(:nombre,:apellido,:clave,:mail,:fechaRegistro,:localidad)";

            $objetoAccesoDato = archivo::dameUnObjetoAcceso(); 
            $consulta =$objetoAccesoDato->RetornarConsulta($query);

            $consulta->bindValue(':nombre',$this->nombre, PDO::PARAM_STR);
            $consulta->bindValue(':apellido',$this->apellido, PDO::PARAM_STR);
            $consulta->bindValue(':clave',$this->clave, PDO::PARAM_STR);
            $consulta->bindValue(':mail', $this->mail, PDO::PARAM_STR);
            $consulta->bindValue(':fechaRegistro', $this->fechaRegistro, PDO::PARAM_STR);
            $consulta->bindValue(':localidad', $this->localidad, PDO::PARAM_STR);
            
            $consulta->execute();		
            echo "DB exito!</br>";
            return $objetoAccesoDato->RetornarUltimoIdInsertado();
        }
        public function Delete() {
            $query = "DELETE FROM usuarios WHERE id=:id";
            $objetoAccesoDato = archivo::dameUnObjetoAcceso(); 
            $consulta =$objetoAccesoDato->RetornarConsulta($query);	
            $consulta->bindValue(':id',$this->id, PDO::PARAM_INT);		
            $consulta->execute();
            return $consulta->rowCount();
        }
        public function Update() {
            $query = "UPDATE usuarios SET 
            nombre=:nombre, apellido=:apellido, clave=:clave, mail=:mail, fechaRegistro=:fechaRegistro, localidad=:localidad
            WHERE id=:id";
            
            $objetoAccesoDato = archivo::dameUnObjetoAcceso(); 
            $consulta =$objetoAccesoDato->RetornarConsulta($query);
            
            $consulta->bindValue(':id',$this->id, PDO::PARAM_INT);
            $consulta->bindValue(':apellido',$this->apellido, PDO::PARAM_STR);
            $consulta->bindValue(':nombre',$this->nombre, PDO::PARAM_STR);
            $consulta->bindValue(':clave', $this->clave, PDO::PARAM_STR);
            $consulta->bindValue(':mail', $this->mail, PDO::PARAM_STR);
            $consulta->bindValue(':fechaRegistro', $this->fechaRegistro, PDO::PARAM_STR);
            $consulta->bindValue(':localidad', $this->localidad, PDO::PARAM_STR);
            $consulta->execute();
            return $this;
        }
        static function SelectAll($archivo) {   
            $lista = array();
            $query = "SELECT* FROM ".$archivo;
            if($archivo != NULL) {
                $objetoAccesoDato = archivo::dameUnObjetoAcceso(); 
                $consulta =$objetoAccesoDato->RetornarConsulta($query);
                $consulta->execute();			
                $lista = $consulta->fetchAll(PDO::FETCH_CLASS, "Usuario");
                //var_dump($lista);
                return $lista;
            }
        }
        #endregion
    }
    
?>