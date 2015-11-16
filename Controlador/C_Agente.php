<?php 

include_once('../Modelo/MAgente.php');

include_once('../Modelo/MGrado.php');

include_once('../Modelo/MBitacora.php');

$ma=new Agente();

$mg=new Grado();

$bi=new Bitacora();

date_default_timezone_set("America/Asuncion");
$fecha=date("d/m/Y");
$hora=date("h:i:s");
$ac="Eliminar Agente Policial";

if(isset($_POST['Registrar']))
{
    $Nombre=$_POST['cmbGrado'];
	$datos['CI']=$_POST['CI'];
    $datos['Nombre']=$_POST['Nombre'];
    $datos['Direccion']=$_POST['Direccion'];
    $datos['Correo']=$_POST['Correo'];
    $datos['Telefono']=$_POST['Telefono'];
    $datos['Grado']=$_POST['cmbGrado'];
    $datos['Pass']=$_POST['Password'];
    $datos['Longitud']=0;
    $datos['Latitud']=0;
    $datos['Estado']=1;
	$sx=$ma->Insertar_Agente($datos);
    header("Location: ../Vista/V_Agentes.php");		
}

if(isset($_POST['Modificar']))
{
    $datos['CI']=$_POST['CI'];
    $datos['Nombre']=$_POST['Nombre'];
    $datos['Direccion']=$_POST['Direccion'];
    $datos['Correo']=$_POST['Correo'];
    $datos['Telefono']=$_POST['Telefono'];
    $sx=$ma->Modificar_Agente($datos);
    header("Location: ../Vista/V_Agentes.php");       
}

if(isset($_POST['Eliminar']))
{
    $datos['ID']=$_POST['CI'];
    $bt['CI_Oficial']=9001961;
    $bt['Fecha']=$fecha;
    $bt['Hora']=$hora;
    $bt['Accion']=$ac;
    $bt['Motivo']=$_POST['Motivo'];
    $sx=$ma->Eliminar_Agente($datos);
    $mj=$bi->Insertar($bt);
    header("Location: ../Vista/V_Agentes.php");       
}


 ?>