<!DOCTYPE html>
<!--
Esta es la pagina para registrar fans. 
-->
<?php
require_once 'bbdd.php';
?>
<html lang="es">
    <head>
        <title>OohMusic</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1">
        <link rel="stylesheet" href="css/fontello.css">
        <link rel="stylesheet" href="css/estilosRfan.css">
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
                <div id="formulario"> 
                    <script>
                        function verificar() {
                            var pass1 = document.getElementById("pass1").value;
                            var pass2 = document.getElementById("pass2").value;
                            if (pass1 != pass2) {
                                alert("Las contraseñas no son iguales");
                                return false;
                            }
                            return true;
                        }

                    </script>
                    <?php
                    if (isset($_POST["next"])) {
                        extract($_POST);
                        if (usuarioexiste($username) > 0) {
                            echo "<script>alert('Este usuario ya está registrado')</script>";
                            //echo"Error..este usuario ya esta registrado";
                        } else {
                            if ($pass1 == $pass2) {
                                if (registrar_fan($username, $pass1, 3, $name, $mail, $phone, $city, $surname1, $surname2, $address, "") == "ok") {
                                    echo"<script>alert('Se ha registrado el fan correctamente')</script>";
                                    header("Refresh:0; url=login.php");
                                } else {
                                    echo "<script>alert('Error al registrar fan')</script>";
                                    //echo"Error al registrar fan";
                                }
                            }
                        }
                    } else {
                        ?>
                        <form action="" method="POST" onsubmit="return verificar();">  
                            <table>
                                <tr>
                                    <td>
                                        <p>Nombre:</p>
                                        <p><input type="text" name="name" required></p>
                                    </td>
                                    <td>
                                        <p>Nombre de usuario:</p>
                                        <p><input type="text" name="username" required></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>Primer apellido:</p>
                                        <p><input type="text" name="surname1" required></p>
                                    </td>
                                    <td>
                                        <p>Contraseña:</p>
                                        <p><input type="password" name="pass1" id="pass1" required></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>Segundo apellido:</p>
                                        <p><input type="text" name="surname2" required></p>
                                    </td>
                                    <td>
                                        <p>Repetir contraseña:</p>
                                        <p><input type="password" name="pass2" id="pass2" required></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>Teléfono:</p>
                                        <p><input type="tel" name="phone"></p>
                                    </td>
                                    <td>
                                        <p>Imagen:</p>
                                        <p><input type="button" value="Seleccionar imagen" name="imagen"></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>Email:</p>
                                        <p><input type="email" name="mail" required></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>Ciudad:</p>
                                        <p><select name="city" required>-->
                                                <?php
                                                $ciudades = leeciudades("Barcelona");
                                                while ($fila = mysqli_fetch_assoc($ciudades)) {
                                                    extract($fila);
                                                    echo"<option value='$id_ciudad'>$nombre</option>";
                                                }
                                                ?>
                                            </select></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p>Dirección:</p>
                                        <p><input type="text" name="address"></p>
                                    </td>
                                </tr>
                            </table>
                            <br><br><br>
                            <p><input type="submit" value="Registrarme como fan" id="button" name="next" ></p>
                        </form>
                        <?php
                    }
                    ?>
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
