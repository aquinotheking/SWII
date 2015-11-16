<?php 

include_once('../Modelo/MD_Partes.php');

include_once('../Modelo/MBitacora.php');

$md=new Detalle_Partes();

$bi=new Bitacora();



$Accion=$_REQUEST['Accion'];

date_default_timezone_set("America/Asuncion");
$fecha=date("Y/m/d");
$hora=date("h:i:s");
$ac="Eliminar Tipo Denuncia";


if($_REQUEST['Accion']=="Insertar")
{
    $ID_P=$_REQUEST['ID_P'];
    $ID_C=$_REQUEST['ID_C'];
    $Nombre=$_REQUEST['Nombre'];
    $Domicilio=$_REQUEST['Domicilio'];
    $Telefono=$_REQUEST['Telefono'];
    $Tipo=$_REQUEST['Tipo'];
    $CI=$_REQUEST['CI'];
	$datos['ID_Parte']=$ID_P;
    $datos['ID_Caso']=$ID_C;
    $datos['Nombre']=$Nombre;
    $datos['Domicilio']=$Domicilio;
    $datos['Telefono']=$Telefono;
    $datos['Tipo']=$Tipo;
    $datos['CI']=$CI;
    $sx=$md->Insertar($datos);
	header("Location: ../Vista/VD_Denunciante.php?ID=$ID_C&Tipo=$Tipo");		
}

if($_REQUEST['Accion']=="Eliminar")
{
    $ID_P=$_REQUEST['ID_P'];
    $ID_C=$_REQUEST['ID'];
    $Tipo=$_REQUEST['Tipo'];
    $datos['ID_Parte']=$ID_P;
    $datos['ID_Caso']=$ID_C;
    $sx=$md->Eliminar($datos);
    header("Location: ../Vista/VD_Denunciante.php?ID=$ID_C&Tipo=$Tipo");
}


 ?>
