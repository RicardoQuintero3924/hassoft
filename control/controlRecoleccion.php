<?php
require_once 'modelo/recoleccion.php';

class ControlRecoleecion{
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
    public function AgregarRecoleccion($recoleccion){
        try{
            $sql= "insert into recoleccion (cod_recoleccion, cant_cosecha, fecha_inicio, fecha_final, cantidad_recolectada, observaciones, estado, cod_finca, cod_clasificacion) values (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $prep = $this->cnx->prepare($sql);
            $prep->execute([
                $recoleccion->GetCodRecoleccion(),
                $recoleccion->GetCantCosecha(),
                $recoleccion->GetFechaI(),
                $recoleccion->GetFechaF(),
                $recoleccion->GetCantRecolectada(),
                $recoleccion->GetObservaciones(),
                $recoleccion->GetEstado(),
                $recoleccion->GetCodFinca(),
                $recoleccion->GetCodCategoria()
            ]);
        }catch(PDOException $ex){
            die($ex->getMessage());
        }

    }
    public function consultaUltimoRegistro(){
        try{
            $sql = "select * from recoleccion order by cod_recoleccion desc limit 1";
            $prep = $this->cnx->prepare($sql);
            $prep->execute();
            $recoleccion = $prep->fetchAll(PDO::FETCH_OBJ);
        }catch(PDOException $ex){
            die($ex->getMessage());
        }
        return $recoleccion;
    }
    public function consultaRecolecciones(){
        try{
            $sql = "select * from recoleccion";
            $prep = $this->cnx->prepare($sql);
            $prep->execute();
            $recolecciones = $prep->fetchAll(PDO::FETCH_OBJ);

        }catch(PDOException $ex){
            die($ex->getMessage());
        }
        return $recolecciones;
    }

    public function consultaRecoleccionPorId($id){
        try{
            $sql = "select * from recoleccion where cod_recoleccion = $id";
            $prep = $this->cnx->prepare($sql);
            $prep->execute();
            $recoleccion = $prep->fetchAll(PDO::FETCH_OBJ);
        }catch(PDOException $ex){
            die($ex->getMessage());
        }
        return $recoleccion;

    }
    public function actualizaRecoleccion($recoleccion){
        try{
            $sql= "update recoleccion set  cant_cosecha = ?,  fecha_inicio = ?, fecha_final = ?, cantidad_recolectada = ?, observaciones = ?, estado = ?, cod_finca = ?, cod_clasificacion = ? where cod_recoleccion = ?";
            $prep = $this->cnx->prepare($sql);
            $prep->execute([
                $recoleccion->GetCantCosecha(),
                $recoleccion->GetFechaI(),
                $recoleccion->GetFechaF(),
                $recoleccion->GetCantRecolectada(),
                $recoleccion->GetObservaciones(),
                $recoleccion->GetEstado(),
                $recoleccion->GetCodFinca(),
                $recoleccion->GetCodCategoria(),
                $recoleccion->GetCodRecoleccion()
            ]);
        }catch(PDOException $ex){
            die($ex->getMessage());
        }

    }
}