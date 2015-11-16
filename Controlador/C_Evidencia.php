<?php 

include_once('../Modelo/MEvidencia.php');

include_once('../Modelo/MDenuncia.php');

$me=new Evidencia();

$md=new Denuncia();

date_default_timezone_set("America/Asuncion");
$fecha=date("Y/m/d");
$hora=date("h:i:s");
$ac="Eliminar Grado Policial";
$ruta="Evidencia";


if(isset($_POST['Registrar']))
{
    $ruta_temporal=$_FILES['file']['tmp_name'];
    $nombre_imagen=$_FILES['file']['name'];
    $ruta_destino="../".$ruta."/".$nombre_imagen;

	$datos['ID_Caso']=(int)$_POST['N_Caso'];
    $datos['CI']=(int)$_POST['CI_O'];
    $datos['Fecha']=$_POST['Fecha_E'];
    $datos['Descripcion']=$_POST['Descripcion'];
    $datos['Imagen']=$ruta_destino;
    if(move_uploaded_file($ruta_temporal,$ruta_destino))
    {
        $sx=$me->Insertar_E($datos);
        header("Location: ../Vista/V_Evidencias.php");		
    }
    else
    {
        echo "No se pudo Insertar";
    }
}

if(isset($_REQUEST['Accion']))
{
    $ID=$_REQUEST['ID'];
    $sx=$md->Terminar_Caso($ID);
    header("Location: ../Vista/V_Evidencias.php");  
}
else
{
    header("Location: ../Vista/V_Evidencias.php");  
}


 ?>
