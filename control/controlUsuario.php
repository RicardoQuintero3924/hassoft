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
            $sql = "insert into usuario (idUsuario, nombre, clave, estado) values (?, ?, ?, ?)";
            $prep = $this->cnx->prepare($sql);
            $prep->execute([
                $usuario->GetId(),
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
    public function actualizarEstado($estado, $usuario){
        try{
            $sql = "update usuario set Estado = $estado where idUsuario = $usuario";
            $prep = $this->cnx->prepare($sql);
            $prep->execute();
        }catch(PDOException $ex){
            die($ex->getMessage());
        }
    }
}