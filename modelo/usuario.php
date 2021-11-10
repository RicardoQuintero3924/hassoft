<?php
class Usuario{
    private $id;
    private $nombre;
    private $clave;
    private $estado;

    public function __construct($id,$nombre, $clave, $estado)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->clave = $clave;
        $this->estado = $estado;
    }
    public function GetId(){
        return $this->id;
    }
    public function SetId($id){
        $this->id = $id;
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