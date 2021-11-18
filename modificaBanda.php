<?php  
require_once 'control/controlFinca.php';
$codBanda = $_GET['codBanda'];
session_start();
$varsesion = $_SESSION['usuario'];
error_reporting(1);
if($varsesion == null || $varsesion == ''){
    echo '<script type="text/javascript"> alert("USTED NO TIENE AUTORIZACIÓN")</script>';
    die();
    header('location:index.php');
}
require_once  'control/controlBanda.php';
$controlBanda = new ControlBanda();
$banda = $controlBanda->consultaBandasPorId($codBanda);
$controlFinca = new ControlFinca();

$errores = "";
if(isset($_POST['Modificar'])){
 $codBanda = $_POST['banda'];
 $descripcion = $_POST['descripcion'];
 $estado = $_POST['estado'];
 $finca = $_POST['finca'];

 if(!empty($codBanda)){
     $codBanda = trim($codBanda);
     $codBanda = filter_var($codBanda, FILTER_SANITIZE_NUMBER_INT);
 }else{
     $errores .= "DEBE DILIGENCIAR EL CÓDIGO";
 }
 if(!empty($descripcion)){
     $descripcion = trim($descripcion);
     $descripcion = filter_var($descripcion, FILTER_SANITIZE_STRING);
 }else{
     $errores .= "DEBE DILIGENCIAR LA DESCRIPCIÓN";
 }

 if(!$errores){
     require_once 'modelo/banda.php';
     $banda = new Banda($codBanda, $descripcion, $estado, $finca);
     $controlBanda->actualizaBanda($banda);
     echo '<script type="text/javascript"> alert("REGISTRO ALMACENADO CON ÉXITO")</script>';
     header('location:consultaBanda.php');
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
                <li><a href="consultaBanda.php">Consulta Banda</a></li>
                <li><a href="perfil.php">Perfiles</a></li>
            </ul>
        </nav>
    </div>
    <div class="clearfix"></div>
    <p style="float: right; margin-right: 10px">Los campos con (<span style="color: red">*</span>) son obligatorios</p>
    <div class="bloque">
        <?php foreach($banda as $ban): ?>
        <form action="" method="post" class="form" id="form">
            <h3><a href=""><i class="fas fa-tree"></i></a>Banda</h3>
            <label for="banda">Código Banda<span style="color: red">*</span></label>
            <input type="text" value="<?= $ban->cod_banda ?>" name="banda" id="banda" placeholder="proximo codigo 00<?=$ultimo?>" onkeyup="validacionRequire(this)" required>
            <label for="descripcion">Descripción <span style="color: red">*</span></label>
            <input type="text" name="descripcion" value="<?= $ban->descripcion ?>" id="descripcion" placeholder="Descripción" onkeyup="validacionRequire(this)" required>
            <label for="finca">Finca</label>
            <select name="finca" id="finca">
                <option value="" disabled selected>--Seleccione--</option>
                <?php $id = $ban->cod_finca;
                      $fincas = $controlFinca->consultaFincaPorId($id); 
                     foreach ($fincas as $finca) : ?>
                    <option value="<?= $finca->cod_finca ?>" selected><?= $finca->cod_finca . "-" . $finca->nombre  ?></option>
                <?php endforeach; ?>
            </select>
            <label for="estado">Estado <span style="color: red">*</span></label>
            <select name="estado" id="estado" onchange="validarForm(this.parentNode)" required>
                <option value="" disabled selected>--Seleccione--</option>
                <?php $state = $ban->estado;
                    if($state === '1'){?>
                <option value="<?=$ban->estado ?>" selected>Activo</option>
                <option value="0">Inactivo</option>
                <?php } 
                if($state === '0'){?>
                <option value="1">Activo</option>
                <option value="<?=$ban->estado ?>" selected>Inactivo</option>
                <?php } ?>
            </select>
        <?php endforeach; ?>
            <input type="submit" value="Modificar" name="Modificar" class="btn-sesion" id="submit">
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
        validarForm(document.getElementById("form"));
    </script>
</body>

</html>