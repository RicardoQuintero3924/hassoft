<?php
class ControlFincaPersona{
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

    public function AgregarFincaPersona($finca , $cedula){
        try{
            $sql = "insert into finca_persona set cod_finca = $finca, cedula = $cedula";
            $prep = $this->cnx->prepare($sql);
            $prep->execute();

        }catch(PDOException $ex){
            die($ex->getMessage());
        }
    }
    
    public function EliminarFincaPersona($finca , $cedula){
        try{
            $sql = "DELETE FROM finca_persona WHERE cod_finca = $finca AND cedula = $cedula";
            $prep = $this->cnx->prepare($sql);
            $prep->execute();

        }catch(PDOException $ex){
            die($ex->getMessage());
        }
    }
    
    public function BuscarPersonasPorCodFinca($finca){
        try{
            $sql = "select cedula from finca_persona where cod_finca = $finca";
            $prep = $this->cnx->query($sql);
            // var_dump($prep->fetch());
            return $prep->fetchAll(PDO::FETCH_COLUMN, 0);

        }catch(PDOException $ex){
            die($ex->getMessage());
        }
    }
}