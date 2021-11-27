<?php  
require_once 'control/controlClasificacion.php';
$cod_clasificacion = $_GET['cod_clasificacion'];
$controlClasificacion = new ControlClasificacion();
$categorias = $controlClasificacion->consultaCategoriaPorClasificacion($cod_clasificacion);
$clasificacion = $controlClasificacion->consultaClasificacionPorId($cod_clasificacion);
session_start();
$varsesion = $_SESSION['usuario'];
//error_reporting(0);
if ($varsesion == null || $varsesion == '') {
    echo '<script type="text/javascript"> alert("USTED NO TIENE AUTORIZACIÓN")</script>';
    die();
    header('location:index.php');
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
    <!-- <p style="float: right; margin-right: 10px">Los campos con (<span style="color: red">*</span>) son obligatorios</p> -->
    <div class="bloque">
       
        <form action="" method="post" class="form" id="form">
            <h3><a href=""><i class="fas fa-users"></i></a>Clasificacion</h3>
            <label for="descripcion">Número de aguacates</label>
            <input type="text" value="<?=$clasificacion->nro_aguacates?> aguacates" id="descripcion" placeholder="Número de aguacates" disabled>
            <label for="descripcion">Peso total</label>
            <input type="text" value="<?=$clasificacion->peso_total?>" id="descripcion" placeholder="Peso total" disabled>
            <label for="descripcion">Fecha inicial</label>
            <input type="text" value="<?=$clasificacion->fecha_inicial?>" id="descripcion" placeholder="Fecha inicial" disabled>
            <label for="descripcion">Fecha final</label>
            <input type="text" value="<?=$clasificacion->fecha_final?>" id="descripcion" placeholder="Fecha final" disabled>
            <?php foreach ($categorias as $key=>$categoria) :?>
                <div id="articles">
                <label for="descripcion"><?=$categoria->nombre?></label>
                <input type="text" name="nro"  value="<?=$categoria->contador?> aguacates" id="nro" placeholder="Descripción" disabled>
                </div>    
            <?php endforeach; ?>
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