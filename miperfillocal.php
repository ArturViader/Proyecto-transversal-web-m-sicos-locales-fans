<!DOCTYPE html>
<!--
Pagina de locales.
-->

<html lang="es">
    <head>
        <title>OohMusic</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">
        <link rel="stylesheet" href="css/fontello.css">
        <link rel="stylesheet" href="css/estilosMiperfilLocal.css">
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
                <img src="Imagenes/banner.jpg">
                <div id="centro"> 
                    <p>Datos de mi perfil</p>
                    <div id="usuario">
                        <p>Juan García Aguilar</p>
                        <hr>
                        <div id="info">
                            <img src="Imagenes/usuario.png">
                        </div>
                    </div>
                    <div id="menu">
                        <ul>
                            <li><a href="#">Perfil</a></li>
                            <li><a href="#">Fotos</a></li>
                            <li><a href="#">Mensajes</a></li>
                            <li><a href="#">Configuración</a></li>
                            <li><a href="#">Cerrar sesión</a></li>
                        </ul>
                    </div>
                    <script>
                        function abrirParametros() {
                            var ventana=open('','','status=yes,width=400,height=250,menubar=yes');
                            ventana.document.write("<style>");
                            ventana.document.write("backgound: rgba(51,51,51,0.8);")
                            ventana.document.write("</style>");
                            ventana.document.write("<form>");
                            ventana.document.write("<p>Introduce tu contraseña actual:</p>");
                            ventana.document.write("<p><input type='password' name='passactual'></p>");
                            ventana.document.write("<p>Introduce la nueva contraseña:</p>");
                            ventana.document.write("<p><input type='password' name='passnew1'></p>");
                            ventana.document.write("<p>Repite tu nueva contraseña:</p>");
                            ventana.document.write("<p><input type='password' name='passnew2'></p>");
                            ventana.document.write("<p><input type='submit' value='Cambiar contraseña'></p>");
                            ventana.document.write("</form>");
                        }
                    </script>
                    <div id="miperfil">
                        <p id="tituloperfil">Modificar datos</p>
                        <div id="formulariodatos">
                            <form>  
                                <table>
                                    <tr>
                                        <td>
                                            <p>Nombre:
                                            <input type="text" id="nombre" name="name" value="Juan García Aguilar"></p>
                                        </td>
                                        <td>
                                            <p>Ubicación:
                                            <input type="text" name="location" value="Sant Esteve Sesrovires"></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p>Email:
                                            <input type="email" name="mail" value="juan_garcia@gmail.com"></p>
                                        </td>
                                        <td>
                                            <p>Aforo:
                                            <input type="number" name="aforo" value="180"></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p>Teléfono:
                                            <input type="tel" name="phone" value="652436278"></p>
                                        </td>
                                        <td>
                                            <p>Nombre de usuario:
                                            <input type="text" name="username" value="JuanG1"></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p>Ciudad:
                                            <select id="select" name="city">
                                                <option value="barcelona">Barcelona</option>    
                                                <option value="madrid">Madrid</option>
                                                <option value="sevilla">Sevilla</option>
                                               </select></p>
                                        </td>
                                        <td>
                                            <p>Imagen:
                                            <input type="button" value="Seleccionar imagen"></p>
                                        </td>
                                    </tr>
                                </table>
                            <br><br><br>
                            <p><input type="submit" value="Cambiar contraseña" id="contraseña" onClick="abrirParametros()"></p>
                            <p><input type="submit" value="Modificar datos de perfil" id="button"></p>
                    </form>
                        </div>
                    </div>
                </div>
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