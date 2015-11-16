/** 
*
* @Control de presentación de AYCSOFT. "VD_Denunciante.php"
* @versión: 1.5      @modificado: 25 de Septiembre del 2015
* @autor: Aquino
*
*/


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

include('../header.php');

include_once('../Modelo/MTipo_D.php');

include_once('../Modelo/MD_Partes.php');

$mtd=new Tipo_Denuncia();

$mdp=new Detalle_Partes();


if(isset($_REQUEST['ID']))
{
$ID_C=$_REQUEST['ID'];
}

if(isset($_REQUEST['Tipo']))
{
$Tipo=$_REQUEST['Tipo'];
}

$sx=$mdp->Cargar_Detalle($Tipo,$ID_C);

 ?>


<style type="text/css">
#caja_busqueda /*estilos para la caja principal de busqueda*/
{
margin-bottom: 200px;
width:400px;
height:25px;
border:solid 2px #979DAE;
font-size:16px;
}
#display /*estilos para la caja principal en donde se puestran los resultados de la busqueda en forma de lista*/
{
width:400px;
display:none;
overflow:hidden;
border: solid 1px #666;
}
.display_box /*estilos para cada caja unitaria de cada usuario que se muestra*/
{
font-size:18px;
height:63px;
text-decoration:none;
color:white; 
}

.display_box:hover /*estilos para cada caja unitaria de cada usuario que se muestra. cuando el mause se pocisiona sobre el area*/
{
background: black;
color: #FFF;
}
.desc
{
color:white;
font-size:16;
}
.desc:hover
{
color:#FFF;
}

/* Easy Tooltip */
</style>
<script language="JavaScript" src="../js/jquery-1.5.1.min.js"></script>
<script language="JavaScript" src="../js/jquery.watermarkinput.js"></script>

<script type="text/javascript">
$(document).ready(function(){

$(".busca").keyup(function() //se crea la funcioin keyup
{
var texto = $(this).val();//se recupera el valor de la caja de texto y se guarda en la variable texto
var Tipo=document.getElementById("Tip").value;
var ID=document.getElementById("ID").value;
var palabra = texto;//se guarda en una variable nueva para posteriormente pasarla a search.php
var Tipo=Tipo;

if(texto=='')//si no tiene ningun valor la caja de texto no realiza ninguna accion
{

}
else
{
$.ajax({//metodo ajax
type: "POST",//aqui puede  ser get o post
url: "../partials/search.php",//la url adonde se va a mandar la cadena a buscar
data: {palabra,Tipo,ID},
cache: false,
success: function(html)//funcion que se activa al recibir un dato
{
$("#display").html(html).show();// funcion jquery que muestra el div con identificador display, como formato html, tambien puede ser .text
}

});
}return false;    
});
});
jQuery(function($){//funcion jquery que muestra el mensaje "Buscar amigos..." en la caja de texto
   $("#caja_busqueda").Watermark("CI o Nombre");
   });
</script>
<input type="text" name="Tip" id="Tip" value="<?php echo "$Tipo"; ?>" style="display:none;"/>
<input type="text" name="ID" id="ID" value="<?php echo "$ID_C"; ?>" style="display:none;"/>
<form action="VD_Denunciante.php" method="POST" autocomplete="off">
<center>
<h1 style="margin-top: -60px;"><?php echo "$Tipo"; ?></h1>
 <div style=" width:350px; height:300px; margin-top: -130px; " >
  <input type="text" class="busca" id="caja_busqueda" name="clave" /><br />
  <div id="display" style="margin-top: -200px;"></div>
</div> 
<div class="row" style="margin-top: -200px;">
          <table class="table table-striped table-bordered">
            <thead>
              <tr>
                <th style="background:black; color:white; text-align: center;">Numero de Caso</th>
				<th style="background:black; color:white; text-align: center;">CI</th>
                <th style="background:black; color:white; text-align: center;">Nombre</th>
                <th style="background:black; color:white; text-align: center;">Domicilio</th>
                <th style="background:black; color:white; text-align: center;">Telefono</th>
                <th style="background:black; color:white; text-align: center;">Acciones</th>
              </tr>
            </thead>
            <tbody>
                  <?php while ($row = mysql_fetch_array($sx))
                  	{ ?>
                  <?php echo '<tr>';?>
                        <?php echo '<td style="text-align:center;">'. $row['ID_Caso'] . '</td>';?>
                        <?php echo '<td style="text-align:center;">'. $row['CI'] . '</td>';?>
                        <?php echo '<td style="text-align:center;">'. $row['Nombre'] . '</td>';?>
                        <?php echo '<td style="text-align:center;">'. $row['Domicilio'] . '</td>';?>
                        <?php echo '<td style="text-align:center;">'. $row['Telefono'] . '</td>';?>
                        <?php echo '<td width=250 style="text-align:center;">';?>
                        <?php echo '<a class="btn btn-danger" href="../Controlador/CD_Partes.php?ID='.$row['ID_Caso'].'&ID_P='.$row['ID_Parte'].'&Tipo='.$row['Tipo'].'&Accion=Eliminar">Eliminar</a>';?>
                        <?php echo '</td>';?>
                <?php }?>
            </tbody>
          </table>
          <center><a class="btn btn-primary btn-lg" href="VDenuncia.php" style="margin-top: 30px;">Volver</a></center>
        </div>

</center>
</form>

<script type="text/javascript">
	$('#caja_busqueda').click(function() {
    
        $('#display').hide();
});

</script>


 <?php 

include('../footer.php');

 ?>