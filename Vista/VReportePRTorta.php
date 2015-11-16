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



include_once('../Modelo/MParte.php');

$mp=new Parte();

$sx=$mp->Cargar_Tipo_P();

 while ($rw=mysql_fetch_array($sx)) {
    $datos.='["'.$rw['Tipo'].'", '.$rw['Cantidad'].'],';
}
?>


<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>REPORTES CON GRADICOS</title>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<style type="text/css">
${demo.css}
		</style>
        <link   href="../css/bootstrap.min.css" rel="stylesheet">
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/jquery.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/bootstrapValidator.min.js"></script>
		<script type="text/javascript">
$(function () {
    $('#grafica').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: 'REPORTES PARTES REGISTRADOS'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Tipo de Parte',
            data: [
                <?php 

                   echo "$datos";

                 ?>
            ]
        }]
    });
});


		</script>
	</head>
	<body style="background:black;">
<script src="../Highcharts/js/highcharts.js"></script>
<script src="../Highcharts/js/modules/exporting.js"></script>
<h1 style=" text-align: center; font-size: 50px; color:white;"><b>F.E.L.C.C.</b></h1>
<img src="../img/escudo.png" style="float:left; margin-top: -80px;" />
<img src="../img/escudo.png" style="float:right; margin-top: -80px;" />
<div id="grafica" style="min-width: 310px; height: 400px; max-width: 600px; margin-top: 30px; margin-left: 370px;" align="center"></div>
<center><a class="btn btn-primary btn-lg" href="VReportes.php" style="margin-top: 30px;">Volver</a></center>
    </body>
</html>

