<?php
require_once 'modelo/categoria.php';
class ControlCategoria{
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
 public function registroCategoria($categoria){
     try{
        $sql = "insert into categoria (nombre, peso_inicial, peso_final, descripcion, estado) values (?, ?, ?, ?, ?)";
        $prep = $this->cnx->prepare($sql);
        $prep->execute([
            $categoria->GetNombre(),
            $categoria->GetPesoI(),
            $categoria->GetPesoF(),
            $categoria->GetDescripcion(),
            $categoria->GetEstado()
        ]);
     }catch(PDOException $ex){
         die($ex->getMessage());
     }
 }
 public function consultaCategorias(){
     try{
        $sql = "select * from categoria";
        $prep = $this->cnx->prepare($sql);
        $prep->execute();
        $categorias = $prep->fetchAll(PDO::FETCH_OBJ);
     }catch(PDOException $ex){
         die($ex->getMessage());
     }
     return $categorias;
 }
 public function consultaCategoriaPorId($id){
    try{
        $sql = "select * from categoria where cod_categoria = $id";
        $prep = $this->cnx->prepare($sql);
        $prep->execute();
        $categoria = $prep->fetchAll(PDO::FETCH_OBJ);
    }catch(PDOException $ex){
        die($ex->getMessage());
    }
    return $categoria;
 }

}