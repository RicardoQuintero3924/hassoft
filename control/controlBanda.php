<?php
require_once 'modelo/banda.php';

class ControlBanda{
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
    public function agregarBanda($banda){
        try{
            $sql = "insert into banda (cod_banda, descripcion, estado, cod_finca) values (?, ?, ?, ?)";
            $prep = $this->cnx->prepare($sql);
            $prep->execute([
                $banda->GetCodBanda(),
                $banda->GetDescripcion(),
                $banda->GetEstado(),
                $banda->GetCodFinca()
            ]);
        }catch(PDOException $ex){
            die($ex->getMessage());
        }
    }

    public function consultaBandas(){
        try{
            $sql = "select * from banda";
            $prep= $this->cnx->prepare($sql);
            $prep->execute();
            $bandas = $prep->fetchAll(PDO::FETCH_OBJ);
        }catch(PDOException $ex){
            die($ex->getMessage());
        }
        return $bandas;
    }

    public function consultaBandasPorId($id){
        try{
            $sql = "select * from banda where cod_banda = $id";
            $prep = $this->cnx->prepare($sql);
            $prep->execute();
            $banda = $prep->fetchAll(PDO::FETCH_OBJ);
        }catch(PDOException $ex){
            die($ex->getMessage());
        }
        return $banda;
    }

    public function consultaUltimoRegistro(){
        try{
            $sql = "select * from banda order by cod_banda desc limit 1";
            $prep = $this->cnx->prepare($sql);
            $prep->execute();
            $banda = $prep->fetchAll(PDO::FETCH_OBJ);
        }catch(PDOException $ex){
            die($ex->getMessage());
        }
        return $banda;
    }

    public function actualizaBanda($banda){
        try{
            $sql = "update banda set descripcion = ?, estado = ?, cod_finca = ? where cod_banda = ?";
            $prep = $this->cnx->prepare($sql);
            $prep->execute([
                $banda->GetDescripcion(),
                $banda->GetEstado(),
                $banda->GetCodFinca(),
                $banda->GetCodBanda()
            ]);

        }catch(PDOException $ex){
            die($ex->getMessage());
        }
    }
}