<?php
require_once 'control/controlPersona.php';
require_once 'control/controlPerfil.php';
session_start();
$varsesion = $_SESSION['usuario'];
// error_reporting(0);
if ($varsesion == null || $varsesion == '') {
    echo '<script type="text/javascript"> alert("USTED NO TIENE AUTORIZACIÓN")</script>';
    die();
    header('location:index.php');
}


$controlPersona = new controlPersona();
$controlPerfil = new ControlPerfil();
$id = $_GET['cedula'];
$persona = $controlPersona->consultaPersonaPorId($id);
$errores = '';
if(isset($_POST['Modificar'])){
    $cedula = $_POST['cedula'];
    $pnombre = $_POST['pnombre'];
    $snombre = $_POST['snombre'];
    $papellido = $_POST['papellido'];
    $sapellido = $_POST['sapellido'];
    $celular = $_POST['celular'];
    $correo = $_POST['correo'];
    $perfil = $_POST['perfil'];
    $estado = $_POST['estado'];

    if(!empty($cedula)){
        $cedula = trim($cedula);
        $cedula = filter_var($cedula, FILTER_SANITIZE_NUMBER_INT);
    }else{
        $errores .= 'EL CAMPO CÉDULA ES OBLIGATORIO';
    }
    if(!empty($pnombre)){
        $pnombre = trim($pnombre);
        $pnombre = filter_var($pnombre, FILTER_SANITIZE_STRING);
    }else{
        $errores .= 'EL CAMPO PRIMER NOMBRE ES OBLIGATORIO';
    }
   
    if(!empty($papellido)){
        $papellido = trim($papellido);
        $papellido = filter_var($papellido, FILTER_SANITIZE_STRING);
    }else{
        $errores .= 'EL CAMPO PRIMER APELLIDO ES REQUERIDO';
    }
    if(!empty($sapellido)){
        $sapellido = trim($sapellido);
        $sapellido = filter_var($sapellido, FILTER_SANITIZE_STRING);
    }else{
        $errores .= 'EL CAMPO SEGUNDO APELLIDO ES REQUERIDO';
    }
    if(!empty($celular)){
        $celular = trim($celular);
        $celular = filter_var($celular, FILTER_SANITIZE_NUMBER_INT);
    }else{
        $errores .= 'EL CAMPO CELULAR ES OBLIGATORIO';
    }
    if(!empty($correo)){
        $correo = trim($correo);
        $correo = filter_var($correo, FILTER_SANITIZE_EMAIL);
    }else{
        $errores = 'EL CORREO ES OBLIGATORIO';
    }
   
    if($perfil == ""){
        $errores .= 'DEBE SELECCIONAR EL PERFIL';
    }
    if($estado == ""){
        $errores .= 'DEBE SELECCIONAR EL ESTADO';
    }

    if(!$errores){  
        require_once 'modelo/persona.php';
        $controlPersona = new controlPersona();
    
        $persona = new Persona($cedula, $pnombre, $snombre, $papellido, $sapellido, $celular, $correo, $perfil, $estado);
        $controlPersona->actualizarPersona($persona);
        echo '<script type="text/javascript"> alert("REGISTRO MODIFICADO CON ÉXITO")</script>';
        header('location:consultaPersona.php');
        
    }else{
        echo '<script type="text/javascript"> alert("POR FAVOR DILIGENCIAR TODOS LOS CAMPOS ")</script>' ."$errores";
    }

}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/estilos.css">
    <title>HASSOFT</title>
</head>

