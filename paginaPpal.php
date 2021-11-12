<?php
session_start();
$varsesion = $_SESSION['usuario'];
error_reporting(1);
if($varsesion == null || $varsesion == ''){
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
    <script type="text/javascript">
        window.addEventListener("load", function(event) {
            var template = document.getElementById("article-template");

            var articles = document.getElementById("articles");
            for (var i = 1; i <= 5; i++) {
                var clonado = template.cloneNode(true);
                clonado.removeAttribute("id");
                var h2 = clonado.getElementsByTagName("h2")[0];
                h2.innerHTML = h2.textContent + " " + i;
                articles.appendChild(clonado);
            }
        });
    </script>
</head>

<body>
    <header id="header">
        <div class="sesion">
            <h3>Usuario: <?= $varsesion?></h3>
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
                    <li><a href="vRecoleccion.php">Recolección</a></li>
                    <li><a href="vBanda.php">Banda</a></li>
                    <li><a href="perfil.php">Perfiles</a></li>
                </ul>
            </nav>
    </div>
    <div class="center">
        <section id="content">
            <h2 class="subheader">Últimas Cosechas</h2>
            <!-- listado articulos -->
            <div id="articles">
                <article class="article-item" id="article-template">
                    <div class="image-wrap">
                        <img src="https://unhabitatmejor.leroymerlin.es/sites/default/files/styles/header_category/public/2018-10/4%20paisaje%20macedonia.jpg?itok=AELknmF8" alt="Paisaje">
                    </div>
                    <h2>Cosecha</h2>
                    <span class="date">
                        hace 5 minutos
                    </span>
                    <a href="#">Leer Más</a>
                    <div class="clearfix"></div>
                </article>
            </div>
        </section>

        <aside id="sidebar">
            <div id="nav-blog" class="sidebar-item">
                <h3>Puedes hacer esto</h3>
                <a href="#" class="btn btn-success">Crear Artículo</a>
            </div>
            <div id="search" class="sidebar-item">
                <h3>Buscador.</h3>
                <p>Encuentra el artículo que buscas</p>
                <form action="">
                    <input type="text" name="search">
                    <input type="submit" name="submit" value="buscar" class="btn">
                </form>
            </div>
        </aside>

        <div class="clearfix"></div>
    </div>
    <footer id="footer">
        <div class="center">
            <p>&copy; HASSOFT TODOS LOS DERECHOS RESERVADOS</p>
        </div>

    </footer>
</body>

</html>