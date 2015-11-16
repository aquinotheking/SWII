<?php

session_start();

date_default_timezone_set("America/Asuncion");
$fecha=date("Y/m/d");
$hora=date("h:i:s");

if ($_SESSION["autentificado"] != "SI") { 
    //si no está logueado lo envío a la página de autentificación 
    header("Location: ../index.html"); 
} else { 
    //sino, calculamos el tiempo transcurrido 
    $fechaGuardada = $_SESSION["ultimoAcceso"]; 
    $ahora = $hora; 
    $tiempo_transcurrido = (strtotime($ahora)-strtotime($fechaGuardada)); 
    //comparamos el tiempo transcurrido 
     if($tiempo_transcurrido >= 600) { 
     //si pasaron 10 minutos o más 
      session_destroy(); // destruyo la sesión 
      header("Location: ../index.html"); //envío al usuario a la pag. de autenticación 
      //sino, actualizo la fecha de la sesión 
    }else { 
    $_SESSION["ultimoAcceso"] = $ahora; 
   } 
} 


require "../partials/fpdf.php";

require("../Modelo/MDenuncia.php");

require("../Modelo/MOficial.php");

require("../Modelo/MD_Partes.php");

require("../Modelo/MD_Investigador.php");

date_default_timezone_set("America/Asuncion");
$fecha=date("Y/m/d");
$hora=date("h:i:s");

$ID=$_REQUEST['ID'];

$Denunciante="Denunciante";$Imputado="Imputado";$Testigo="Testigo";$Victima="Victima";
  
$md=new Denuncia();

$mo=new Oficial();

$mdp=new Detalle_Partes();

$mdi=new Detalle_Investigador();

$sx=$md->Cargar_Denuncias($ID);

while ($row = mysql_fetch_array($sx)){
    $ID_C=$row['ID_D'];
    $Fecha=$row['FH'];
    $CI_Servicio=$row['CI_S'];
    $Tipo=$row['TD'];
    $CI_Investigador=$row['CI_I'];
    $Lugar=$row['Lugar'];
    $Descripcion=$row['Descripcion'];
    $Estado=$row['Estado'];
}

$sy=$mo->Modificar_O($CI_Servicio);

while ($row = mysql_fetch_array($sy)){
    $Nombre_Serv=$row['Nombre'];
}

$sz=$mo->Modificar_O($CI_Investigador);

while ($row = mysql_fetch_array($sz)){
    $Nombre_Inv=$row['Nombre'];
}

$sa=$mdp->Cargar_Detalle($Denunciante,$ID);
$sb=$mdp->Cargar_Detalle($Imputado,$ID);
$sc=$mdp->Cargar_Detalle($Victima,$ID);
$sd=$mdp->Cargar_Detalle($Testigo,$ID);

$sf=$mdi->Cargar_Detalle($ID);
class PDF extends FPDF
{
    function Header()
    {
      $this->SetFont('Helvetica','B',15);
      $this->Cell(0,10,'ACTA DE DENUNCIA',0,1,'C');
      $this->Cell(0,5,'Fuerza Especial de Lucha Contra el Crimen',0,1,'C');
     }

    function Footer()
    {
      $this->SetY(-15);
      $this->SetFont('Helvetica','I',10);
      //$this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
    }

}

$pdf=new PDF('P','mm','A4');
$pdf->SetMargins(25,20);
$pdf->AliasNbPages();
$pdf->AddPage();

//Datos del Titulo
$pdf->SetAuthor('Aquino Romero Ramiro');
$pdf->SetTitle('2 Parcial');
$pdf->SetTextColor(0x00,0x00,0x00);
$pdf->SetFont("Arial","",9);
//$pdf->SetFontTitle("Arial","b",15);
//$pdf->Cell(0,5,'REPORTE DE '."$u",0,1,'C');
$pdf->Image('../img/escudo.png',10,8,33);
$pdf->Image('../img/escudo.png',170,8,33);


//Se muestra la tabla

$pdf->Ln();

$pdf->SetFont("Arial","B",9);
$pdf->Cell(40,10,"Caso N*",0,'C');
$pdf->SetFont("Arial","",9);
$pdf->Cell(40,10,"$ID_C",0,'C');
$pdf->SetFont("Arial","B",9);
$pdf->Cell(40,10,"Fecha de la Denuncia",0,'C');
$pdf->SetFont("Arial","",9);
$pdf->Cell(40,10,"$Fecha",0,1,'C');

$pdf->SetFont("Arial","B",9);
$pdf->Cell(40,10,"Registrado por:",0,'C');
$pdf->SetFont("Arial","",9);
$pdf->Cell(40,10,"$Nombre_Serv",0,'C');
$pdf->SetFont("Arial","B",9);
$pdf->Cell(40,10,"Tipo de Delito:",0,'C');
$pdf->SetFont("Arial","",9);
$pdf->Cell(40,10,"$Tipo",0,1,'C');
$pdf->SetFont("Arial","B",9);
$pdf->Cell(40,10,"Lugar del Hecho:",0,'C');
$pdf->SetFont("Arial","",9);
$pdf->Cell(40,10,"$Lugar",0,1,'C');
$pdf->SetFont("Arial","B",9);
$pdf->Cell(36,10,"Descripcion del Hecho:",0,1,'C');
$pdf->SetFont("Arial","",9);
$pdf->Cell(145,10,"$Descripcion",0,1,'C');

