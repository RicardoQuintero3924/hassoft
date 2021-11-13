<?php
$codCategoria = $_GET['categoria'];
require_once 'control/controlCategoria.php';
$controlCategoria = new ControlCategoria();
$categoria = $controlCategoria->consultaCategoriaPorId($codCategoria);
session_start();
$varsesion = $_SESSION['usuario'];
// error_reporting(0);
if ($varsesion == null || $varsesion == '') {
    echo '<script type="text/javascript"> alert("USTED NO TIENE AUTORIZACIÓN")</script>';
    die();
    header('location:index.php');
}
$errores = '';
if(isset($_POST['Modificar'])){
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $pinicial = $_POST['inicial'];
    $pfinal = $_POST['final'];
    $estado = $_POST['estado'];
    $codCategoria = $_GET['categoria'];

    if(!empty($nombre)){
        $nombre = trim($nombre);
        $nombre = filter_var($nombre, FILTER_SANITIZE_STRING);
    }else{
        $errores .= "DEBE INGRESAR EL NOMBRE";
    }
    if(!empty($descripcion)){
        $descripcion = trim($descripcion);
        $descripcion = filter_var($descripcion, FILTER_SANITIZE_STRING);
    }else{
        $errores .= "DEBE INGRESAR LA DESCRIPCIÓN";
    }
    if(!empty($pinicial)){
        $pinicial = trim($pinicial);
        $pinicial = filter_var($pinicial, FILTER_SANITIZE_NUMBER_FLOAT);
    }else{
        $errores .= "DEBE INGRESAR EL PESO INICIAL";
    }
    if(!empty($pfinal)){
        $pfinal = trim($pfinal);
        $pfinal = filter_var($pfinal, FILTER_SANITIZE_NUMBER_FLOAT);
    }else{
        $errores .= "DEBE INGRESAR EL PESO FINAL";
    }
    if($estado == ""){
        $errores .= "DEBE SELECCIONAR EL ESTADO";
    }

    if(!$errores){
        require_once 'control/controlCategoriaA.php';
        $categoria = new CategoriaA($codCategoria, $nombre, $pinicial, $pfinal, $descripcion, $estado );
        $controlCategoria = new ControlCategoriaA();
        $controlCategoria->actualizaCategoria($categoria);
        echo '<script type="text/javascript"> alert("REGISTRO MODIFICADO CON ÉXITO")</script>';
        // header('location:consultaCategoria.php');
    }else{
        echo '<script type="text/javascript"> alert("POR FAVOR DILIGENCIAR TODOS LOS CAMPOS ")</script>' ."$errores";
    }
    var_dump($codCategoria);
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
                <img src="images/Hassoft.PNG" class="app-logo" alt="logotipo">
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
                <li><a href="consultaCategoria.php">Consulta Categorías</a></li>
                <li><a href="finca.php">Finca</a></li>
                <li><a href="">Recolección</a></li>
                <li><a href="vBanda.php">Banda</a></li>
                <li><a href="perfil.php">Perfiles</a></li>
            </ul>
        </nav>
    </div>
    <div class="clearfix"></div>
    <div class="bloque">
        <?php foreach($categoria as $cate): ?>
        <form action="" method="post" id="form" class="form">
            <h3><a href=""><i class="far fa-id-card"></i></a>CATEGORÍA</h3>
            <label for="nombre">Nombre <span style="color: red">*</span></label>
            <input type="text" name="nombre" value="<?= $cate->nombre ?>" id="nombre" placeholder="Nombre" onkeyup="validacionRequire(this)" required>
            <label for="descripcion">Descripción <span style="color: red">*</span></label onkeyup="validacionRequire(this)" required>
            <input type="text" name="descripcion" value="<?= $cate->descripcion ?>" id="descripcion" placeholder="Descripción">
            <label for="inicial">Peso Inicial <span style="color: red">*</span></label>
            <input type="number" name="inicial" id="inicial" value="<?= $cate->peso_inicial ?>" placeholder="Peso Inicial" onkeyup="validacionCatargoria(document.getElementById('final'), this, this)" required>
            <label for="final">Peso Final <span style="color: red">*</span></label>
            <input type="number" name="final" id="final" value="<?= $cate->peso_final ?>" placeholder="Peso Final" onkeyup="validacionCatargoria(this, document.getElementById('inicial'), this)" required>
            <label for="estado">Estado <span style="color: red">*</span></label>
            <select name="estado" id="estado" onchange="validarForm(this.parentNode)" required>
                <option value="" disabled selected>--Seleccione--</option>
                <?php $estadoA = $cate->estado;
                if($estadoA == '1'){?>
                <option value="1" selected><?= $cate->estado." "."Activo" ?></option>
                <option value="0" >Inactivo </option>
                <?php }else if($estadoA == '0'){ ?>
                <option value="0" selected><?= $cate->estado." "."Inactivo"?></option>
                <option value="1" >Activo</option>  
                <?php }?>
            </select>
        <?php endforeach;?>
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