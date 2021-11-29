<?php
require_once 'modelo/Clasificacion.php';
class ControlClasificacion
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

    public function registroClasificacion($clasificacion)
    {
        try {
            $sql = "insert into clasificacion (nro_aguacates, peso_total, fecha_inicial, fecha_final, estado) values (?, ?, ?, ?, ?)";
            $prep = $this->cnx->prepare($sql);
            $prep->execute([
                $clasificacion->GetNroAguacates(),
                $clasificacion->GetPesoTotal(),
                $clasificacion->GetFechaInicial(),
                $clasificacion->GetFechaFinal(),
                $clasificacion->GetEstado(),
            ]);
            // var_dump("Hola");

            // crearBandaReco();
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }

    public function consultaClasificaciones()
    {
        try {
            $sql = "SELECT * FROM clasificacion ORDER BY cod_clasificacion DESC;";
            $prep = $this->cnx->prepare($sql);
            $prep->execute();
            $fincas = $prep->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
        return $fincas;
    }
    
    public function consultaClasificacionPorId($id)
    {
        try {
            $sql = "SELECT * FROM clasificacion WHERE cod_clasificacion = $id";
            $prep = $this->cnx->prepare($sql);
            $prep->execute();
            $fincas = $prep->fetchObject();
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
        return $fincas;
    }
    
    public function consultaCategoriaPorClasificacion($id)
    {
        try {
            $sql = "SELECT cate.nombre, cate.cod_categoria, br.contador FROM banda_reco br INNER JOIN categoria cate ON br.cod_cate = cate.cod_categoria WHERE br.cod_clasificacion = $id";
            $prep = $this->cnx->prepare($sql);
            $prep->execute();
            $fincas = $prep->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
        return $fincas;
    }
    
    public function consultaCategoriaPorFecha($fecha)
    {
        try {
            $sql = "SELECT * FROM clasificacion WHERE fecha_inicial LIKE '%$fecha%'";
            $prep = $this->cnx->prepare($sql);
            $prep->execute();
            $fincas = $prep->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
        return $fincas;
    }
}