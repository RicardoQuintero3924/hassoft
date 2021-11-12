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
}