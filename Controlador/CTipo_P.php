<?php 

include_once('../Modelo/MTipo_P.php');

include_once('../Modelo/MBitacora.php');

$md=new Tipo_Persona();

$bi=new Bitacora();

date_default_timezone_set("America/Asuncion");
$fecha=date("Y/m/d");
$hora=date("h:i:s");
$ac="Eliminar Tipo Persona";

if(isset($_POST['Registrar']))
{
	$datos['Nombre']=$_POST['Nombre'];
    $datos['Descripcion']=$_POST['Descripcion'];
    $datos['Estado']=1;
	$sx=$md->Insertar($datos);
	header("Location: ../Vista/VTipo_P.php");		
}

if(isset($_POST['Modificar']))
{
    $datos['ID_TP']=$_POST['ID'];
    $datos['Nombre']=$_POST['Nombre'];
    $datos['Descripcion']=$_POST['Descripcion'];
    $sx=$md->Modificar($datos);
    header("Location: ../Vista/VTipo_P.php");       
}

if(isset($_POST['Eliminar']))
{
    $datos['ID_TP']=$_POST['ID'];
    $bt['CI_Oficial']=9001961;
    $bt['Fecha']=$fecha;
    $bt['Hora']=$hora;
    $bt['Accion']=$ac;
    $bt['Motivo']=$_POST['Motivo'];
    $sx=$md->Eliminar($datos);
    $mj=$bi->Insertar($bt);
    header("Location: ../Vista/VTipo_P.php");       
}


 ?>
