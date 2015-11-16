<?php 

include_once('../Modelo/MD_Investigador.php');

include_once('../Modelo/MBitacora.php');

include_once('../Modelo/MOficial.php');

$mdi=new Detalle_Investigador();

$bi=new Bitacora();

$mo=new Oficial();

if(isset($_POST['cmbIA']))
{
    $ID=$_POST['cmbIA'];

$sa=$mo->Modificar_O($ID);

while ($row = mysql_fetch_array($sa)){
        $Nombre=$row['Nombre'];
        $Cargo=$row['Cargo'];
    }
}

  
date_default_timezone_set("America/Asuncion");
$fecha=date("Y/m/d");
$hora=date("h:i:s");
$ac="Eliminar Grado Policial";

if(isset($_POST['Asignar']))
{
    $ID_C=$_POST['ID'];
    $datos['ID_D']=(int)$_POST['ID'];
	$datos['CI']=(int)$ID;
    $datos['Nombre']=$Nombre;
    $datos['Cargo']=$Cargo;
    $sx=$mdi->Insertar($datos);
	header("Location: ../Vista/VD_Investigador.php?ID=$ID_C");		
}

if($_REQUEST['Accion']=="Eliminar")
{
    $ID=(int)$_REQUEST['ID_C'];
    $datos['ID_D']=(int)$_REQUEST['ID'];
    $datos['CI']=(int)$_REQUEST['CI'];
    $sx=$mdi->Eliminar($datos);
    header("Location: ../Vista/VD_Investigador.php?ID=$ID");       
}


 ?>