<body>
    <header id="header">
        <div class="sesion">
            <h3>Usuario: <?php echo $_SESSION['usuario'] ?></h3>
            <a href="cerrarsesion.php" class="btn-sesion">Cerrar Sesión</a>
        </div>
        <div class="center">
            <!--Logo-->
            <div id="logo">
                <a href="paginaPpal.php"><img src="images/Hassoft.PNG" class="app-logo" alt="logotipo"></a>
                <span id="brand"><strong>HASSOFT</span>

            </div>

            <!--LIMPIAR FLOTADOS-->
            <div class="clearfix"></div>
        </div>
    </header>
    <div id="slider" class="slider-big">
        <!--Menu-->
        <nav id="menu">
            <ul>
                <li><a href="paginaPpal.php">Inicio</a></li>
                <li><a href="Consultapersona.php">Consulta Persona</a></li>
                <li><a href="categoria.php">Categoría</a></li>
                <li><a href="finca.php">Finca</a></li>
                <li><a href="perfil.php">Perfiles</a></li>
            </ul>
        </nav>
    </div>
    <div class="clearfix"></div>
    <p style="float: right; margin-right: 10px">Los campos con (<span style="color: red">*</span>) son obligatorios</p>
    <div class="bloque">
        <?php foreach($persona as $person) :
             $idF = $person->cod_perfil;
             $perfil = $controlPerfil->consultaPerfilesPorId($idF);?>
        <form action="" method="post" class="form">
            <h3><a href=""><i class="far fa-user"></i></a>Modificar Persona</h3>
            <label for="cedula">Cédula <span style="color: red">*</span></label>
            <input type="number" name="cedula" value="<?= $person->cedula ?>" id="cedula" placeholder="Cédula" onkeyup="validacionRequire(this)" required>
            <label for="pnombre">Primer Nombre <span style="color: red">*</span></label>
            <input type="text" name="pnombre" value="<?= $person->primer_nombre?>" id="pnombre" placeholder="Primer Nombre" onkeyup="validacionRequire(this)" required>
            <label for="snombre">Segundo Nombre</label>
            <input type="text" name="snombre" value="<?= $person->segundo_nombre?>" id="snombre" placeholder="Segundo Nombre" onkeyup="validarForm(this.parentNode)">
            <label for="papellido">Primer Apellido <span style="color: red">*</span></label>
            <input type="text" name="papellido" value="<?= $person->primer_apellido?>" id="papellido" placeholder="Primer Apellido" onkeyup="validacionRequire(this)" required>
            <label for="sapellido">Segundo Apellido</label>
            <input type="text" name="sapellido"  value="<?= $person->segundo_apellido?>" id="sapellido" placeholder="Segundo Apellido" onkeyup="validarForm(this.parentNode)">
            <label for="celular">Celular <span style="color: red">*</span></label>
            <input type="number" name="celular" value="<?= $person->celular?>" id="celular" placeholder="Celular" onkeyup="validacionNumeroCelular(this)" required>
            <label for="correo">Correo <span style="color: red">*</span></label>
            <input type="email" name="correo" value="<?= $person->correo?>" id="correo" placeholder="Correo" onkeyup="validacionCorreo(this)" required>
            <label for="estado">Estado <span style="color: red">*</span></label>
            <select name="estado" id="estado" onchange="validarForm(this.parentNode)" required>
                <option value="" disabled selected>--Seleccione--</option>
                <?php $estadoA = $person->estado;
                if($estadoA == 1){?>
                <option value="1" selected><?= $person->estado." "."Activo" ?></option>
                <option value="0" >Inactivo </option>
                <?php }else if($estadoA == 0){ ?>
                <option value="0" selected><?= $person->estado." "."Inactivo"?></option>
                <option value="1" >Activo</option>  
                <?php }?>
            </select>
            <?php endforeach; ?>
            <label for="perfil">Perfil <span style="color: red">*</span></label>
            <select name="perfil" id="perfil" onchange="validarForm(this.parentNode)" required>
                <?php foreach($perfil as $per):?>
                <option value="<?php echo $per->cod_perfil ?>" selected><?= $per->cod_perfil ." ". $per->descripcion?></option>
                <?php endforeach;?>    
            </select>
            
            <input type="submit" value="MODIFICAR" name="Modificar" class="btn-sesion desabilitarItem" id="submit">
        </form>
    </div>


    <footer id="footer">
        <div class="center">
            <p>&copy; HASSOFT TODOS LOS DERECHOS RESERVADOS</p>
        </div>

    </footer>
        
    <script src="validacion/validacion.js"></script>
</body>

</html>