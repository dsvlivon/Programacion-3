<?php
    require_once "Archivo.php";
    class Usuario{
        public $_nombre;
        public $_clave;

        function __construct($nombre, $clave){
            $this->_nombre = $nombre;
            $this->_clave = $clave;
        }

        public static function MostrarUsuario(Usuario $obj){
            echo "Nombre: ".$obj->_nombre."\n";
            echo "Clave: ".$obj->_clave."\n";
        }

        function SaveCSV($archivo){
            $line = $this->_nombre.",".$this->_clave."\n";
            Archivo::GuardarCSV($archivo, $line);
        } 

        public static function ReadCSV($archivo, $lista){
            $lista = Archivo::LeerCSV($archivo);
            $exp = array();
            //var_dump($lista);
            foreach ($lista as $obj) {
                $exp = explode(",", $obj);
                //var_dump($explode);
                $u = new Usuario($exp[0], $exp[1]);
                Usuario::MostrarUsuario($u);
            }
        }
    }
    
?>