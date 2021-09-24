<?php

class Archivo{
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
        $p = fopen($archivo,"w+");
        if($p){
            fwrite($p,$line);
        } //var_dump($list);
        fclose($p);
    } 
    
    static function GuardarCSVLista($archivo, $lista){
        $p = fopen($archivo,"w+");
        if($p){
            foreach ($lista as $line) {
                fwrite($p,$line);
            }
        } //var_dump($list);
        fclose($p);
    }
    #endregion

    #region SQL
    //ehhh...
    #endregion
}

?>