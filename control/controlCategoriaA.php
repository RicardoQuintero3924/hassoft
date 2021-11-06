<?php 
require_once 'modelo/aCategoria.php';
class ControlCategoriaA{
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
 public function actualizaCategoria($categoria){
    try{
        if ($categoria->GetEstado() == 0) {
            $sql = "update categoria set nombre = ?, peso_inicial = ?, peso_final = ?, descripcion = ?, estado = 0 where cod_categoria = ?";
        } else {
            $sql = "update categoria set nombre = ?, peso_inicial = ?, peso_final = ?, descripcion = ?, estado = 1 where cod_categoria = ?";
        }
       $prep = $this->cnx->prepare($sql);
       $prep->execute([
           $categoria->GetNombre(),
           $categoria->GetPesoI(),
           $categoria->GetPesoF(),
           $categoria->GetDescripcion(),
        //    $categoria->GetEstado(),
           $categoria->GetCodCategoria()
       ]);

    }catch(PDOException $ex){
        die($ex->getMessage());
    }

}
}