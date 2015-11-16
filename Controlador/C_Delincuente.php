<?php 

include_once('../Modelo/M_Delincuente.php');

include_once('../Modelo/MBitacora.php');

$md=new Delincuente();

$bi=new Bitacora();

date_default_timezone_set("America/Asuncion");
$fecha=date("d/m/Y");
$hora=date("h:i:s");
$ac="Eliminar Grado Policial";

if(isset($_POST['Registrar']))
{
	$datos['CI']=$_POST['CI'];
    $datos['Nombre']=$_POST['Nombre'];
    $datos['Alias']=$_POST['Alias'];
    $datos['Sexo']=$_POST['cmb_Sexo'];
    $datos['EC']=$_POST['cmbEstado_Civil'];
    $datos['Fecha']=$_POST['Fecha'];
	$sx=$md->Insertar_Delincuente($datos);
	header("Location: ../Vista/V_Delincuente.php");		
}

if(isset($_POST['Modificar']))
{
    $datos['ID_Delincuente']=$_POST['ID'];
    $datos['CI']=$_POST['CI'];
    $datos['Nombre']=$_POST['Nombre'];
    $datos['Alias']=$_POST['Alias'];
    $sx=$md->Modificar_Delincuente($datos);
    header("Location: ../Vista/V_Delincuente.php");       
}


 ?>