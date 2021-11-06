<?php
require_once 'control/controlMunicipio.php';
require_once 'control/controlPersona.php';
$controlMunicipio = new ControlMunicipio();
$controlPersona = new ControlPersona();
$personas = $controlPersona->consultaPersona();
$municipios = $controlMunicipio->consultaMunicipio();
session_start();
$varsesion = $_SESSION['usuario'];
error_reporting(0);
if ($varsesion == null || $varsesion == '') {
    echo '<script type="text/javascript"> alert("USTED NO TIENE AUTORIZACIÓN")</script>';
    die();
    header('location:index.php');
}
$errores = "";
if(isset($_POST['Registrar'])){
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $nroHectareas = $_POST['hectareas'];
    $municipio = $_POST['municipio'];
    $estado = $_POST['estado'];
    $personas = $_POST['personas'];

    if(!empty($nombre)){
        $nombre = trim($nombre);
        $nombre = filter_var($nombre, FILTER_SANITIZE_STRING);
    }else{
        $errores .= "DEBE INGRESAR EL NOMBRE";
    }
    if(!empty($direccion)){
        $direccion = trim($direccion);
        $direccion = filter_var($direccion, FILTER_SANITIZE_STRING);
    }else{
        $errores .= "DEBE INGRESAR LA DIRECCIÓN";
    }
    if(!empty($telefono)){
        $telefono = trim($telefono);
        $telefono = filter_var($telefono, FILTER_SANITIZE_NUMBER_INT);
    }else{
        $errores .= "DEBE INGRESAR EL TELÉFONO";
    }
    if(!empty($correo)){
        $correo = trim($correo);
        $correo = filter_var($correo, FILTER_SANITIZE_EMAIL);
    }else{
        $errores .= "DEBE INGRESAR UN CORREO";
    }
    if(!empty($nroHectareas)){
        $nroHectareas = trim($nroHectareas);
        $nroHectareas = filter_var($nroHectareas, FILTER_SANITIZE_NUMBER_INT);
    }else{
        $errores .= "DEBE INGRESAR LA CANTIDAD DE HECTÁREAS";
    }
    if($municipio == ""){
        $errores .= "DEBE SELECCIONAR UN MUNICIPIO";
    }
    if($estado == ""){
        $errores .= "DEBE SELECCIONAR UN ESTADO";
    }
    if(!$errores){
        require_once 'control/controlFinca.php';
        $controlFinca = new ControlFinca();
        $finca = new Finca($nombre, $direccion, $telefono, $correo, $nroHectareas, $municipio, $estado, $personas);
        $controlFinca->registroFinca($finca);
        echo '<script type="text/javascript"> alert("REGISTRO ALMACENADO CON ÉXITO")</script>';
    }else{
        echo '<script type="text/javascript"> alert("POR FAVOR DILIGENCIE TODOS LOS CAMPOS")</script>';
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
    
    <!-- Select 2 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha256-aAr2Zpq8MZ+YA/D6JtRD3xtrwpEz2IqOS+pWD/7XKIw=" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha256-OFRAJNoaD8L3Br5lglV7VyLRf0itmoBzWUoM+Sji4/8=" crossorigin="anonymous"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
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
                <li><a href="persona.php">Persona</a></li>
                <li><a href="categoria.php">Categoría</a></li>
                <li><a href="consultaFinca.php">Consulta Finca</a></li>
                <li><a href="perfil.php">Perfiles</a></li>
            </ul>
        </nav>
    </div>
    <div class="clearfix"></div>
    <p style="float: right; margin-right: 10px">Los campos con (<span style="color: red">*</span>) son obligatorios</p>
    <div class="bloque">
        <form action="" method="post" class="form">
            <h3><a href=""><i class="fas fa-tree"></i></a>FINCA</h3>
            <label for="nombre">Nombre <span style="color: red">*</span></label>
            <input type="text" name="nombre" id="nombre" placeholder="Nombre" onkeyup="validacionRequire(this)" required>
            <label for="direccion">Dirección <span style="color: red">*</span></label>
            <input type="text" name="direccion" id="direccion" placeholder="Dirección" onkeyup="validacionRequire(this)" required>
            <label for="telefono">Teléfono <span style="color: red">*</span></label>
            <input type="number" name="telefono" id="telefono" placeholder="Teléfono" onkeyup="validacionNumeroTelefono(this)" required>
            <label for="correo">Correo <span style="color: red">*</span></label>
            <input type="email" name="correo" id="correo" placeholder="Correo" onkeyup="validacionCorreo(this)" required>
            <label for="hectareas">Número Hectáreas <span style="color: red">*</span></label>
            <input type="number" name="hectareas" id="hectareas" placeholder="Número Hectáreas" onkeyup="validacionRequire(this)" required>
            <label for="municipio">Municipio <span style="color: red">*</span></label>
            <select name="municipio" id="municipio" onchange="validarForm(this.parentNode)" required>
                <option value="" disabled selected>--Seleccione--</option>
                <?php foreach($municipios as $town):?>
                <option value="<?php echo $town->cod_municipio  ?>"><?php echo $town->cod_municipio ." - ". $town->nombre?></option>
                <?php endforeach;?>
            </select>
            <label for="estado">Estado <span style="color: red">*</span></label>
            <select name="estado" id="estado" onchange="validarForm(this.parentNode)" required>
                <option value="" disabled selected>--Seleccione--</option>
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
            </select>
            <label for="estado">Personas asignadas <span style="color: red">*</span></label>
            <div style="margin-bottom: 15px">
                <select class="category related-post form-control" name="personas[]" id="personas" multiple onchange="validarForm(this.parentNode)" >
                     <?php foreach($personas as $persona):?>
                        <option value="<?php echo $persona->cedula ?>"><?php echo $persona->cedula ." - ". $persona->primer_nombre . " ". $persona->primer_apellido ?></option>
                    <?php endforeach;?>
                </select>
            </div>
            <input type="submit" value="REGISTRAR" name="Registrar" class="btn-sesion desabilitarItem" id="submit">
        </form>
    </div>


    <footer id="footer">
        <div class="center">
            <p>&copy; HASSOFT TODOS LOS DERECHOS RESERVADOS</p>
        </div>

    </footer>
        
    <script src="validacion/validacion.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.category').select2();
        });
    </script>
</body>

</html>