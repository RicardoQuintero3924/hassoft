<?php  
require_once 'control/controlPerfil.php';
$cPerfil = $_GET['perfil'];
$controlPerfil = new ControlPerfil();
$perfiles = $controlPerfil->consultaPerfilesPorId($cPerfil);
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
    $descripcion = $_POST['descripcion'];
    $estado = $_POST['estado'];

    if(!empty($descripcion)){
        $descripcion = trim($descripcion);
        $descripcion = filter_var($descripcion, FILTER_SANITIZE_STRING);
    }else{
        $errores .= "Debe Ingresar el nombre"; 
    }

    if(!$errores){
        require_once 'control/controlPerfilA.php';
        require_once 'modelo/aperfil.php';
        $controlPerfilA = new ControlPerfilA();
        $perfil = new ActualizaPerfil($cPerfil, $descripcion, $estado);
        $controlPerfilA->actualizarPerfil($perfil);
        echo '<script type="text/javascript"> alert("REGISTRO MODIFICADO CON ÉXITO")</script>';
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
            <h3>Usuario: <?php echo $varsesion ?></h3>
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
                <li><a href="vBanda.php">Banda</a></li>
                <li><a href="consultaPerfil.php">Consulta Perfiles</a></li>
            </ul>
        </nav>
    </div>
    <div class="clearfix"></div>
    <p style="float: right; margin-right: 10px">Los campos con (<span style="color: red">*</span>) son obligatorios</p>
    <div class="bloque">
       
        <form action="" method="post" class="form" id="form">
            <h3><a href=""><i class="fas fa-users"></i></a>PERFIL</h3>
        <?php foreach($perfiles as $perf): ?>
            <label for="descripcion">Descripción <span style="color: red">*</span></label>
            <input type="text" name="descripcion"  value="<?=$perf->descripcion?>" id="descripcion" placeholder="Descripción" onkeyup="validacionRequire(this)" required>
            <label for="estado">Estado <span style="color: red">*</span></label>
            <select name="estado" id="estado" onchange="validarForm(this.parentNode)" required>
                <option value="" disabled selected>--Seleccione--</option>
                <?php $state = $perf->estado;
                    if($state === '1'){?>
                <option value="<?=$perf->estado ?>" selected>Activo</option>
                <option value="0">Inactivo</option>
                <?php } 
                if($state === '0'){?>
                <option value="1">Activo</option>
                <option value="<?=$perf->estado ?>" selected>Inactivo</option>
                <?php } ?>
            </select>
        
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
    <script>
        validarForm(document.getElementById("form"));
    </script>
</body>

</html>