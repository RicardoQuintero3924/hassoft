<?php
require_once 'control/controlFinca.php';
require_once 'control/controlPersona.php';
require_once 'control/controlMunicipio.php';
require_once 'control/controlFincaPersona.php';
$codFinca = $_GET['codFinca'];
$controlFinca = new ControlFinca();
$controlFincaPersona = new ControlFincaPersona();
$finca = $controlFinca->consultaFincaPorId($codFinca);
 $controlPersona = new ControlPersona();
 $personas = $controlPersona->consultaPersona();
// $controlMunicipio = new ControlMunicipio();
// $municipios = $controlMunicipio->consultaMunicipio();
session_start();
$varsesion = $_SESSION['usuario'];
$personasSelecionadas = $controlFincaPersona->BuscarPersonasPorCodFinca($codFinca);
//error_reporting(0);
if ($varsesion == null || $varsesion == '') {
    echo '<script type="text/javascript"> alert("USTED NO TIENE AUTORIZACIÓN")</script>';
    die();
    header('location:index.php');
}
$errores = "";
if(isset($_POST['Modificar'])){
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $nHectareas = $_POST['hectareas'];
    $municipio = $_POST['municipio'];
    $estado = $_POST['estado'];
    $personas = $_POST['personas'];

    if(!empty($nombre)){
        $nombre = trim($nombre);
        $nombre = filter_var($nombre, FILTER_SANITIZE_STRING);
    }else{
        $errores .= "Debe Ingresar el Nombre";
    }

    if(!empty($direccion)){
        $direccion = trim($direccion);
        $direccion = filter_var($direccion, FILTER_SANITIZE_STRING);
    }else{
        $errores .= "Debe Ingresar la Dirección";
    }

    if(!empty($telefono)){
        $telefono = trim($telefono);
        $telefonp = filter_var($telefono, FILTER_SANITIZE_NUMBER_INT);
    }else{
        $errores -= "Debe Ingresar el Telefono";
    }

    if(!empty($nHectareas)){
        $nHectareas = trim($nHectareas);
        $nHectareas = filter_var($nHectareas, FILTER_SANITIZE_NUMBER_INT);
    }else{
        $errores .= "debe ingresar las hectareas";
    }
    
    if(!$errores){
        require_once 'control/controlFincaPersona.php';
        require_once  'control/controlBanda.php';
        $controlFincaPersona = new ControlFincaPersona();
        $controlBanda = new ControlBanda();
        $arrayPerosnasExistentes = $controlFincaPersona->BuscarPersonasPorCodFinca($codFinca);

        if ($estado <= 0 && count($controlBanda->consultaBandasPorId($codFinca)) > 0 ){
            echo "<script>
                    alert('Tiene bandas que depende de esta finca');
                    window.location.href='modificaFinca.php?codFinca=$codFinca';
                    </script>";
                    die();
        }

        foreach($personas as $per){
            if (array_search($per, $arrayPerosnasExistentes) === false) {
                $controlFincaPersona->AgregarFincaPersona($codFinca, $per);
            }
        }

        foreach($arrayPerosnasExistentes as $per){
            if (array_search($per, $personas) === false) {
                $controlFincaPersona->EliminarFincaPersona($codFinca, $per);
            }
        }

        $finca = new Finca($codFinca, $nombre, $direccion, $telefono, $correo, $nHectareas, $municipio, $estado);
        $actualiza = $controlFinca->actualizaFinca($finca);
        echo "<script>
            alert('REGISTRO MODIFICADO CON ÉXITO');
            window.location.href='consultaFinca.php';
            </script>";
    }else{
        echo '<script type="text/javascript"> alert("Error: Por favor intente nuevamente")</script>';
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
            
        <!-- Select 2 -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha256-aAr2Zpq8MZ+YA/D6JtRD3xtrwpEz2IqOS+pWD/7XKIw=" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha256-OFRAJNoaD8L3Br5lglV7VyLRf0itmoBzWUoM+Sji4/8=" crossorigin="anonymous"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
            
    </header>
    <div id="slider" class="slider-big">
        <!--Menu-->
        <nav id="menu">
            <ul>
                <li><a href="paginaPpal.php">Inicio</a></li>
                <li><a href="persona.php">Persona</a></li>
                <li><a href="categoria.php">Categoría</a></li>
                <li><a href="consultaFinca.php">Consulta Finca</a></li>
                <li><a href="vBanda.php">Banda</a></li>
                <li><a href="perfil.php">Perfiles</a></li>
            </ul>
        </nav>
    </div>
    <div class="clearfix"></div>
    <p style="float: right; margin-right: 10px">Los campos con (<span style="color: red">*</span>) son obligatorios</p>
    <div class="bloque">
        <form action="" id="form" method="post" class="form">
            <?php foreach($finca as $fin):  ?>
            <h3><a href=""><i class="fas fa-tree"></i></a>FINCA</h3>
            <label for="nombre">Nombre <span style="color: red">*</span></label>
            <input type="text" value="<?= $fin->nombre ?>" name="nombre" id="nombre" placeholder="Nombre" onkeyup="validacionRequire(this)" required>
            <label for="direccion">Dirección <span style="color: red">*</span></label>
            <input type="text" name="direccion" value="<?= $fin->direccion ?>" id="direccion" placeholder="Dirección" onkeyup="validacionRequire(this)" required>
            <label for="telefono">Teléfono fijo <span style="color: red">*</span></label>
            <input type="number" name="telefono" value="<?= $fin->telefono ?>" id="telefono" placeholder="Teléfono" onkeyup="validacionNumeroTelefono(this)" required>
            <label for="correo">Correo</label>
            <input type="email" name="correo" value="<?= $fin->correo ?>" id="correo" placeholder="Correo" onkeyup="validacionCorreo(this)">
            <label for="hectareas">Número Hectáreas <span style="color: red">*</span></label>
            <input type="number" name="hectareas" value="<?= $fin->nro_hectareas_cultivadas ?>" id="hectareas" placeholder="Número Hectáreas" onkeyup="validacionRequire(this)" required>
            <label for="municipio">Municipio <span style="color: red">*</span></label>
            <select name="municipio" id="municipio" onchange="validarForm(this.parentNode)" required>
                <option value="" disabled selected>--Seleccione--</option>
                <option value="<?= $fin->cod_municipio ?>" selected><?=$fin->cod_municipio?></option>
            </select>
            <label for="estado">Estado <span style="color: red">*</span></label>
            <select name="estado" id="estado" onchange="validarForm(this.parentNode)" required>
                <option value="" disabled selected>--Seleccione--</option>
                <?php $state = $fin->estado;
                    if($state == '1'){?>
                <option value="<?=$fin->estado ?>" selected>Activo</option>
                <option value="0">Inactivo</option>
                <?php } 
                if($state === '0'){?>
                <option value="1">Activo</option>
                <option value="<?=$fin->estado ?>" selected>Inactivo</option>
                <?php } ?>
            </select>
            <label for="estado">Personas asignadas <span style="color: red">*</span></label>
            <div style="margin-bottom: 15px">
                <select class="category related-post form-control" name="personas[]" id="personas" multiple onchange="validarForm(this.parentNode)" required>
                <?php foreach($personas as $persona):?>
                        <option <?php echo array_search($persona->cedula, $personasSelecionadas) !== false ? "selected" : null ?> value="<?php echo $persona->cedula ?>"><?php echo $persona->cedula ." - ". $persona->primer_nombre . " ". $persona->primer_apellido ?></option>
                <?php endforeach;?>  
                </select>
            </div>
            <?php endforeach; ?>
            <input type="submit" value="Modificar" name="Modificar" class="btn-sesion desabilitarItem" id="submit">
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
        validarForm(document.getElementById("form"));
    </script>
</body>

</html>