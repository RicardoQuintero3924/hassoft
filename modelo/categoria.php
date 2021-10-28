<?php
class Categoria {
    private $nombre;
    private $pesoI;
    private $pesoF;
    private $descripcion;
    private $estado;

    public function __construct($nombre, $pesoI, $pesoF, $descripcion, $estado)
    {
        $this->nombre = $nombre;
        $this->pesoI = $pesoI;
        $this->pesoF = $pesoF;
        $this->descripcion = $descripcion;
        $this->estado = $estado;
    }
    public function GetNombre(){
        return $this->nombre;
    }
    public function SetNombre($nombre){
        $this->nombre = $nombre;
    }
    public function GetPesoI(){
        return $this->pesoI;
    }
    public function SetPesoI($pesoI){
        $this->pesoI = $pesoI;
    }
    public function GetPesoF(){
        return $this->pesoF;
    }
    public function SetPesoF($pesoF){
        $this->pesoF = $pesoF;
    }
    public function GetDescripcion(){
        return $this->descripcion;
    }
    public function SetDescripcion($descripcion){
        $this->descripcion = $descripcion;
    }
    public function GetEstado(){
        return $this->estado;
    }
    public function SetEstado($estado){
        $this->estado = $estado;
    }
}