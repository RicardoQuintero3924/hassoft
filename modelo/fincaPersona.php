<?php 
class FincaPersona{
    private $codFinca;
    private $cedula;

    public function __construct($codFinca, $cedula)
    {
    $this->codFinca = $codFinca;
    $this->cedula = $cedula;        
    }

    public function GetCodFinca(){
        return $this->codFinca;
    }
    public function SetCodFinca($codFinca){
        $this->codFinca = $codFinca;
    }
    public function GetCedula(){
        return $this->cedula;
    }
    public function SetCedula($cedula){
        $this->cedula = $cedula;
    }
}