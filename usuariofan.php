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
                                <li><a href="usuariofan.php">Perfil</a></li>
                                <li><a href="#">Fotos</a></li>
                                <li><a href="#">Mensajes</a></li>
                                <li><a href="miperfilfan.php">Configuración</a></li>
                                <?php cerraSession2() ?>
                            </ul>
                        </div>
                        <div id="conciertosInteres">
                            <p>Votos</p>
                        </div>
                        <div id="contenidoInteres">

                            <?php
                            extract($_SESSION);
                            $id_usuario = dimeidusuario($username);
                            
                            echo"<table>";
                            echo"<tr>";
                            echo"<td>NOMBRE</td><td>GENERO</td><td>VOTO</td>";
                            echo"</tr>";
                            $listamusicos = ordenarMusicosPorGenero();
                            while ($musicos = mysqli_fetch_assoc($listamusicos)) {
                                extract($musicos);
                                echo"<tr>";
                                $id_musico = dimeidusuario($nombreart);
                                
                                $numr = verificarVotoMusico($id_usuario, $id_musico);
                                if(verificarVotoMusico($id_usuario, $id_musico)){
                                    echo"<td>$nombreart</td><td>$nombre</td><td>". eliminarVotoMusico1($id_musico)."</td>";
                                    
                                }else{
                                    echo"<td>$nombreart</td><td>$nombre</td><td>". nuevoVotoMusico($id_musico)."</td>";
                                    
                                }
//                                
                                echo"</tr>";
                            }
                            
                            echo"</table>";
                            
                            
                            altaVotoMusico2();
                            eliminarVotoMusico2();
                            ?>
                        </div>
                        <div id="titulonoticias">
                            <p>Últimas noticias</p>
                        </div>
                        <div id="noticias">

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
