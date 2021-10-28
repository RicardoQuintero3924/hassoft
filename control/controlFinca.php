<?php
require_once 'modelo/finca.php';
class ControlFinca{
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
 public function registroFinca($finca){
     try{
        $sql= "insert into finca (nombre, direccion, telefono, correo, nro_hectareas_cultivadas, cod_municipio ,estado) values (?, ?, ?, ?, ?, ?, ?)";
        $prep = $this->cnx->prepare($sql);
        $prep->execute([
            $finca->GetNombre(),
            $finca->GetDireccion(),
            $finca->GetTelefono(),
            $finca->GetCorreo(),
            $finca->GetNroHectareas(),
            $finca->GetMunicipio(),
            $finca->GetEstado()
        ]);
     }catch(PDOException $ex){
         die($ex->getMessage());
     }
 }

 public function consultaFinca(){
     try{
        $sql = "select * from finca";
        $prep = $this->cnx->prepare($sql);
        $prep->execute();
        $fincas = $prep->fetchAll(PDO::FETCH_OBJ);
     }catch(PDOException $ex){
         die($ex->getMessage());
     }
     return $fincas;
 }
}
 