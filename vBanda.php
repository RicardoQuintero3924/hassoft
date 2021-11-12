<?php
require_once 'control/controlBanda.php';
require_once 'control/controlFinca.php';
session_start();
$varsesion = $_SESSION['usuario'];
error_reporting(1);
if ($varsesion == null || $varsesion == '') {
    echo '<script type="text/javascript"> alert("USTED NO TIENE AUTORIZACIÓN")</script>';
    die();
    header('location:index.php');
}
$controlBanda = new ControlBanda();
$controlFinca = new ControlFinca();
$fincas = $controlFinca->consultaFinca();
$uBanda = $controlBanda->consultaUltimoRegistro();

$errores = "";
if(isset($_POST['Registrar'])){
 $codBanda = $_POST['banda'];
 $descripcion = $_POST['descripcion'];
 $estado = 1;
 $finca = $_POST['finca'];

 if(!empty($codBanda)){
     $codBanda = trim($codBanda);
     $codBanda = filter_var($codBanda, FILTER_SANITIZE_NUMBER_INT);
 }else{
     $errores .= "DEBE DILIGENCIAR EL CODIGO";
 }
 if(!empty($descripcion)){
     $descripcion = trim($descripcion);
     $descripcion = filter_var($descripcion, FILTER_SANITIZE_STRING);
 }else{
     $errores .= "DEBE DILIGENCIAR LA DESCRIPCION";
 }

 if(!$errores){
     require_once 'modelo/banda.php';
     $banda = new Banda($codBanda, $descripcion, $estado,$finca);
     $controlBanda->agregarBanda($banda);
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
                <li><a href="finca.php">Finca</a></li>
                <li><a href="vRecoleccion.php">Recolección</a></li>
                <li><a href="consultaBanda.php">Consulta Banda</a></li>
                <li><a href="perfil.php">Perfiles</a></li>
            </ul>
        </nav>
    </div>
    <div class="clearfix"></div>
    <p style="float: right; margin-right: 10px">Los campos con (<span style="color: red">*</span>) son obligatorios</p>
    <div class="bloque">
        <form action="" method="post" class="form">
            <h3><a href=""><i class="fas fa-tree"></i></a>Banda</h3>
            <label for="banda">Codigo Banda<span style="color: red">*</span></label>
            <?php foreach($uBanda as $ban) : 
                  $cUlt = $ban->cod_finca; 
                  $ultimo = $cUlt + 1;?>
            <input type="text" value="" name="banda" id="banda" placeholder="proximo codigo 00<?=$ultimo?>" onkeyup="validacionRequire(this)" required>
            <?php endforeach; ?>
            <label for="descripcion">Descripción <span style="color: red">*</span></label>
            <input type="text" name="descripcion" id="descripcion" placeholder="Descripción" onkeyup="validacionRequire(this)" required>
            <label for="finca">Finca</label>
            <select name="finca" id="finca">
                <option value="" disabled selected>--Seleccione--</option>
                <?php foreach ($fincas as $finca) : ?>
                    <option value="<?= $finca->cod_finca ?>"><?= $finca->cod_finca . "-" . $finca->nombre  ?></option>
                <?php endforeach; ?>
            </select>
            <input type="submit" value="Registrar" name="Registrar" class="btn-sesion desabilitarItem" id="submit">
    </div>

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