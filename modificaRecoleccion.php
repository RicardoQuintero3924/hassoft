<?php
require_once 'control/controlRecoleccion.php';
require_once 'control/controlFinca.php';
require_once 'control/controlCategoria.php';
$controlRecoleccion = new ControlRecoleecion();
$controlFinca = new ControlFinca();
$controlCategoria = new ControlCategoria();
$codRecoleccion = $_GET['codRecoleccion'];
$recoleccion = $controlRecoleccion->consultaRecoleccionPorId($codRecoleccion); 
session_start();
$varsesion = $_SESSION['usuario'];
//error_reporting(0);
if ($varsesion == null || $varsesion == '') {
    echo '<script type="text/javascript"> alert("USTED NO TIENE AUTORIZACIÓN")</script>';
    die();
    header('location:index.php');
}
$errores = "";
if(isset($_POST['Modificar'])){
    $codRecoleccion = $_POST['recoleccion'];
    $cantCosecha = $_POST['cantcosecha'];
    $fechai = $_POST['fechai'];
    $fechaf = $_POST['fechaf'];
    $cantRecolectada = $_POST['recolectada'];
    $observaciones = $_POST['observaciones'];
    $finca = $_POST['finca'];
    $estado = $_POST['estado'];
    $categoria = $_POST['categoria'];

    if(!empty($observaciones)){
        $observaciones = trim($observaciones);
        $observaciones = filter_var($observaciones, FILTER_SANITIZE_STRING);
    }else{
        $errores .= "DEBE TENER UNA OBSERVACION";
    }

    if(!$errores){
        require_once 'modelo/recoleccion.php';
        $recoleccion = new Recoleccion($codRecoleccion, $cantCosecha, $fechai, $fechaf, $cantRecolectada, $observaciones, $estado, $finca, $categoria);
        $controlRecoleccion->actualizaRecoleccion($recoleccion);
        echo '<script type="text/javascript"> alert("REGISTRO MODIFICADO CON ÉXITO")</script>';
    }else{
        echo '<script type="text/javascript"> alert("ERROR EN LA MODIFICACION")</script>';
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
                <li><a href="persona.php">Persona</a></li>
                <li><a href="categoria.php">Categoría</a></li>
                <li><a href="finca.php">Finca</a></li>
                <li><a href="consultaRecoleccion.php">Consulta recolección</a></li>
                <li><a href="vBanda.php">Banda</a></li>
                <li><a href="perfil.php">Perfiles</a></li>
            </ul>
        </nav>
    </div>
    <div class="clearfix"></div>
    <p style="float: right; margin-right: 10px">Los campos con (<span style="color: red">*</span>) son obligatorios</p>
    <div class="bloque">
        <form action="" method="post" class="form" id="form">
            <h3><a href=""><i class="far fa-user"></i></a>Recolección</h3>
            <?php foreach($recoleccion as $reco): ?>
            <label for="recoleccion">Codigo Recolección <span style="color: red">*</span></label>
           
            <input type="number" name="recoleccion"  value="<?= $reco->cod_recoleccion  ?>" id="recoleccion" placeholder="" onkeyup="validacionRequire(this)" required>
           
            <label for="cantcosecha">Cantidad Aguacates Cosecha <span style="color: red">*</span></label>
            <input type="number" name="cantcosecha" value="<?= $reco->cant_cosecha ?>" id="cantcosecha" placeholder="cantcosecha" onkeyup="validacionRequire(this)" required>
            <label for="fechai">Fecha Inicio<span style="color: red">*</span></label>
            <input type="date" name="fechai" value="<?= $reco->fecha_inicio ?>" id="fechai" placeholder="Fecha Inicial" onkeyup="validarForm(this.parentNode)">
            <label for="fechaf">Fecha Final <span style="color: red">*</span></label>
            <input type="date" name="fechaf" value="<?= $reco->fecha_final ?>" id="fechaf" placeholder="Fecha Final" onkeyup="validacionRequire(this)" required>
            <label for="recolectada">Cantidad Recolectada<span style="color: red">*</span></label>
            <input type="text" name="recolectada" value="<?= $reco->cantidad_recolectada ?>" id="recolectada" placeholder="recolectada" onkeyup="validarForm(this.parentNode)">
            <label for="observaciones">Observaciones <span style="color: red">*</span></label>
            <input type="textarea" name="observaciones"  value="<?= $reco->observaciones ?>" id="observaciones" placeholder="Observaciones" onkeyup="validaForm(this)" required>
            <label for="finca">Finca<span style="color: red">*</span></label>
            <select name="finca" id="finca">
            <?php $fincas = $controlFinca->consultaFincaPorId($reco->cod_finca);
                foreach($fincas as $finca): ?>
                <option value="<?= $finca->cod_finca ?>"><?= $finca->cod_finca."-".$finca->nombre ?></option>
            <?php endforeach;?>
            </select>
            <label for="categoria">Categoria <span style="color: red">*</span></label>
            <select name="categoria" id="categoria">
            <?php $categorias = $controlCategoria->consultaCategoriaPorId($reco->cod_clasificacion); 
            foreach($categorias as $categoria):?>
                <option value="<?= $categoria->cod_categoria ?>"><?= $categoria->cod_categoria."-".$categoria->nombre ?></option>
            <?php endforeach;?>    
            </select>
            <label for="estado">Estado <span style="color: red">*</span></label>
            <select name="estado" id="estado" onchange="validarForm(this.parentNode)" required>
                <option value="" disabled selected>--Seleccione--</option>
                <?php $estadoA = $reco->estado;
                if($estadoA == '1'){?>
                <option value="1" selected><?= $reco->estado." "."Activo" ?></option>
                <option value="0" >Inactivo </option>
                <?php }else if($estadoA == '0'){ ?>
                <option value="0" selected><?= $reco->estado." "."Inactivo"?></option>
                <option value="1" >Activo</option>  
                <?php }?>
            </select>
            <?php endforeach; ?>
            <input type="submit" value="Modificar" name="Modificar" class="btn-sesion " id="submit">
        </form>
    </div>


    <footer id="footer">
        <div class="center">
            <p>&copy; HASSOFT TODOS LOS DERECHOS RESERVADOS</p>
        </div>

    </footer>
        
    <script src="validacion/validacion.js"></script>

    <script>
        validarForm(document.getElementById("form"));
    </script>
</body>

</html>
