<?php 


include_once('../Modelo/MCiudadano.php');

$mc=new Ciudadano();

date_default_timezone_set("America/Asuncion");
$fecha=date("d/m/Y");
$hora=date("h:i:s");
$ruta="Evidencia";

if(isset($_REQUEST['Accion']))
{
    $ID=$_REQUEST['ID'];
    $sx=$mc->Liberar_Ciudadano($ID);
    echo'<script language="javascript">window.location="../Vista/V_Ciudadano.php"; alert("Ciudadano Liberado Correctamente");</script>'; 
}
else
{
    header("Location: ../Vista/V_Ciudadano.php");  
}


 ?>
