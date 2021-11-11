<?php
require_once 'modelo/aperfil.php';

class ControlPerfilA
{
    private $cnx;

    public function __construct()
    {
        require_once 'conexion/Db.php';
        try {
            $this->cnx = Db::conectar();
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }
    public function actualizarPerfil($perfil){
        try{
           $sql= "update perfil set descripcion = ?, estado = ? where cod_perfil = ?";
           $prep = $this->cnx->prepare($sql);
           $prep->execute([
               $perfil->GetDescripcion(),
               $perfil->GetEstado(),
               $perfil->GetId()
           ]);
        }catch(PDOException $ex){
            die($ex->getMessage());
        }
    }
}
