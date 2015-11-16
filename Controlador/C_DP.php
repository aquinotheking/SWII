<?php 

include_once('../Modelo/MDP.php');

include_once('../Modelo/MBitacora.php');

$md=new Distrito_Policial();

$bi=new Bitacora();

date_default_timezone_set("America/Asuncion");
$fecha=date("Y/m/d");
$hora=date("h:i:s");
$ac="Eliminar Distrito Policial";

if(isset($_POST['Registrar']))
{
	$datos['Nombre']=$_POST['Nombre'];
    $datos['Direccion']=$_POST['Direccion'];
    $datos['Telefono']=$_POST['Telefono'];
    $datos['Estado']=1;
	$sx=$md->Insertar($datos);
	header("Location: ../Vista/VDP.php");		
}

if(isset($_POST['Modificar']))
{
    $datos['ID_DP']=$_POST['ID'];
    $datos['Nombre']=$_POST['Nombre'];
    $datos['Direccion']=$_POST['Direccion'];
    $datos['Telefono']=$_POST['Telefono'];
    $sx=$md->Modificar($datos);
    header("Location: ../Vista/VDP.php");       
}

if(isset($_POST['Eliminar']))
{
    $datos['ID_DP']=$_POST['ID'];
    $bt['CI_Oficial']=9001961;
    $bt['Fecha']=$fecha;
    $bt['Hora']=$hora;
    $bt['Accion']=$ac;
    $bt['Motivo']=$_POST['Motivo'];
    $sx=$md->Eliminar($datos);
    $mj=$bi->Insertar($bt);
    header("Location: ../Vista/VDP.php");       
}


 ?>
