<?php
class Finca{
    private $nombre;
    private $direccion;
    private $telefono;
    private $correo;
    private $nroHectareas;
    private $municipio;
    private $estado;
    private $personas;

    public function __construct($nombre, $direccion, $telefono, $correo, $nroHectareas, $municipio, $estado, $personas)
    {
        $this->nombre = $nombre;
        $this->direccion = $direccion;
        $this->telefono = $telefono;
        $this->correo = $correo;
        $this->nroHectareas = $nroHectareas;
        $this->municipio = $municipio;
        $this->estado = $estado;
        $this->personas = $personas;
    }
    public function GetNombre(){
        return $this->nombre;
    }
    public function SetNombre($nombre){
        $this->nombre = $nombre;
    }
    public function GetDireccion(){
        return $this->direccion;
    }
    public function SetDireccion($direccion){
        $this->direccion = $direccion;
    }
    public function GetTelefono(){
        return $this->telefono;
    }
    public function SetTelefono($telefono){
        $this->telefono = $telefono;
    }
    public function GetCorreo(){
        return $this->correo;
    }
    public function SetCorreo($correo){
        $this->correo = $correo;
    }
    public function GetNroHectareas(){
        return $this->nroHectareas;
    }
    public function SetNroHectareas($nroHectareas){
        $this->nroHectareas = $nroHectareas;
    }
    public function GetMunicipio(){
        return $this->municipio;
    }
    public function SetMunicipio($municipio){
        $this->municipio = $municipio;
    }
    public function GetEstado(){
        return $this->estado;
    }
    public function SetEstado($estado){
        $this->estado = $estado;
    }
    public function GetPersonas(){
        return $this->personas;
    }
}