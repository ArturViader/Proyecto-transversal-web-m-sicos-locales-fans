<?php
session_start();
require_once 'bbdd.php';
require_once 'funciones.php';
?>
<html lang="es">
    <head>
        <title>OohMusic</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">
        <link rel="stylesheet" href="css/fontello.css">
        <link rel="stylesheet" href="css/estilosMusico.css">
    </head>
    <body>
        <header>
            <div class="contenedor">
                <h1 class="icon-music">Ooh Music</h1>
                <input type="checkbox" id="menu-bar">
                <label class="icon-menu" for="menu-bar"></label>
                <nav class="menu">
                    <ul>
                        <li><a href="index.php">Inicio</a></li>
                        <li><a href="login.php">Login</a></li>
                        <li class="submenu"><a href="">Registro <span class="icon-down-dir"></span></a>
                            <ul class="submenuu">
                                <li><a href="rmusicos.php">Regístrate como músico</a></li>
                                <li><a href="rlocales.php">Regístrate como local</a></li>
                                <li><a href="rfan.php">Regístrate como fan</a></li>
                            </ul>
                        </li>
                        <li><a href="musicos.php">Musicos</a></li>
                        <li><a href="locales.php">Locales</a></li>
                        <li><a href="fans.php">Fans</a></li>
                        <li><a href="contacto.php">Contacto</a></li>
                    </ul>

                </nav>
            </div>
        </header>       
        <main>
            <section id="banner">
                <?php
                $mostrar = 0;
                if (isset($_SESSION['username'])) {
                    //por seguridad compruebo si el usuario existe
                    if (usuarioexiste($_SESSION['username']) > 0) {
                        $mostrar = 1;
                    } else {
                        echo"<script>alert('El usuario ya no existe')</script>";
                    }
                } else {
                    echo"<script>alert('No puedes entrar aquí')</script>";
                }
                if ($mostrar == 1) {
                    ?>
                    <img src="Imagenes/banner.jpg">
                    <div id="centro"> 
                        <p>Datos de mi perfil</p>
                        <div id="usuario">
                            <?php
                            muestradatosmusico();
                            ?>
                        </div>

                        <div id="menu">
                            <ul>
                                <li><a href="#">Perfil</a></li>
                                <li><a href="#">Fotos</a></li>
                                <li><a href="#">Mensajes</a></li>
                                <li><a href="miperfilmusico.php">Configuración</a></li>
                                <?php cerraSession2() ?>
                            </ul>
                        </div>
                        <div id="conciertosInteres">
                            <p>Conciertos que pueden interesarte</p>
                        </div>
                        <div id="contenidoInteres">
                            <p>LISTA DE TODOS LOS CONCIERTOS PROPUESTOS</p>
                            <?php
                            extract($_SESSION);
                            $id_usuario = dimeidusuario($username);
                            $idgeneroMusico = dimeIdgeneroUsuario($id_usuario);

                            $listaConciertosGenero = listaConciertosporGenero($idgeneroMusico);
                            echo"<table border='1' padding='2px'>";
                            while ($fila = mysqli_fetch_assoc($listaConciertosGenero)) {
                                extract($fila);
                                echo"<tr>";
                                echo"<td>$nomconcierto</td><td>$fecha</td><td>$hora</td><td>$nombre</td>";
                                echo"<td>";
                                altaMusicoConcierto($id_concierto);
                                echo"</td>";
                                echo"<td>";
                                bajaMusicoConcierto($id_concierto);
                                echo"</td>";
                                echo"</tr>";
                            }
                            echo"</table>";

                            insertarPeticion();
                            bajaPeticion();

                            echo"<p>BUSCAR CONCIERTOS POR LOCAL</p>";
                            muestraSelectCiudad();

                            echo"<p>ESTADO DE TUS PETICIONES</p>";
                            peticionAceptadaLocal($id_usuario);
                            ?>


                        </div>
                        <div id="titulonoticias">
                            <p>Últimas noticias</p>
                        </div>
                        <div id="noticias">
                            <?php
                            $listaCociertos = listaConciertosPropuestos();
                            while ($fila = mysqli_fetch_assoc($listaCociertos)) {
                                extract($fila);
                                echo"<p>$nomconcierto  -  $fecha</p>";
                                echo"<a href='conciertos.php'></a>";
                            }
                            ?>
                        </div>
                    </div>  
                    <?php
                }
                ?>

            </section>
        </main>
        <footer>
            <div class="contenedor">
                <p class="copy">Ooh Music &copy; 2018</p>
                <div class="sociales">
                    <a class="icon-facebook-squared" href="#"></a>
                    <a class="icon-twitter" href="#"></a>
                    <a class="icon-instagram" href="#"></a>
                    <a class="icon-gmail" href="#"></a>
                </div>
            </div>

        </footer>
    </body>
</html>
