<?php
require_once 'control/controlFinca.php';
require_once 'control/controlMunicipio.php';
$controlMunicipio = new ControlMunicipio();
$controlFinca = new ControlFinca();
$estado = 1;
$fincas = $controlFinca->consultaFincaPorEstado($estado);
session_start();
$varsesion = $_SESSION['usuario'];
//error_reporting(0);
if ($varsesion == null || $varsesion == '') {
    echo '<script type="text/javascript"> alert("USTED NO TIENE AUTORIZACIÓN")</script>';
    die();
    header('location:index.php');
}

if (isset($_POST['buscarInactivos'])) {
    $estado = 0;
    $fincas = $controlFinca->consultaFincaPorEstado($estado);
}

if (isset($_POST['buscarActivos'])) {
    $estado = 1;
    $fincas = $controlFinca->consultaFincaPorEstado($estado);
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
                <li><a href="perfil.php">Perfiles</a></li>
            </ul>
        </nav>
    </div>
    <div class="separacion">
        <table class="tabla">
        <div class="clearfix"></div>
            <div style="position: relative;">
                <h2 style="display: inline-block" id="titulo">Consulta Categorías</h2>
                <div style="position: absolute; top: -30px; right: 130px;">
                    <form class="form-inline my-2 my-lg-0" id="form" method="POST" style="text-align: right; margin-bottom: 40px !important; margin-top: 25px !important;">
                        <?php echo $estado == 0 ? '<input type="submit" name="buscarActivos" value="Ver activos" class="btn btn-success" style="max-width: 100%" />' : '<input type="submit" name="buscarInactivos" value="Ver inactivos" class="btn btn-success" style="max-width: 100%" />' ?>
                    </form>
                </div>
            </div>
            <tr class="celdas">
                <th>Código</th>
                <th>Nombres</th>
                <th>Dirección</th>
                <th>Teléfono</th>
                <th>Correo</th>
                <th>Número Hectáreas</th>
                <th>Municipio</th>
                <th>Estado</th>
                <th>Modificar</th>
            </tr>

            <?php foreach ($fincas as $finca) :
                $id = $finca->cod_finca;
                $municipios = $controlMunicipio->consultaMunicipioPorId($id);?>
                <tr class="filas">
                    <td><?= $finca->cod_finca ?></td>
                    <td><?= $finca->nombre ?></td>
                    <td><?= $finca->direccion ?></td>
                    <td><?= $finca->telefono?></td>
                    <td><?= $finca->correo?></td>
                    <td><?= $finca->nro_hectareas_cultivadas?></td>
                    <td><?= $controlMunicipio->consultaMunicipioPorId2($finca->cod_municipio)->nombre ?></td>
                    <td><?= $finca->estado ? 'ACTIVO' : 'INACTIVO' ?></td>
                    <td><a href="modificaFinca.php?codFinca=<?= $finca->cod_finca ?>" class="btn-table">Modificar</a></td>
                </tr>
            <?php endforeach; ?>

        </table>
    </div>
    <div class="clearfix"></div>


    <footer id="footer">
        <div class="center">
            <p>&copy; HASSOFT TODOS LOS DERECHOS RESERVADOS</p>
        </div>

    </footer>
</body>

</html>