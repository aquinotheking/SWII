<?php 

include_once('../Modelo/MDenuncia.php');

include_once('../Modelo/MBitacora.php');

$md=new Denuncia();

$bi=new Bitacora();

date_default_timezone_set("America/Asuncion");
$fecha=date("d/m/Y");
$hora=date("h:i:s");
$ac="Eliminar Grado Policial";

if(isset($_POST['Registrar']))
{
	
    $datos['ID_D']=(int)$_POST['ID_D'];
    $datos['FH']="$fecha - $hora";
    $datos['CI_S']=$_POST['CI_S'];
    $datos['DP']=$_POST['cmbDP'];
    $datos['TD']=$_POST['cmbTD'];
    $datos['Lugar']=$_POST['LugarH'];
    $datos['Descripcion']=$_POST['DescripcionH'];
    $datos['Estado']="EN INVESTIGACION";
    $sx=$md->Insertar($datos);
    $sy=$md->ActualizarND();
    header("Location: ../Vista/VDenuncia.php");		
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
