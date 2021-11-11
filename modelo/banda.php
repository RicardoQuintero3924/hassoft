<?php 
class Banda{
    private $codBanda;
    private $descripcion;
    private $estado;
    private $codFinca;

    public function __construct($codBanda, $descripcion, $estado, $codFinca)
    {
        $this->codBanda = $codBanda;
        $this->descripcion = $descripcion;
        $this->estado = $estado;
        $this->codFinca = $codFinca;
    }

    public function GetCodBanda(){
        return $this->codBanda;
    }
    public function SetCodBanda($codBanda){
        $this->codBanda = $codBanda;
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
    public function GetCodFinca(){
        return $this->codFinca;
    }
    public function SetCodFinca($codFinca){
        $this->codFinca = $codFinca;
    }
}