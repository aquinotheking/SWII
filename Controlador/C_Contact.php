<?php 

$Nombre=$_POST['Nombre'];
$Correo=$_POST['Correo'];
$Mensaje=$_POST['Mensaje'];

$destinatario="aquino@aycsoft.webuda.com";

$para      = $destinatario;
$titulo    = 'Solicitud de Atencion';
$mensaje   = "El Usuario $Nombre solicita la ayuda en lo cual nos expresa su problema el cual es: $Mensaje";
$cabeceras = "From: $Correo" . "\r\n" .
    'Reply-To: FELCC@aycsoft.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

$vr=mail($para, $titulo, $mensaje, $cabeceras);

if($vr)
{
    header("Location: ../Vista/VContact.php");
}
else
{
    echo "No se pudo enviar el Correo";
}

 ?>