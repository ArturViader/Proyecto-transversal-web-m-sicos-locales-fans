<?php
     session_start();
     require_once 'bbdd.php';
     require_once 'funciones.php';
     extract($_SESSION);
     if(isset($_SESSION['username']))
     {
        echo"<b>Conciertos de tu local.</b>";
        $id_usuario = dimeidusuario($username);
        $conciertos=listaconciertoslocal($id_usuario);
        echo"<table border=1>";
        echo"<tr><td><b>Nombre</b></td><td><b>Fecha</b></td><td><b>Hora</b></td><td><b>Género</b></td><td><b>Estado</b></td><td></td><td></td></tr>";
        while($fila=mysqli_fetch_assoc($conciertos))
        {
          extract($fila);
          $ngenero=dimenombregenero($genero);
          $estadop=cualestado($estado);
          
          echo"<tr><td>$nombre</td><td>$fecha</td><td>$hora</td><td>$ngenero</td><td>$estadop</td>";
          if($estado==0)
          {
              $musicospropuestos = cuantosmusicospropuestos($id_concierto);              
              echo"<td><a href='borraconcierto.php?id=$id_concierto'>Eliminar</a></td>";
              if($musicospropuestos>0)
              {
                  echo"<td><a href='confirmarconcierto.php?id=$id_concierto'>Hay $musicospropuestos músicos propuestos.</a></td>";
              }
              else
              {
                  echo"<td></td>";
              }
          }
          else
          {
              echo"<td></td><td></td>";
          }
          echo"</tr>";
        }
        echo"</table>";
     }
     else
     {
         echo"Sesión no iniciada.";
     }   
?>