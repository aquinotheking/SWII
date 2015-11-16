<?php 

include_once('../Modelo/MParte.php');

include_once('../Modelo/MOficial.php');

include_once('../Modelo/MBitacora.php');

$mo=new Oficial();

$mp=new Parte();

$bi=new Bitacora();

date_default_timezone_set("America/Asuncion");
$fecha=date("Y/m/d");
$hora=date("h:i:s");
$ac="Eliminar Oficial Policial";

if(isset($_POST['Registrar']))
{
    //$ID=$_POST['cmbTipo'];
    //$Nombre=$_POST['cmbGrado'];
    $datos['Nombre']=$_POST['Nombre'];
    $datos['Fecha']=$_POST['Fecha'];
    $datos['Sexo']=$_POST['cmbSexo'];
    $datos['EC']=$_POST['cmbEst_Civ'];
    $datos['Domicilio']=$_POST['Domicilio'];
    $datos['Nacionalidad']=$_POST['Nacionalidad'];
    $datos['Telefono']=$_POST['Telefono'];
    $datos['CI']=$_POST['CI'];
    $datos['Profesion']=$_POST['Profesion'];
    $datos['Tipo']=$_POST['cmbTipo'];
	$sx=$mp->Insertar($datos);
    //$sy=$mt->Actualizar($ID);
    //$sz=$mg->Actualizar($Nombre);
	header("Location: ../Vista/VParte.php");		
}

if(isset($_POST['Modificar']))
{
    $datos['ID_Parte']=$_POST['ID'];
    $datos['Nombre']=$_POST['Nombre'];
    $datos['Domicilio']=$_POST['Domicilio'];
    $datos['Telefono']=$_POST['Telefono'];
    $sx=$mp->Modificar($datos);
    header("Location: ../Vista/VParte.php");       
}

if(isset($_POST['Eliminar']))
{
    $datos['CI']=$_POST['CI'];
    $bt['CI_Oficial']=9001961;
    $bt['Fecha']=$fecha;
    $bt['Hora']=$hora;
    $bt['Accion']=$ac;
    $bt['Motivo']=$_POST['Motivo'];
    $sx=$md->Eliminar($datos);
    $mj=$bi->Insertar($bt);
    header("Location: ../Vista/VOficial.php");       
}


 ?>