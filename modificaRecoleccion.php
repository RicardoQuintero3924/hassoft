<?php 
$codRecoleccion = $_GET['codRecoleccion'];
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
            <label for="recoleccion">Codigo Recolección <span style="color: red">*</span></label>
            <?php foreach($recolecciones as $recoleccion): 
                $cod = $recoleccion->cod_recoleccion;
                $codigo = $cod + 1;?>
            <input type="number" name="recoleccion" id="recoleccion" placeholder="00<?= $codigo ?>" onkeyup="validacionRequire(this)" required>
            <?php endforeach;?>
            <label for="cantcosecha">Cantidad Aguacates Cosecha <span style="color: red">*</span></label>
            <input type="number" name="cantcosecha" id="cantcosecha" placeholder="cantcosecha" onkeyup="validacionRequire(this)" required>
            <label for="fechai">Fecha Inicio<span style="color: red">*</span></label>
            <input type="date" name="fechai" id="fechai" placeholder="Fecha Inicial" onkeyup="validarForm(this.parentNode)">
            <label for="fechaf">Fecha Final <span style="color: red">*</span></label>
            <input type="date" name="fechaf" id="fechaf" placeholder="Fecha Final" onkeyup="validacionRequire(this)" required>
            <label for="recolectada">Cantidad Recolectada<span style="color: red">*</span></label>
            <input type="text" name="recolectada" id="recolectada" placeholder="recolectada" onkeyup="validarForm(this.parentNode)">
            <label for="observaciones">Observaciones <span style="color: red">*</span></label>
            <input type="textarea" name="observaciones" id="observaciones" placeholder="Observaciones" onkeyup="validaForm(this)" required>
            <label for="finca">Finca<span style="color: red">*</span></label>
            <select name="finca" id="finca">
            <?php foreach($fincas as $finca): ?>
                <option value="<?= $finca->cod_finca ?>"><?= $finca->cod_finca."-".$finca->nombre ?></option>
            <?php endforeach;?>
            </select>
            <label for="categoria">Categoria <span style="color: red">*</span></label>
            <select name="categoria" id="categoria">
            <?php foreach($categorias as $categoria):?>
                <option value="<?= $categoria->cod_categoria ?>"><?= $categoria->cod_categoria."-".$categoria->nombre ?></option>
            <?php endforeach;?>    
            </select>
            <input type="submit" value="REGISTRAR" name="Registrar" class="btn-sesion " id="submit">
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
