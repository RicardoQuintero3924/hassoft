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
            $sql = "SELECT cl.*, cate.cod_categoria, cate.nombre, br.contador  FROM clasificacion cl INNER JOIN banda_reco br ON cl.cod_clasificacion = br.cod_clasificacion INNER JOIN categoria cate ON br.cod_cate = cate.cod_categoria";
            $prep = $this->cnx->prepare($sql);
            $prep->execute();
            $fincas = $prep->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
        return $fincas;
    }
}