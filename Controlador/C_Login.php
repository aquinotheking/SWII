<?php 

include_once('../Modelo/MOficial.php');

include_once('../Modelo/MBitacora.php');

include_once("../Modelo/MTipo_O.php");

$md=new Oficial();

$bi=new Bitacora();

$mt=new Tipo_Oficial();


date_default_timezone_set("America/Asuncion");
$fecha=date("Y/m/d");
$hora=date("h:i:s");
$ac="Ingreso Al Sistema";

if(isset($_POST['Ingresar']))
{
    $datos['CI']=$_POST['CI'];

    $datos['Pass']=$_POST['PW'];

    $cx=$md->Verificar_Login($datos);

    $cf=mysql_num_rows($cx);

    if($cf>0)
    {
        $sx=$md->Elegir_Oficial($_POST['CI']);
        while ($row = mysql_fetch_array($sx)){ 
            $CI=$row['CI'];
            $Nombre=$row['Nombre'];
        }

        session_start();
        $_SESSION["autentificado"]="SI";
        $_SESSION["ultimoAcceso"]= $hora;
        $_SESSION["CI"]= $CI;
        $_SESSION["Nombre"]= $Nombre;
        header("Location: ../Vista/VOficial.php");
    }
    else
    {
        echo'<script language="javascript">alert("Datos Incorrectos Verifique sus Datos"); window.location="../index.html";</script>'; 
    }
}

if(isset($_POST['Recuperar']))
{   
    $datos['CI']=$_POST['Correo'];
    list($Pass,$Correo)=$md->Verificar_CI($datos);

$para      = $Correo;
$titulo    = 'Recuperacion de Contraseña';
$mensaje   = "Mensaje de Recuperacion de correo su contraseña es $Pass ";
$cabeceras = 'From: aquino@aycsoft.com' . "\r\n" .
    'Reply-To: aquino@aycsoft.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

$vr=mail($para, $titulo, $mensaje, $cabeceras);

if($vr)
{
    header("Location: ../index.html");
}
else
{
    echo "No se pudo enviar el Correo";
}
}

 ?>
