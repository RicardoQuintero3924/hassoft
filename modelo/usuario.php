<?php
class Usuario{
    private $nombre;
    private $clave;
    private $estado;

    public function __construct($nombre, $clave, $estado)
    {
        $this->nombre = $nombre;
        $this->clave = $clave;
        $this->estado = $estado;
    }
    public function GetNombre(){
        return $this->nombre;
    }
    public function SetNombre($nombre){
        $this->nombre = $nombre;
    }
    public function GetClave(){
        return $this->clave;
    }
    public function SetClave($clave){
        $this->clave = $clave;
    }
    public function GetEstado(){
        return $this->estado;
    }
    public function SetEstado($estado){
        $this->estado = $estado;
    }
}