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


include_once('../Modelo/MOficial.php');

$mo=new Oficial();

$sx=$mo->Cargar_Oficiales_R();

$sy=$mo->Cargar_Oficiales_R();

?>

<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>REPORTE FELCC</title>

        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <link   href="../css/bootstrap.min.css" rel="stylesheet">
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/jquery.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/bootstrapValidator.min.js"></script>
        <style type="text/css">
#container {
    height: 400px; 
    min-width: 310px; 
    max-width: 800px;
    margin: 0 auto;
}
        </style>
        <script type="text/javascript">
$(function () {
    $('#container').highcharts({
        chart: {
            type: 'column',
            margin: 75,
            options3d: {
                enabled: true,
                alpha: 10,
                beta: 25,
                depth: 70
            }
        },
        title: {
            text: 'OFICIALES REGISTRADOS'
        },
        subtitle: {
            text: 'Grado de Oficiales en Servicio'
        },
        plotOptions: {
            column: {
                depth: 25
            }
        },
        xAxis: {
            categories:[

            <?php 

                    while ($rw=mysql_fetch_array($sx)) {

                 ?>
                ['<?php echo $rw['Grado']; ?>'],

                <?php 

                }
             ?>

            ]
        },
        yAxis: {
            title: {
                text: null
            }
        },
        series: [{
            name: 'Grado',
            data: [

            <?php 


                    while ($rw=mysql_fetch_array($sy)) {

                 ?>

                [<?php echo $rw['Cantidad']; ?>],
            <?php 

                }
             ?>

            ]
        }]
    });
});
        </script>
    </head>
    <body style="background:black;">

<script src="../Highcharts/js/highcharts.js"></script>
<script src="../Highcharts/js/highcharts-3d.js"></script>
<script src="../Highcharts/js/modules/exporting.js"></script>

<h1 style=" text-align: center; font-size: 50px; color:white;"><b>F.E.L.C.C.</b></h1>
<img src="../img/escudo.png" style="float:left; margin-top: -80px;" />
<img src="../img/escudo.png" style="float:right; margin-top: -80px;" />
<div id="container" style="height: 400px; margin-top: 80px;"></div>

<center><a class="btn btn-primary btn-lg" href="VReportes.php" style="margin-top: 30px;">Volver</a></center>
    </body>
</html>