<?php
class BandaReco {
    private $codBanda;
    private $codClasificacion;
    private $contador;
    private $codCate;

    public function __construct($codBanda, $codClasificacion, $contador, $codCate)
    {
        $this->codBanda = $codBanda;
        $this->codClasificacion = $codClasificacion;
        $this->contador = $contador;
        $this->codCate = $codCate;
    }
    public function GetCodBanda(){
        return $this->codBanda;
    }
    public function GetCodClasificacion(){
        return $this->codClasificacion;
    }
    public function GetContador(){
        return $this->contador;
    }
    public function GetcodCate(){
        return $this->codCate;
    }
}