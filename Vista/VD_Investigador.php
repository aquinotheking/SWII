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

include_once('../Modelo/MD_Investigador.php');

include_once('../Modelo/MOficial.php');

$mtd=new Tipo_Denuncia();

$mdi=new Detalle_Investigador();

$mo=new Oficial();

if(isset($_REQUEST['ID']))
{
$ID_C=$_REQUEST['ID'];
}

if(isset($_REQUEST['Tipo']))
{
$Tipo=$_REQUEST['Tipo'];
}

$sx=$mdi->Cargar_Detalle($ID_C);

$sy=$mo->Cargar_Oficiales_Inv();

while ($rw=mysql_fetch_array($sy)) {
   $cmbDI.=" <option value='".$rw['CI']."'>".$rw['Cargo']. " - " .$rw['Nombre']."</option>";
 }

 ?>
<div class="container" style="margin-top: -60px;margin-left: 51px;">
<h1 style="margin-top: 0px;">ASIGNACION DE INVESTIGADORES</h1>
<form class="form-horizontal" action="../Controlador/CD_Investigador.php" method="POST" autocomplete="off">
<div class="form-group" style="margin-top:-120px;">
<label class="control-label col-xs-4">Investigadores: </label>
        <div class="col-xs-6">
            <select  class="form-control" name="cmbIA" id="CmbIA">
                    <?php echo "$cmbDI";  ?>
            </select>
        </div>
</div> 
<center>
  <div class="form-group">
        <div class="col-xs-12">
            <input type="submit" class="btn btn-primary btn-lg " name="Asignar" value="Asignar Oficial">
        </div>
    </div>
</center>
<div class="row" style="margin-top: 0px;">
          <table class="table table-striped table-bordered">
            <thead>
              <tr>
                <th style="background:black; color:white; text-align: center;">Numero de Caso</th>
				        <th style="background:black; color:white; text-align: center;">CI</th>
                <th style="background:black; color:white; text-align: center;">Nombre</th>
                <th style="background:black; color:white; text-align: center;">Cargo</th>
                <th style="background:black; color:white; text-align: center;">Acciones</th>
              </tr>
            </thead>
            <tbody>
                  <?php while ($row = mysql_fetch_array($sx)){ ?>
                  <?php echo '<tr>';?>
                        <?php echo '<td style="text-align:center;">'. $row['ID_D'] . '</td>';?>
                        <?php echo '<td style="text-align:center;">'. $row['CI'] . '</td>';?>
                        <?php echo '<td style="text-align:center;">'. $row['Nombre'] . '</td>';?>
                        <?php echo '<td style="text-align:center;">'. $row['Cargo'] . '</td>';?>
                        <?php echo '<td width=250 style="text-align:center;">';?>
                        <?php echo '<a class="btn btn-danger" href="../Controlador/CD_Investigador.php?ID='.$row['ID_D'].'&CI='.$row['CI'].'&Accion=Eliminar&ID_C='.$ID_C.'">Eliminar</a>';?>
                        <?php echo '</td>';?>
                <?php }?>
            </tbody>
          </table>
        </div>
<input type="text" name="ID" id="ID" value="<?php echo $ID_C; ?>" style="display:none;"/>
</center>
</form><p>
<center><a class="btn btn-primary btn-lg" href="VDenuncia.php" style="margin-top: 30px;">Volver</a></center>
  
</center>
 <?php 

include('../footer.php');

 ?>