<?php
require_once 'modelo/usuario.php';

class ControlUsuario{
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
    public function registroUsuario($usuario){
        try{
            $sql = "insert into usuario (nombre, clave, estado) values (?, ?, ?)";
            $prep = $this->cnx->prepare($sql);
            $prep->execute([
                $usuario->GetNombre(),
                $usuario->GetClave(),
                $usuario->GetEstado()
            ]);
        }catch(PDOException $ex){
            die($ex->getMessage());
        }
    }
    public function consultaUsuario($user){
        try{
            $sql = 'select * from usuario where nombre = ?';
            $prep = $this->cnx->prepare($sql);
            $prep->execute([$user]);
            $usuarios = $prep->fetchAll(PDO::FETCH_OBJ);
        }catch (PDOException $ex){
            die($ex->getMessage());
        }
        return $usuarios;
    }
}