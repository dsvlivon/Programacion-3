<?php

    require_once "AccesoDatos.php";

    class cd{

    public $id;
    public $titulo;
    public $cantante;
    public $año;

    // function __construct($id, $titulo, $cantante, $año){
    //     // $this->id = $id;
    //     // $this->titulo = $titulo;
    //     // $this->cantante = $cantante;
    //     // $this->año = $año;
    // }



    public static function TraerTodosLosCds(){
        $pdo = AccesoDatos::dameUnObjetoAcceso();
        $query = "SELECT id,titel as titulo, interpret as cantante,jahr as año from cds";
        $consulta = $pdo->RetornarConsulta($query);

        $consulta->execute();
        
        return $consulta->fetchAll(PDO::FETCH_CLASS, "cd");
    }
}

?>