<?php 

include_once('../Modelo/MOficial.php');

include_once('../Modelo/MTipo_O.php');

include_once('../Modelo/MGrado.php');

include_once('../Modelo/MBitacora.php');

$md=new Oficial();

$mt=new Tipo_Oficial();

$mg=new Grado();

$bi=new Bitacora();

date_default_timezone_set("America/Asuncion");
$fecha=date("Y/m/d");
$hora=date("h:i:s");
$ac="Eliminar Oficial Policial";

if(isset($_POST['Registrar']))
{
    $ID=$_POST['cmbTipo'];
    $Nombre=$_POST['cmbGrado'];
	$datos['CI']=$_POST['CI'];
    $datos['Nombre']=$_POST['Nombre'];
    $datos['Direccion']=$_POST['Direccion'];
    $datos['Correo']=$_POST['Correo'];
    $datos['Telefono']=$_POST['Telefono'];
    $datos['Sexo']=$_POST['cmbSexo'];
    $datos['Estado_Civil']=$_POST['cmbEst_Civ'];
    $datos['Procedencia']=$_POST['Procedencia'];
    $datos['Cargo']=$_POST['cmbGrado'];
    $datos['Tipo']=$_POST['cmbTipo'];
    $datos['Pass']=$_POST['Password'];
    $datos['Servicio']=0;
    $datos['Estado']=1;
	$sx=$md->Insertar($datos);
    $sy=$mt->Actualizar($ID);
    $sz=$mg->Actualizar($Nombre);
	header("Location: ../Vista/VOficial.php");		
}

if(isset($_POST['Modificar']))
{
    $datos['CI']=$_POST['CI'];
    $datos['Nombre']=$_POST['Nombre'];
    $datos['Direccion']=$_POST['Direccion'];
    $datos['Correo']=$_POST['Correo'];
    $datos['Telefono']=$_POST['Telefono'];
    $sx=$md->Modificar($datos);
    header("Location: ../Vista/VOficial.php");       
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