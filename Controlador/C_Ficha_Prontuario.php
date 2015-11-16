<?php 

include_once('../Modelo/MFicha_Prontuario.php');

include_once('../Modelo/MBitacora.php');

$mfp=new Ficha_Prontuario();

$bi=new Bitacora();

date_default_timezone_set("America/Asuncion");
$fecha=date("d/m/Y");
$hora=date("h:i:s");
$ac="Eliminar Grado Policial";

if(isset($_POST['Registrar']))
{
	$datos['ID_Prontuario']=(int)$_POST['Caso'];
    $datos['CI_Oficial']=(int)$_POST['Oficial'];
    $datos['ID_Delincuente']=(int)$_POST['Caso'];
    $datos['Fecha']=$_POST['Fecha'];
    $datos['Lugar']=$_POST['Lugar'];
    $datos['Descripcion']=$_POST['Descripcion'];
	$sx=$mfp->Insertar_Ficha_Prontuario($datos);
	header("Location: ../Vista/V_Prontuario_Delictivo.php");		
}



 ?>