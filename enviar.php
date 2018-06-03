<?php
session_start();
require_once 'bbdd.php';
require_once 'funciones.php';
require_once 'msgbbdd.php';
?>
<html lang="es">
    <head>
        <title>OohMusic</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">
        <link rel="stylesheet" href="css/fontello.css">
        <link rel="stylesheet" href="css/estilosMusico.css">
        <script src="jquery.min.js"></script>
        <script type="text/javascript" src="funciones.js"></script>
    </head>
    <body>
        <header>
            <div class="contenedor">
                <h1 class="icon-music">Ooh Music</h1>
                <!-- Segundo -->
                <input type="checkbox" id="menu-user">
                <label id="label1" class="icon-user-circle" for="menu-user"></label>
                <!-- Primero -->
                <input type="checkbox" id="menu-bar">
                <label class="icon-menu" for="menu-bar"></label>
                <nav class="menuuser">
                    <?php
                    controlDesplegable();
                    ?>

                </nav>
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
                                <li><a href="usuariomusico.php">Perfil</a></li>
                                <li><a href="#">Fotos</a></li>
                                <li><a href="homeuser.php">Mensajes</a></li>
                                <li><a href="miperfilmusico.php">Configuración</a></li>
                                <?php cerraSession2() ?>
                            </ul>
                        </div>
                        <div id="conciertosInteres">
                            <p>OohMessage</p>
                        </div>
                        <div id="contenidoInteres">
                            <p class="titulo">ENVIAR NUEVO MENSAJE</p>
                            <?php
                            echo"<form action='' method='POST'>";

                            echo"Remitente:<select name='remitente'>";
                            //CON LA SIGUIENTE FUNCION Y EL BUCLE WHILE METO TODOS LOS USUARIOS DE LA 
                            //BASE DE DATOS EN UN SELECT.
                            $nombres = selectNameuser();
                            while ($fila = mysqli_fetch_assoc($nombres)) {
                                echo"<option>";
                                echo $fila ["username"];
                                echo"</option>";
                            }
                            echo"</select>";
                            echo"<br><br>";
                            echo"Remitente 2:&nbsp<input type='text' name='buscador' autocomplete='off' size='80'id='buscador' required><br><br>";
                            echo"Asunto:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type='text' name='asunto' size='80'required>";
                            echo"<br><br>";

                            echo"Escriba el mail acontinuacion:<br><textarea name='texto' rows='12' cols='50' required>Escribe...
                </textarea>";
                            echo"<br><br>";

                            echo"<input type='submit' name='next' value='enviar'>";
                            echo"<br><br>";

                            echo"</form>";

                            echo"<div id = 'autobuscador'>";

                            echo"</div>";

                            if (isset($_POST["next"])) {
                                $remitente = $_POST["remitente"];
                                $asunto = $_POST["asunto"];
                                $texto = $_POST["texto"];

                                // CON LA SIGUIENTE FUNCION Y CON AYUDA DE LAS VARIABLES RECOJIDAS DEL FORMULARIO
                                // INSERTO EN LA BASE DE DATOS EN MENSAJE QUE SE QUEIRE ENVIAR.

                                $username = $_SESSION["username"];
                                //CON LA SIGUIENTE VARIABLE $TIPOEVENTO Y LA FUNCION ALTA_EVENTO CAMBIO 
                                //A TIPO REDACCION "R" EL ESTADO DEL MENSAJE.
                                $tipoevento = "R";
                                alta_evento($username, $tipoevento);


                                $enviado = insertarMensaje($username, $remitente, $asunto, $texto);

                                if ($enviado == "ok") {
                                    echo"Mensaje enviado satisfactoriamente";
                                } else {
                                    echo"Error al enviar el mensaje $enviado";
                                }
                            }
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
                                echo"<div class='noti'>";
//                                echo"<p>$nomconcierto</p>";
//                                echo"<p>$fecha</p>";
                                echo"<p><a href='conciertos.php' <p>$nomconcierto --- $fecha</p><img id='imgconc' src='Imagenes/AFS31.jpg'></a></p>";
                                echo"</div>";
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

