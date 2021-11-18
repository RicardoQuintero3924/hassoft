<?php
require_once 'control/controlPersona.php';
require_once 'control/controlFinca.php';
require_once 'control/controlUsuario.php';
require_once 'modelo/persona.php';
$controlPersona = new controlPersona();
$controlFinca = new ControlFinca();
$personas = $controlPersona->consultaPersona();
session_start();
$varsesion = $_SESSION['usuario'];

if ($varsesion == null || $varsesion == '') {
    echo '<script type="text/javascript"> alert("USTED NO TIENE AUTORIZACIÓN")</script>';
    die();
    header('location:index.php');
}

function eliminarPersona($cedula) {
    $controlPersona = new controlPersona();
    $controlUsuario = new ControlUsuario();
    $controlPersona->eliminarPersona($cedula);
    $controlUsuario->actualizarEstado(0, $cedula);
}

if (isset($_GET['cedulaEliminar'])) {
    eliminarPersona($_GET['cedulaEliminar']);
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

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
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
            <h2 id="titulo">Consulta Personas</h2>
            <tr class="celdas">
                <th>Cédula</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Celular</th>
                <th>Correo</th>
                <th>Estado</th>
                <th></th>
                <!-- <th></th> -->
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
                    <!-- <td data-toggle="modal" data-target="#exampleModal">Eliminar</td> -->
                </tr>

                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Eliminar</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                ¿Estás seguro que desea eliminar esta persona?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" style="font-weight: bold" onclick="">
                                    <a href="Consultapersona.php?cedulaEliminar=<?php echo $persona->cedula ?>">Aceptar</a>
                                </button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </table>
    </div>
    <div class="clearfix"></div>


    <footer id="footer">
        <div class="center">
            <p>&copy; HASSOFT TODOS LOS DERECHOS RESERVADOS</p>
        </div>

    </footer>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

</html>