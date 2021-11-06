<?php
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
    $descripcion = $_POST['descripcion'];
    $estado = $_POST['estado'];

    if(!empty($descripcion)){
        $descripcion = trim($descripcion);
        $descripcion = filter_var($descripcion, FILTER_SANITIZE_STRING);
    }else{
        $errores .= "DEBE DILIGENCIAR LA DESCRIPCION";
    }
    if($estado == ""){
        $errores .= "DEBE SELECCIONAR EL ESTADO";
    }

    if(!$errores){
        require_once 'control/controlPerfil.php';
        $controlPerfil = new ControlPerfil();
        $perfil = new Perfil($descripcion, $estado);
        $controlPerfil->registrarPerfil($perfil);
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
                <li><a href="consultaPerfil.php">Consulta Perfiles</a></li>
            </ul>
        </nav>
    </div>
    <div class="clearfix"></div>
    <p style="float: right; margin-right: 10px">Los campos con (<span style="color: red">*</span>) son obligatorios</p>
    <div class="bloque">
        <form action="" method="post" class="form">
            <h3><a href=""><i class="fas fa-users"></i></a>PERFIL</h3>
            <label for="descripcion">Descripción <span style="color: red">*</span></label>
            <input type="text" name="descripcion" id="descripcion" placeholder="Descripción" onkeyup="validacionRequire(this)" required>
            <label for="estado">Estado <span style="color: red">*</span></label>
            <select name="estado" id="estado" onchange="validarForm(this.parentNode)" required>
                <option value="" disabled selected>--Seleccione--</option>
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
            </select>
            <input type="submit" value="REGISTRAR" name="Registrar" class="btn-sesion desabilitarItem" id="submit">
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