<?php

class Archivo{
    public $p;
    private static $ObjetoAccesoDatos;
    private $objetoPDO;
   
    #region CSV
    static function LeerCSV($archivo){
        $list = array();
        if(file_exists($archivo)){
            $p = fopen($archivo,"r");
            
            if($p){
                while (($line = fgets($p)) !== false) {
                    array_push($list,$line);
                }
                if (!feof($p)) {
                    echo "VER SI MARIANO TENIA RZON\n";
                }
            }//var_dump($list);
            fclose($p);
            return $list;
        } else {
            echo "El archivo NO existe!";
        }
    }    
    static function GuardarCSV($archivo, $line){
        $p = fopen($archivo,"a+");
        if($p){
            $ret = fwrite($p,$line);
        } //var_dump($list);
        fclose($p);
        return $ret;
    }     
    static function GuardarCSVLista($archivo, $lista){
        $p = fopen($archivo,"w+");
        if($p){
            foreach ($lista as $line) {
                $ret = fwrite($p,$line);
            }
        } //var_dump($list);
        fclose($p);
        return $ret;
    }
    #endregion
    
    #region JSON
    static function LeerJSON($archivo){
        $v = array();    
        if($archivo!=null){
            if(file_exists($archivo)){
                $p = fopen($archivo, "r");
                $contenido = fread($p, filesize($archivo));
                $v = json_decode($contenido);
                fclose($p);                
                return $v;
            }
        } else {
            echo "Error al cargar Archivo!";
        }
    }
    static function GuardarJSON($lista,$archivo){      
        if($lista!=null){
            $p = fopen($archivo, "w");
            // foreach ($lista as $obj) {
            //     $line = json_encode($obj).",";
            //     $ret = fwrite($p, $line);
            // }
            $ret = fwrite($p, json_encode($lista,JSON_PRETTY_PRINT));
            fclose($p);    
            return $ret;
        } else {
            echo "Error al guardar Datos!";
            return false;
        }       
    }
    #endregion

    #region SQL
    private function __construct() {
        try {//ACA SIEMPRE ES IMPORTANTE EDITAR EL NOMBRE DE LA DB (no confundir c nombre de tabla)!!
            $this->objetoPDO = new PDO('mysql:host=localhost;dbname=utn;charset=utf8', 'root', '', array(PDO::ATTR_EMULATE_PREPARES => false,PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            $this->objetoPDO->exec("SET CHARACTER SET utf8");
            } 
        catch (PDOException $e) { 
            print "Error!: " . $e->getMessage(); 
            die();
        }
    } 
    public function RetornarConsulta($sql) { 
        return $this->objetoPDO->prepare($sql); 
    }
    public function RetornarUltimoIdInsertado() { 
        return $this->objetoPDO->lastInsertId(); 
    } 
    public static function dameUnObjetoAcceso() { 
        if (!isset(self::$ObjetoAccesoDatos)) {          
            self::$ObjetoAccesoDatos = new archivo(); 
        } 
        return self::$ObjetoAccesoDatos;        
    }     
    public function __clone() {// Evita que el objeto se pueda clonar 
        trigger_error('La clonación de este objeto no está permitida', E_USER_ERROR); 
    }  
    #endregion
}











//DEPRECATED
// static function GuardarCSV($archivo, $line){
//     $p = fopen($archivo,"w+");
//     if($p){
//         fwrite($p,$line);
//     } //var_dump($list);
//     fclose($p);
// }
?>