$pdf->SetFont("Arial","B",9);
$pdf->Cell(12,10,"Partes:",0,1,'C');

$pdf->SetFont("Arial","B",10);
$pdf->Cell(23,5,"Denunciate(s):",0,1,'C');

$pdf->Cell(60,5,"Nombre",1,0,'C');
$pdf->Cell(20,5,"CI",1,0,'C');
$pdf->Cell(30,5,"Telefono",1,0,'C');
$pdf->Cell(60,5,"Domicilio",1,1,'C');

while ($row = mysql_fetch_array($sa)){
    $Nombre_D=$row['Nombre'];
    $CI_D=$row['CI'];
    $Telefono_D=$row['Telefono'];
    $Domicilio_D=$row['Domicilio'];

    $pdf->SetFont("Arial","",9);
    $pdf->Cell(60,5,$Nombre_D,1,0,'C');
    $pdf->Cell(20,5,$CI_D,1,0,'C');
    $pdf->Cell(30,5,$Telefono_D,1,0,'C');
    $pdf->Cell(60,5,$Domicilio_D,1,1,'C');
}

$pdf->SetFont("Arial","B",10);
$pdf->Cell(20,10,"Imputado(s):",0,1,'C');

$pdf->Cell(60,5,"Nombre",1,0,'C');
$pdf->Cell(20,5,"CI",1,0,'C');
$pdf->Cell(30,5,"Telefono",1,0,'C');
$pdf->Cell(60,5,"Domicilio",1,1,'C');

while ($row = mysql_fetch_array($sb)){
    $Nombre_I=$row['Nombre'];
    $CI_I=$row['CI'];
    $Telefono_I=$row['Telefono'];
    $Domicilio_I=$row['Domicilio'];

    $pdf->SetFont("Arial","",9);
    $pdf->Cell(60,5,$Nombre_I,1,0,'C');
    $pdf->Cell(20,5,$CI_I,1,0,'C');
    $pdf->Cell(30,5,$Telefono_I,1,0,'C');
    $pdf->Cell(60,5,$Domicilio_I,1,1,'C');
}

$pdf->SetFont("Arial","B",10);
$pdf->Cell(15,10,"Victima(s):",0,1,'C');

$pdf->Cell(60,5,"Nombre",1,0,'C');
$pdf->Cell(20,5,"CI",1,0,'C');
$pdf->Cell(30,5,"Telefono",1,0,'C');
$pdf->Cell(60,5,"Domicilio",1,1,'C');

while ($row = mysql_fetch_array($sc)){
    $Nombre_V=$row['Nombre'];
    $CI_V=$row['CI'];
    $Telefono_V=$row['Telefono'];
    $Domicilio_V=$row['Domicilio'];

    $pdf->SetFont("Arial","",9);
    $pdf->Cell(60,5,$Nombre_V,1,0,'C');
    $pdf->Cell(20,5,$CI_V,1,0,'C');
    $pdf->Cell(30,5,$Telefono_V,1,0,'C');
    $pdf->Cell(60,5,$Domicilio_V,1,1,'C');    
}

$pdf->SetFont("Arial","B",10);
$pdf->Cell(15,10,"Testigo(s):",0,1,'C');

$pdf->Cell(60,5,"Nombre",1,0,'C');
$pdf->Cell(20,5,"CI",1,0,'C');
$pdf->Cell(30,5,"Telefono",1,0,'C');
$pdf->Cell(60,5,"Domicilio",1,1,'C');

while ($row = mysql_fetch_array($sd)){
    $Nombre_T=$row['Nombre'];
    $CI_T=$row['CI'];
    $Telefono_T=$row['Telefono'];
    $Domicilio_T=$row['Domicilio'];

    $pdf->SetFont("Arial","",9);
    $pdf->Cell(60,5,$Nombre_T,1,0,'C');
    $pdf->Cell(20,5,$CI_T,1,0,'C');
    $pdf->Cell(30,5,$Telefono_T,1,0,'C');
    $pdf->Cell(60,5,$Domicilio_T,1,1,'C'); 
}

$pdf->SetFont("Arial","B",10);
$pdf->Cell(35,10,"Ofical(es) Asignado(s):",0,1,'C');

$pdf->Cell(30,5,"CI",1,0,'C');
$pdf->Cell(60,5,"Nombre",1,0,'C');
$pdf->Cell(30,5,"Grado",1,1,'C');

while ($row = mysql_fetch_array($sf)){
    $Nombre_I=$row['Nombre'];
    $CI_I=$row['CI'];
    $Cargo_I=$row['Cargo'];

    $pdf->SetFont("Arial","",9);
    $pdf->Cell(30,5,$CI_I,1,0,'C');
    $pdf->Cell(60,5,$Nombre_I,1,0,'C');
    $pdf->Cell(30,5,$Cargo_I,1,1,'C');
}

$pdf->SetFont("Arial","B",9);
$pdf->Cell(40,10,"Fecha de Emision:",0,'C');
$pdf->SetFont("Arial","",9);
$pdf->Cell(40,10,"$fecha",0,'C');
$pdf->SetFont("Arial","B",9);
$pdf->Cell(40,10,"Hora de Emision:",0,'C');
$pdf->SetFont("Arial","",9);
$pdf->Cell(40,10,"$hora",0,1,'C');

//Salida del Archivo y del Reporte *D Para descargar en el navegador

$pdf->OutPut('Usuarios.pdf',"I");

?>  
