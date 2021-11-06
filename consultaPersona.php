<?php
require_once 'control/controlPersona.php';
require_once 'control/controlFinca.php';
$controlPersona = new controlPersona();
$personas = $controlPersona->consultaPersona();
$controlFinca = new ControlFinca();
session_start();
$varsesion = $_SESSION['usuario'];

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
                <li><a href="perfil.php">Perfiles</a></li>
            </ul>
        </nav>
    </div>
    <div class="clearfix"></div>
    <div class="separacion">
        <table class="tabla">
            <h2 id="titulo">Consulta Personas</h2>
            <tr class="celdas">
                <th>Cédula</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Celular</th>
                <th>Correo</th>
                <th>Estado</th>
                <th>Modificar</th>
            </tr>

            <?php foreach ($personas as $persona) : ?>
                <tr class="filas">
                    <td><?= $persona->cedula ?></td>
                    <td><?= $persona->primer_nombre . " " . $persona->segundo_nombre ?></td>
                    <td><?= $persona->primer_apellido . " " . $persona->segundo_apellido ?></td>
                    <td><?= $persona->celular ?></td>
                    <td><?= $persona->correo ?></td>
                    <td><?= $persona->estado ? 'ACTIVO' : 'INACTIVO' ?></td>
                    <td><a href="modificaPersona.php?cedula=<?php echo $persona->cedula ?>" class="btn-table">Modificar</a></td>
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