<?php
class Clasificaion {
    private $id;
    private $nroAguacates;
    private $pesoTotal;
    private $fechaInicial;
    private $fechaFinal;
    private $estado;

    public function __construct($id, $nroAguacates, $pesoTotal, $fechaInicial, $fechaFinal, $estado, $banda)
    {
        $this->id = $id;
        $this->nroAguacates = $nroAguacates;
        $this->pesoTotal = $pesoTotal;
        $this->fechaInicial = $fechaInicial;
        $this->estado = $estado;
        $this->fechaFinal = $fechaFinal;
        $this->banda = $banda;
    }
    public function GetId(){
        return $this->id;
    }
    public function GetNroAguacates(){
        return $this->nroAguacates;
    }
    public function GetPesoTotal(){
        return $this->pesoTotal;
    }
    public function GetFechaInicial(){
        return $this->fechaInicial;
    }
    public function GetEstado(){
        return $this->estado;
    }
    public function GetFechaFinal(){
        return $this->fechaFinal;
    }
    
    public function GetBanda(){
        return $this->banda;
    }
}