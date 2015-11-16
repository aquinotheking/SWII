<?php 

include_once('../Modelo/MGrado.php');

include_once('../Modelo/MBitacora.php');

$md=new Grado();

$bi=new Bitacora();

date_default_timezone_set("America/Asuncion");
$fecha=date("Y/m/d");
$hora=date("h:i:s");
$ac="Eliminar Grado Policial";

if(isset($_POST['Registrar']))
{
	$datos['Nombre']=$_POST['Nombre'];
    $datos['Cantidad']=0;
    $datos['Estado']=1;
	$sx=$md->Insertar($datos);
	header("Location: ../Vista/VGrado.php");		
}

if(isset($_POST['Modificar']))
{
    $datos['Nombre']=$_POST['Nombre'];
    $datos['ID']=$_POST['ID'];
    $sx=$md->Modificar($datos);
    header("Location: ../Vista/VGrado.php");       
}

if(isset($_POST['Eliminar']))
{
    $datos['Nombre']=$_POST['Nombre'];
    $bt['CI_Oficial']=9001961;
    $bt['Fecha']=$fecha;
    $bt['Hora']=$hora;
    $bt['Accion']=$ac;
    $bt['Motivo']=$_POST['Motivo'];
    $sx=$md->Eliminar($datos);
    $mj=$bi->Insertar($bt);
    header("Location: ../Vista/VGrado.php");       
}


 ?>
