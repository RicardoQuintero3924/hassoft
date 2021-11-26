<?php
require_once 'modelo/BandaReco.php';
class ControlBandaReco
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
    public function registroClasificacion($bandaCate)
    {
        try {
            $sql2 = "select cod_clasificacion from clasificacion ORDER BY cod_clasificacion DESC LIMIT 1 ";
            $prep2 = $this->cnx->prepare($sql2);
            $prep2->execute();
            $sql = "insert into banda_reco (cod_banda, cod_clasificacion, contador, cod_cate) values (?, ?, ?, ?)";
            $prep = $this->cnx->prepare($sql);
            $prep->execute([
                $bandaCate->GetCodBanda(),
                $prep2->fetchAll(PDO::FETCH_OBJ)[0]->cod_clasificacion,
                $bandaCate->GetContador(),
                $bandaCate->GetCodCate(),
            ]);
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }
}