<html lang="es">
    <head>
        <title>OohMusic</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="funciones.js"></script>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">
        <link rel="stylesheet" href="css/fontello.css">
        <link rel="stylesheet" href="css/estilos.css">
    </head>
    <body>
        <?php
        session_start();
        require_once 'bbdd.php';
        require_once 'funciones.php';
        ?>
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
                <img src="Imagenes/banner.jpg">
                <div class="contenedor">
                    <h2>Música para todos</h2>
                    <p>Nuevos conciertos en tu ciudad</p>
                    <a href="#">Leer más</a>
                </div>
            </section>

            <section id="bienvenidos">
                <h2>Bienvenidos</h2>
                <p>En nuestra página podrás disfrutar de todos los conciertos de tu ciudad con solo un clik, apoyar a tus artistas favoritos o hacerte fan.</p>
            </section>

            <section id="blog">
                <h3>Aquí tienes a nuestros locales y músicos ¡Échales un ojo!</h3>
                
                
                <div id="busc">
                    <form method="POST">  
                        <p>Buscar: <input id="buscador" type="text" name="buscador" required>
                            <input type="submit" value="GO" name="buscar2"></p>
                    </form>
                </div>
                
                
                
                <div class="contenedor">
                    <article>
                        <h4>Locales</h4>
                        <div class="listas">
                            <?php
                            $locales = listalocalesordenadosporciudad();
                            while ($ellocal = mysqli_fetch_assoc($locales)) {
                                extract($ellocal);
                                echo"<p>$nombre - $ciudad</p><hr>";
                            }
                            ?>

                        </div>
                    </article>
                    <article>
                        <h4>Músicos</h4>
                        <div class="listas">
                            <?php
                            $listamusicos = ordenarMusicosPorGenero();
                            while ($musicos = mysqli_fetch_assoc($listamusicos)) {
                                extract($musicos);
                                echo"<p>$nombreart - $nombre</p><hr>";
                            }
                            ?>


                        </div>
                    </article>
                    
                    <article>
                        <h4 id="conc">Conciertos</h4>
                        <div class="listas" id="conciertos">
                            <table border="1">
                                <tr id="titulos">
                                    <td>Nombre del concierto</td>
<!--                                        <hr id="l1" width="1" size="298">-->
                                    <td>Genero</td>
<!--                                        <hr id="l2" width="1" size="298">-->
                                    <td>Organizador</td>
<!--                                        <hr id="l3" width="1" size="298">-->
                                    <td>Fecha</td>
<!--                                        <hr id="l4" width="1" size="298">-->
                                    <td>Hora</td>
<!--                                        <hr id="l5" width="1" size="298">-->
                                    <td>Pago</td>
                                </tr>
                            
                            <?php
                            $listaConciertosAceptados = mostrarListaConciertosAceptados();
                            
                            while ($lista = mysqli_fetch_assoc($listaConciertosAceptados)){
                                extract($lista);
//                                echo"<p>$nomconcierto - $fecha - $hora - $pago - $nomlocal - $nomgenero</p>";
//                                echo"<p>$nomconcierto</p><br>";
//                                echo"<p>$nomgenero</p><br>";
//                                echo"<p>$nomlocal</p><br>";
//                                echo"<p>$fecha</p><br>";
//                                echo"<p>$hora</p><br>";
//                                echo"<p>$pago</p><br>";
                                echo "<tr id='datos'>";
                                echo "<td><p>$nomconcierto</p></td>";
                                echo "<td><p>$nomgenero</p></td>";
                                echo "<td><p>$nomlocal</p></td>";
                                echo "<td><p>$fecha</p></td>";
                                echo "<td><p>$hora</p></td>";
                                echo "<td><p>$pago</p></td>";
                                echo "</tr>";
                            }
                            echo "</table>";
                            ?>
                        </div>

                    </article>
                    <article>
<!--                        Buscador-->
                        <div>
                        <p>
                       
                        <?php
                        if (isset($_POST["buscar2"])) {
                            extract($_POST);

                            $resuBusqueda = buscador($buscador);
                            if ($resuBusqueda == -1) {
                                echo"<br><h1>no encontro nada con este nombre</h1><br>";
                            } else {
                                echo"<br>";
                                extract($resuBusqueda);
                                muestraUsuariosTipo($tipo);
                                echo"<br>";
                                echo"<p><br>Nombre: $nombre<br></p>";
                                echo"<p><br>Email: $email<br></p>";
                                if ($tipo == 1) {
                                    echo"<br><h1>Datos Proximo concierto</h1><br>";
                                    $r = mirarConciertosLocal2($nombre, $id_usuario);
                                    while ($fila = mysqli_fetch_assoc($r)) {
                                        extract($fila);
                                        echo"<p>Fecha: $fecha - Artista: $nombreart - Pago: $pago</p>";
                                    }
                                }
                            }
                        }
                        ?>


                        </p>
                        </div>
                    </article>
                </div>
            </section>

            <section id="info">
                <h3>¡Vívelo! No solo es música...</h3>
                <div class="contenedor">
                    <div class="info-music">
                        <img src="Imagenes/clasica.jpg">
                        <h4>Música clásica</h4>
                    </div>
                    <div class="info-music">
                        <img src="Imagenes/hiphop.jpg">
                        <h4>Musica Hip Hop</h4>
                    </div>
                    <div class="info-music">
                        <img src="Imagenes/rock.jpg">
                        <h4>Música Rock</h4>
                    </div>
                    <div class="info-music">
                        <img src="Imagenes/electronica.jpg">
                        <h4>Música electrónica</h4>
                    </div>
                </div>
            </section>
            <?php
            if (isset($_GET['cerrar'])) {
                cerraSession();
            }
            ?>

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