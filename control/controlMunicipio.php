<?php
require_once 'modelo/municipio.php';

class ControlMunicipio{
    private $cnx;
    
 public function __construct(){
     require_once 'conexion/Db.php';
     try{
         $this->cnx = Db::conectar();
     }
     catch(PDOException $ex){
         die($ex->getMessage());
     }
 }
 public function consultaMunicipio(){
     try{
        $sql = "select * from municipio";
        $prep = $this->cnx->prepare($sql);
        $prep->execute();
        $municipios = $prep->fetchAll(PDO::FETCH_OBJ);
     }catch(PDOException $ex){
         die($ex->getMessage());
     }
    return $municipios;
 }
 public function consultaMunicipioPorId($id){
     try{
        $sql = "select * from municipio where cod_municipio = $id";
        $prep = $this->cnx->prepare($sql);
        $prep->execute();
        $municipios = $prep->fetchAll(PDO::FETCH_OBJ);
     }catch(PDOException $ex){
         die($ex->getMessage());
     }
     return $municipios;
 }
 
 public function consultaMunicipioPorId2($id){
     try{
        $sql = "select nombre from municipio where cod_municipio = $id";
        $prep = $this->cnx->prepare($sql);
        $prep->execute();
        return $prep->fetchObject();
     }catch(PDOException $ex){
         die($ex->getMessage());
     }
 }
}