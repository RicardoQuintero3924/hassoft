<?php 
require_once 'control/controlBanda.php';
require_once 'control/controlFinca.php';
require_once 'control/controlClasificacion.php';
session_start();
$varsesion = $_SESSION['usuario'];
error_reporting(0);
if ($varsesion == null || $varsesion == '') {
    echo '<script type="text/javascript"> alert("USTED NO TIENE AUTORIZACIÓN")</script>';
    die();
    header('location:index.php');
}
$controlFinca = new ControlFinca();
$controlBanda = new ControlBanda();
$estado = 1;
$bandas = $controlBanda->consultaBandasPorEstado($estado);

setlocale(LC_ALL, 'es_ES');
date_default_timezone_set('America/Bogota');

if (isset($_POST['buscarInactivos'])) {
    $estado = 0;
    $bandas = $controlBanda->consultaBandasPorEstado($estado);
}

if (isset($_POST['buscarActivos'])) {
    $estado = 1;
    $bandas = $controlBanda->consultaBandasPorEstado($estado);
}

if (isset($_POST['crearCategoria'])) {
    require_once 'control/controlClasificacion.php';
    require_once 'modelo/Clasificacion.php';
    $controlClasificacion = new ControlClasificacion();
    
    require_once 'control/controlBandaReco.php';
    require_once 'modelo/BandaReco.php';
    $controlBandaReco = new ControlBandaReco();

    $clasificacion = new Clasificaion(id: null, nroAguacates: $_POST['total'], pesoTotal: $_POST['pesoTotal'], fechaInicial: $_POST['fechaInicial'], fechaFinal: date("F j, Y, g:i a"), estado: 1, banda: $_POST['codigo'] );
    $controlClasificacion->registroClasificacion($clasificacion);
    
    $bandaReco = new BandaReco(codBanda: $_POST['codigo'], codClasificacion: null, contador: $_POST['catA'], codCate: 1);
    $controlBandaReco->registroClasificacion($bandaReco);
    $bandaReco = new BandaReco(codBanda: $_POST['codigo'], codClasificacion: null, contador: $_POST['catB'], codCate: 2);
    $controlBandaReco->registroClasificacion($bandaReco);
    $bandaReco = new BandaReco(codBanda: $_POST['codigo'], codClasificacion: null, contador: $_POST['catC'], codCate: 3);
    $controlBandaReco->registroClasificacion($bandaReco);
    $bandaReco = new BandaReco(codBanda: $_POST['codigo'], codClasificacion: null, contador: $_POST['catD'], codCate: 4);
    $controlBandaReco->registroClasificacion($bandaReco);
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
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
    <div class="clearfix"></div>
    <div class="separacion">
        <table class="tabla">
            <div style="position: relative; text-align: center;">
                <h2 style="display: inline-block" id="titulo">Consultar bandas</h2>
                <div style="position: absolute; top: -15px; right: 130px;">
                    <form class="form-inline my-2 my-lg-0" id="form" method="POST" style="text-align: right; margin-top: 25px !important;">
                        <?php echo $estado == 0 ? '<input type="submit" name="buscarActivos" value="Ver activos" class="btn btn-success" style="max-width: 100%" />' : '<input type="submit" name="buscarInactivos" value="Ver inactivos" class="btn btn-success" style="max-width: 100%" />' ?>
                    </form>
                </div>
            </div>
            <tr class="celdas">
                <th>Código Banda</th>
                <th>Descripción</th>
                <th>Finca</th>
                <th>Estado</th>
                <th>Modificar</th>
                <?php  echo $estado > 0 ? "<th>Encender</th>" : null?>
            </tr>

            <?php foreach ($bandas as $banda) :
                $id = $banda->cod_finca;
                $fincas = $controlFinca->consultaFincaPorId($id)?>
                <tr class="filas">
                    <td><?= $banda->cod_banda ?></td>
                    <td><?= $banda->descripcion ?></td>
                    <?php foreach($fincas as $fin):?>
                    <td><?= $fin->nombre?></td>
                    <?php endforeach; ?>
                    <td><?= $banda->estado ? 'ACTIVO' : 'INACTIVO' ?></td>
                    <td><a href="modificaBanda.php?codBanda=<?= $banda->cod_banda ?>" class="btn-table">Modificar</a></td>
                    <td style="color: chartreuse" data-toggle="modal" data-target="#banda<?= $banda->cod_banda ?>"><?php echo $estado > 0 ? "<i class='fas fa-play' style='cursor: pointer'></i>" : null ?> </td>

                    <div class="modal fade" id="banda<?= $banda->cod_banda ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" style="max-width: 80%;" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle"><?= $banda->descripcion ?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body" id="modal-body">
                                    <div style="height: 160px;" id="imgSlider<?= $banda->cod_banda ?>"></div>
                                    <div class="box"></div>
                                    <form action="" method="post">
                                        <label for="catA">Id banda
                                            <input type="text" name="codigo" value="<?= $banda->cod_banda ?>">
                                        </label>
                                        <label for="catA">Categoría A
                                            <input type="text" name="catA" value="0" id="catA<?= $banda->cod_banda ?>">
                                        </label>
                                        <label for="catB">Categoría B
                                            <input type="text" value="0" name="catB" id="catB<?= $banda->cod_banda ?>">
                                        </label>
                                        <label for="catC">Categoría C
                                            <input type="text" value="0" name="catC" id="catC<?= $banda->cod_banda ?>">
                                        </label>
                                        <label for="catD">Categoría D
                                            <input type="text" value="0" name="catD" id="catD<?= $banda->cod_banda ?>">
                                        </label>
                                        <label for="total">Total
                                            <input type="text" value="0" name="total" id="total<?= $banda->cod_banda ?>">
                                        </label>
                                        <label for="total">Peso total
                                            <input type="text" value="0" name="pesoTotal" id="pTotal<?= $banda->cod_banda ?>">
                                        </label>
                                        <label for="total">Fecha inicial
                                            <input type="text" value="<?php echo date("F j, Y, g:i a") ?>" name="fechaInicial" id="fechaInicial<?= $banda->cod_banda ?>">
                                        </label>
                                        <br>
                                        <button type="button" onclick="crearAguacate(<?= $banda->cod_banda ?>)">Empezar</button>
                                        <input type="submit" name="crearCategoria" value="Parar">
                                    </form>
                                    
                                </div>
                                <div class="modal-footer">
                                    <!-- <button type="button" onclick="crearAguacate(<?= $banda->cod_banda ?>)">Empezar</button>
                                    <input type="submit" name="crearCategoria" value="Parar"> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </tr>
            <?php endforeach; ?>
            <!-- Button trigger modal -->
            
        </table>
    </div>
    <div class="clearfix"></div>

    <footer id="footer">
        <div class="center">
            <p>&copy; HASSOFT TODOS LOS DERECHOS RESERVADOS</p>
        </div>

    </footer>

    <script>
        var timeOut;

        function crearAguacate(id) {
            if (document.getElementById("sliderAguacate"+id)) {
                document.getElementById("imgSlider"+id).removeChild(document.getElementById("sliderAguacate"+id));
            }

            const numeroRandom = Math.floor(Math.random() * (480 - 80) + 80);
            let textCategoria = "";

            if (numeroRandom <= 120) {
                document.getElementById("catA"+id).value = Number(document.getElementById("catA"+id).value) + 1;
                textCategoria = "Categoría A";
            } else if (numeroRandom >= 121 && numeroRandom <= 180) {
                document.getElementById("catB"+id).value = Number(document.getElementById("catB"+id).value) + 1;
                textCategoria = "Categoría B";
            } else if (numeroRandom >= 181 && numeroRandom <= 240) {
                document.getElementById("catC"+id).value = Number(document.getElementById("catC"+id).value) + 1;
                textCategoria = "Categoría C";
            } else if (numeroRandom >= 241 && numeroRandom <= 480) {
                document.getElementById("catD"+id).value = Number(document.getElementById("catD"+id).value) + 1;
                textCategoria = "Categoría D";
            }

            const slide = document.createElement("div");
            slide.className = "slide-right";
            slide.id = "sliderAguacate"+id;


            const img = document.createElement("img");
            img.src = "images/Hassoft.PNG";
            img.style.width = "150px"

            const divText = document.createElement("div");
            divText.style.display = "inline-block";

            const pesoSpan = document.createElement("span");
            
            const peso = document.createTextNode("Peso: " + numeroRandom);

            const br = document.createElement("br");
            
            const categoriaSpan = document.createElement("span");
            
            const categoria = document.createTextNode(textCategoria);
            
            categoriaSpan.appendChild(categoria);
            pesoSpan.appendChild(peso);


            divText.appendChild(pesoSpan);
            divText.appendChild(br);
            divText.appendChild(categoriaSpan);
            slide.appendChild(img);
            slide.appendChild(divText);
        
            var currentDiv = document.getElementById("imgSlider"+id);
            document.getElementById("imgSlider"+id).appendChild(slide, currentDiv);

            console.log(numeroRandom);

            document.getElementById("total"+id).value = Number(document.getElementById("total"+id).value) + 1;
            document.getElementById("pTotal"+id).value = numeroRandom + Number(document.getElementById("pTotal"+id).value);
            // window.setInterval(crearAguacate, 5000, id);
            timeOut = setTimeout(() => {
                crearAguacate(id);
            }, 5000);
        }

        function stopTimeOut(){
            clearTimeout(timeOut);
        }

    </script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>