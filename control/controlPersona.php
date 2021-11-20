<?php
require_once 'modelo/persona.php';

class controlPersona{
    private $cnx;
    
    public function __construct(){
        require_once 'conexion/Db.php';
        try{
            $this->cnx = Db::conectar();
        }
        catch(PDOException $ex){
            die($ex->getMessage());
        }
    }
    public function registroPersona($persona){
        try{
            $sql = "insert into persona (cedula , primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, celular, correo, estado, cod_perfil) values (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $prep= $this->cnx->prepare($sql);
            $prep->execute([
                $persona->GetCedula(),
                $persona->GetPNombre(),
                $persona->GetSNombre(),
                $persona->GetPApellido(),
                $persona->GetSApellido(),
                $persona->GetCelular(),
                $persona->GetCorreo(),
                $persona->GetEstado(),
                $persona->GetPerfil()
            ]);
        }catch(PDOException $ex){
            die($ex->getMessage());
        }
    }
    public function consultaPersona(){
        try{
            $sql = "select * from persona";
            $prep = $this->cnx->prepare($sql);
            $prep->execute();
            $personas = $prep->fetchAll(PDO::FETCH_OBJ);
        }catch(PDOException $ex){
            die($ex->getMessage());
        }
        return $personas;
    
    }
    public function consultaPersonaPorEstado($estado){
        try{
            $sql = "select * from persona where estado = $estado";
            $prep = $this->cnx->prepare($sql);
            $prep->execute();
            $personas = $prep->fetchAll(PDO::FETCH_OBJ);
        }catch(PDOException $ex){
            die($ex->getMessage());
        }
        return $personas;
    }
    
    public function consultaPersonaPorPerfil($id){
        try{
            $sql = "select * from persona where cod_perfil = $id";
            $prep = $this->cnx->prepare($sql);
            $prep->execute();
            $personas = $prep->fetchAll(PDO::FETCH_OBJ);
        }catch(PDOException $ex){
            die($ex->getMessage());
        }
        return $personas;
    }

    public function consultaPersonaPorId($id){
        try{
            $sql = "select * from persona where cedula = $id";
            $prep= $this->cnx->prepare($sql);
            $prep->execute();
            $persona = $prep->fetchAll(PDO::FETCH_OBJ);
        }catch(PDOException $ex){
            die($ex->getMessage());
        }
        return $persona;
    }

    public function consultaPersonaFincaPorId($id){
        try{
            $sql = "SELECT COUNT(cod_finca) as count, cod_finca, cedula FROM `finca_persona` GROUP by cod_finca HAVING cedula = $id";
            $prep= $this->cnx->prepare($sql);
            $prep->execute();
            $persona = $prep->fetchAll(PDO::FETCH_OBJ);
        }catch(PDOException $ex){
            die($ex->getMessage());
        }
        return $persona;
    }

    public function actualizarPersona($persona){
        try{
            if ($persona->GetEstado() == 0) {
                $sql = "update persona set  primer_nombre = ?, segundo_nombre = ?, primer_apellido = ?, segundo_apellido = ?, celular = ?, correo = ?, estado = 0, cod_perfil = ? where cedula = ?";
            } else {
                $sql = "update persona set  primer_nombre = ?, segundo_nombre = ?, primer_apellido = ?, segundo_apellido = ?, celular = ?, correo = ?, estado = 1, cod_perfil = ? where cedula = ?";
            }
            // $sql = "update persona set  primer_nombre = ?, segundo_nombre = ?, primer_apellido = ?, segundo_apellido = ?, celular = ?, correo = ?, estado = ?, cod_perfil = ? where cedula = ?";
            $prep = $this->cnx->prepare($sql);
            $prep->execute([
                $persona->GetPNombre(),
                $persona->GetSNombre(),
                $persona->GetPApellido(),
                $persona->GetSApellido(),
                $persona->GetCelular(),
                $persona->GetCorreo(),
                $persona->GetPerfil(),
                // $persona->GetEstado(),
                $persona->GetCedula()
            ]);

        }catch(PDOException $ex){
            die($ex->getMessage());
        }
    }

    public function eliminarPersona($cedula){
        try{
            $sql = "update persona set estado = 0 where cedula = ?";
            $prep = $this->cnx->prepare($sql);
            $prep->execute([$cedula]);

        }catch(PDOException $ex){
            die($ex->getMessage());
        }
    }
}