<?php 
session_start();

date_default_timezone_set("America/Asuncion");
$fecha=date("Y/m/d");
$hora=date("h:i:s");

if ($_SESSION["autentificado"] != "SI") { 
    //si no está logueado lo envío a la página de autentificación 
    header("Location: ../index.html"); 
} else { 
    //sino, calculamos el tiempo transcurrido 
    $fechaGuardada = $_SESSION["ultimoAcceso"]; 
    $ahora = $hora; 
    $tiempo_transcurrido = (strtotime($ahora)-strtotime($fechaGuardada)); 
    //comparamos el tiempo transcurrido 
     if($tiempo_transcurrido >= 600) { 
     //si pasaron 10 minutos o más 
      session_destroy(); // destruyo la sesión 
      header("Location: ../index.html"); //envío al usuario a la pag. de autenticación 
      //sino, actualizo la fecha de la sesión 
    }else { 
    $_SESSION["ultimoAcceso"] = $ahora; 
   } 
} 


require_once('../header.php');

 ?>
 <form action="" method="POST" action="">
 <h1 style="margin-top: -60px; font-size: 40px;"><b>REPORTES FELCC</b></h1>
<div class="row" style="margin-top: -120px;">

          <table class="table table-striped table-bordered">
            <thead>
              <tr>
                <th style="background:black; color:white; text-align: center;">Nombre Reporte</th>
                <th style="background:black; color:white; text-align: center;">Torta</th>
                <th style="background:black; color:white; text-align: center;">Barras</th>
              </tr>
            </thead>
            <tbody>
            <tr>
                <td style="	text-align: center;">Partes Registradas</td>
                <td style="text-align: center;"><a class="btn btn-primary" href="VReportePRTorta.php">Ver</a></td>
                <td style="text-align: center;"><a class="btn btn-success" href="VReportePRBarra.php">Ver</a></td>
            </tr>
            <tr>
                <td style="	text-align: center;">Oficiales En Servicio</td>
                <td style="text-align: center;"><a class="btn btn-primary" href="VReporteGOTorta.php">Ver</a></td>
                <td style="text-align: center;"><a class="btn btn-success" href="VReporteGOBarra.php">Ver</a></td>
            </tr>
            </tbody>
          </table>
        </div>

</center>
</form><p>
 <?php 

require_once('../footer.php');

 ?>