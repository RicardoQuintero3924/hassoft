<?php
require_once 'modelo/finca.php';
class ControlFinca
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
    public function registroFinca($finca)
    {
        try {
            $sql = "insert into finca (cod_finca, nombre, direccion, telefono, correo, nro_hectareas_cultivadas, cod_municipio ,estado) values (?, ?, ?, ?, ?, ?, ?, ?)";
            $prep = $this->cnx->prepare($sql);
            $prep->execute([
                $finca->GetFinca(),
                $finca->GetNombre(),
                $finca->GetDireccion(),
                $finca->GetTelefono(),
                $finca->GetCorreo(),
                $finca->GetNroHectareas(),
                $finca->GetMunicipio(),
                $finca->GetEstado()
            ]);
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }

    public function consultaFinca()
    {
        try {
            $sql = "select * from finca";
            $prep = $this->cnx->prepare($sql);
            $prep->execute();
            $fincas = $prep->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
        return $fincas;
    }
    
    public function consultaFincaPorEstado($estado)
    {
        try {
            $sql = "select * from finca where estado = $estado";
            $prep = $this->cnx->prepare($sql);
            $prep->execute();
            $fincas = $prep->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
        return $fincas;
    }

    public function consultaFincaPorId($id)
    {
        try {
            $sql = "select * from finca where cod_finca = $id";
            $prep = $this->cnx->prepare($sql);
            $prep->execute();
            $finca = $prep->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
        return $finca;
    }
    public function actualizaFinca($finca)
    {
        try {
            if ($finca->GetEstado() == 0) {
                $sql = "update finca set nombre = ?, direccion = ?, telefono = ?, correo = ?, nro_hectareas_cultivadas = ?, estado = 0, cod_municipio = ? where cod_finca = ?";
            } else {
                $sql = "update finca set nombre = ?, direccion = ?, telefono = ?, correo = ?, nro_hectareas_cultivadas = ?, estado = 1, cod_municipio = ? where cod_finca = ?";
            }
            // $sql = 'update finca set nombre = ?, direccion = ?, telefono = ?, correo = ?, nro_hectareas_cultivadas = ?, estado = ?, cod_municipio = ? where cod_finca = ?';
            $prep = $this->cnx->prepare($sql);
            $prep->execute([
                $finca->GetNombre(),
                $finca->GetDireccion(),
                $finca->GetTelefono(),
                $finca->GetCorreo(),
                $finca->GetNroHectareas(),
                $finca->GetMunicipio(),
                $finca->GetFinca()
            ]);
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }
    
    public function consultaUltimoRegistro(){
        try{
            $sql = "select * from finca order by cod_finca desc limit 1";
            $prep = $this->cnx->prepare($sql);
            $prep->execute();
            $banda = $prep->fetchAll(PDO::FETCH_OBJ);
        }catch(PDOException $ex){
            die($ex->getMessage());
        }
        return $banda;
    }

}
