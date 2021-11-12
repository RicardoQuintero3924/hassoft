<?php
class Recoleccion{
    private $codRecoleccion;
    private $cantCosecha;
    private $fechaI;
    private $fechaF;
    private $cantRecolectada;
    private $observaciones;
    private $estado;
    private $codFinca;
    private $codCategoria;

    public function __construct($codRecoleccion, $cantCosecha, $fechaI, $fechaF, $cantRecolectada, $observaciones, $estado, $codFinca, $codCategoria)
    {
        $this->codRecoleccion = $codRecoleccion;
        $this->cantCosecha = $cantCosecha;
        $this->fechaI = $fechaI;
        $this->fechaF = $fechaF;
        $this->cantRecolectada = $cantRecolectada;
        $this->observaciones = $observaciones;
        $this->estado = $estado;
        $this->codFinca = $codFinca;
        $this->codCategoria = $codCategoria;
    }

    public function GetCodRecoleccion(){
        return $this->codRecoleccion;
    }
    public function SetCodRecoleccion($codRecoleccion){
        $this->codRecoleccion = $codRecoleccion;
    }
    public function GetCantCosecha(){
        return $this->cantCosecha;
    }
    public function SetCantCosecha($cantCosecha){
        $this->cantCosecha = $cantCosecha;
    }
    public function GetFechaI(){
        return $this->fechaI;
    }
    public function SetFechaI($fechaI){
        $this->fechaI = $fechaI;
    }
    public function GetFechaF(){
        return $this->fechaF;
    }
    public function SetFechaF($fechaF){
        $this->fechaF = $fechaF;
    }
    public function GetCantRecolectada(){
        return $this->cantRecolectada;
    }
    public function SetCantRecolectada($cantRecolectada){
        $this->cantRecolectada = $cantRecolectada;
    }
    public function GetObservaciones(){
        return $this->observaciones;
    }
    public function SetObservaciones($observaciones){
        $this->observaciones = $observaciones;
    }
    public function GetEstado(){
        return $this->estado;
    }
    public function SetEstado($estado){
        $this->estado = $estado;
    }
    public function GetCodFinca(){
        return $this->codFinca;
    }
    public function SetCodFinca($codFinca){
        $this->codFinca = $codFinca;
    }
    public function GetCodCategoria(){
        return $this->codCategoria;
    }
    public function SetCodCategoria($codCategoria){
        $this->codCategoria = $codCategoria;
    }
}