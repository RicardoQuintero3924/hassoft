<?php
session_start();
$varsesion = $_SESSION['usuario'];
error_reporting(0);
if ($varsesion == null || $varsesion == '') {
    echo '<script type="text/javascript"> alert("USTED NO TIENE AUTORIZACION")</script>';
    die();
    header('location:index.php');
}
require_once 'control/controlPersona.php';
require_once 'control/controlFinca.php';
$controlFinca = new ControlFinca();
$controlPersona = new controlPersona();
$id = $_GET['cedula'];
$persona = $controlPersona->consultaPersonaPorId($id);
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
                <li><a href="Consultapersona.php">Consulta Persona</a></li>
                <li><a href="categoria.php">Categoria</a></li>
                <li><a href="finca.php">Finca</a></li>
                <li><a href="perfil.php">Perfiles</a></li>
            </ul>
        </nav>
    </div>
    <div class="clearfix"></div>
    <div class="bloque">
        <?php foreach($persona as $person) :
             $id = $person->cod_finca;
             $finca = $controlFinca->consultaFincaPorId($id);?>
        <form action="" method="post" class="form">
            <h3><a href=""><i class="far fa-user"></i></a>Modificar Persona</h3>
            <label for="cedula">cedula</label>
            <input type="number" name="cedula" value="<?= $person->cedula ?>" id="cedula" placeholder="cedula">
            <label for="pnombre">Primer Nombre</label>
            <input type="text" name="pnombre" value="<?= $person->primer_nombre?>" id="pnombre" placeholder="Primer Nombre">
            <label for="snombre">Segundo Nombre</label>
            <input type="text" name="snombre" value="<?= $person->segundo_nombre?>" id="snombre" placeholder="Segundo Nombre">
            <label for="papellido">Primer Apellido</label>
            <input type="text" name="papellido" value="<?= $person->primer_apellido?>" id="papellido" placeholder="Primer Apellido">
            <label for="sapellido">Segundo Apellido</label>
            <input type="text" name="sapellido"  value="<?= $person->segundo_apellido?>" id="sapellido" placeholder="Segundo Apellido">
            <label for="celular">Celular</label>
            <input type="number" name="celular" value="<?= $person->celular?>" id="celular" placeholder="Celular">
            <label for="correo">Correo</label>
            <input type="email" name="correo" value="<?= $person->correo?>" id="correo" placeholder="Correo">
            <label for="finca">Finca</label>
            <select name="finca" id="finca">
                <?php foreach($finca as $fin):?>
                <option value="<?= $fin->cod_finca ?>" selected><?php echo $fin->cod_finca." - ". $fin->nombre ?></option>
                <?php endforeach; ?>
            </select>
            <label for="perfil">Perfil</label>
            <select name="perfil" id="perfil">
                <option value="" disabled selected>--Selecione--</option>
                <option value="<?php echo $perfil->cod_perfil ?>" selected><?= $person->cod_perfil ?></option>
            </select>
            <label for="estado">Estado</label>
            <select name="estado" id="estado">
                <option value="" disabled selected>--Seleccione--</option>
                <option value="<?=$person->estado?>" selected>Activo</option>
                <option value="<?=$person->estado?>" selected>Inactivo</option>
            </select>
            <?php endforeach; ?>
            <input type="submit" value="MODIFICAR" name="Modificar" class="btn-sesion">
        </form>
    </div>


    <footer id="footer">
        <div class="center">
            <p>&copy; HASSOFT TODOS LOS DERECHOS RESERVADOS</p>
        </div>

    </footer>
</body>

</html>