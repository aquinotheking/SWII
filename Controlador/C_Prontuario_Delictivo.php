<?php 

include_once('../Modelo/MProntuario_Delictivo.php');

include_once('../Modelo/MBitacora.php');

$mpd=new Prontuario_Delictivo();

$bi=new Bitacora();

date_default_timezone_set("America/Asuncion");
$fecha=date("d/m/Y");
$hora=date("h:i:s");
$ac="Eliminar Grado Policial";

if(isset($_POST['Registrar']))
{
	$datos['ID_D']=(int)$_POST['cmb_Delincuente'];
    $datos['ID_O']=(int)$_POST['cmb_Oficial'];
    $datos['Fecha']=$_POST['Fecha'];
    $datos['Descripcion']=$_POST['Descripcion'];
	$sx=$mpd->Insertar_Prontuario_D($datos);
	header("Location: ../Vista/V_Prontuario_Delictivo.php");		
}



 ?>