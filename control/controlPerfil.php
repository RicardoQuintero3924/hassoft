<?php
require_once 'modelo/perfil.php';

class ControlPerfil{
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
 public function registrarPerfil($perfil){
     try{
        $sql="insert into perfil (descripcion, estado) values (?, ?)";
        $prep= $this->cnx->prepare($sql);
        $prep->execute([
            $perfil->GetDescripcion(),
            $perfil->GetEstado()
        ]);
     }catch(PDOException $ex){
         die($ex->getMessage());
     }
 }
 public function consultaPerfiles(){
     try{
        $sql = "select * from perfil";
        $prep= $this->cnx->prepare($sql);
        $prep->execute();
        $perfiles = $prep->fetchAll(PDO::FETCH_OBJ);
     }catch(PDOException $ex){
         die($ex->getMessage());
     }
     return $perfiles;
 }
 public function consultaPerfilesPorId($id){
     try{
        $sql= "select * from perfil where cod_perfil = $id";
        $prep = $this->cnx->prepare($sql);
        $prep->execute();
        $perfiles = $prep->fetchAll(PDO::FETCH_OBJ);
     }catch(PDOException $ex){
         die($ex->getMessage());
     }
     return $perfiles;
 }

 
 
}