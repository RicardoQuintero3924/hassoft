<?php
class ActualizaPerfil{
    private $descripcion;
    private $estado;
    private $id;
    

    public function __construct($id, $descripcion, $estado)
    {
        $this->id = $id;
        $this->descripcion = $descripcion;
        $this->estado = $estado;
    }
    public function GetId(){
        return $this->id;
    }
    public function SetId($id){
        $this->id = $id;
    }
    public function GetDescripcion(){
        return $this->descripcion;
    }
    public function SetDescripcion($estado){
        $this->estado = $estado;
    }
    public function GetEstado(){
        return $this->estado;
    }
    public function SetEstado($estado){
        $this->estado = $estado;
    }
}