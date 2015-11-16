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


require('../header.php');;

include_once("../Modelo/MProntuario_Delictivo.php");

include_once("../Modelo/M_Delincuente.php");

include_once("../Modelo/MOficial.php");

$mpd=new Prontuario_Delictivo();

$mo=new Oficial();

$md=new Delincuente();

$sx=$mpd->Cargar_Prontuarios();

$sy=$mo->Cargar_Oficiales();

$sz=$md->Cargar_Delincuentes();
date_default_timezone_set("America/Asuncion");
$fecha=date("d/m/Y");
$hora=date("h:i:s");

while ($row=mysql_fetch_array($sy)) {
    $cmoficial.=" <option value='".$row['CI']."'>".$row['Nombre']."</option>";
  }

while ($row=mysql_fetch_array($sz)) {
    $cmdelincuente.=" <option value='".$row['ID_Delincuente']."'>".$row['Nombre']."</option>";
  }

 ?>

 <h1 style="margin-top: -60px;">Prontuarios Delictivos</h1>
<div class="row" style="margin-top: -200px;">
          <table class="table table-striped table-bordered" style="margin-top: 80px;">
            <thead>
              <tr>
                <th style="background:black; color:white; text-align: center;">ID</th>
                <th style="background:black; color:white; text-align: center;">Delincuente</th>
                <th style="background:black; color:white; text-align: center;">CI Oficial</th>
                <th style="background:black; color:white; text-align: center;">Nombre Oficial</th>
                <th style="background:black; color:white; text-align: center;">Fecha</th>
                <th style="background:black; color:white; text-align: center;">Acciones</th>
              </tr>
            </thead>
            <tbody>
                  <?php while ($row = mysql_fetch_array($sx)){  

                    $ca=$md->Elegir_Delincuente($row['ID_D']);

                    $co=$mo->Modificar_O($row['ID_O']);

                    while ($ra=mysql_fetch_array($ca)) {
                      $Alias_D=$ra[3];
                      }
                    while ($ro=mysql_fetch_array($co)) {
                      $Nombre_O=$ro[0];
                      } 
                    ?>

                  <?php echo '<tr>';?>
                        <?php echo '<td style="text-align:center;">'. $row['ID_D'] . '</td>';?>
                        <?php echo '<td style="text-align:center;">'. $Alias_D . '</td>';?>
                        <?php echo '<td style="text-align:center;">'. $row['ID_O'] . '</td>';?>
                        <?php echo '<td style="text-align:center;">'. $Nombre_O . '</td>';?>
                        <?php echo '<td style="text-align:center;">'. $row['Fecha'] . '</td>';?>
                        <?php echo '<td width=250 style="text-align:center;">';?>
                        <?php echo '<a class="btn btn-success" href="../Vista/V_Ficha_Prontuario.php?ID_D='.$row['ID_D'].'&Alias='.$Alias_D.'&ID='.$row['ID_Prontuario'].'"">Agregar</a>';?>
                        <?php echo '<a class="btn btn-primary" href="../Vista/VV_Prontuario_Delictivo.php?Alias='.$Alias_D.'&Descripcion='.$row['Descripcion'].'&CI='.$row['ID_O'].'&Fecha='.$row['Fecha'].'&ID='.$row['ID_D'].'"">Ver</a>';?>
                        <?php echo '</td>';?>
                <?php }?>
            </tbody>
          </table>
            <center>
                <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal" >Registrar</button>
            </center>

        </div>

        <!-- Trigger the modal with a button -->
  
  <!-- Modal -->
  <div class="modal fade" data-keyboard="false" data-backdrop="static" id="myModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
          <div class="modal-header" style="background: black; color: white;">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Registro Nuevo Prontuario</h4>
          </div>
        <div class="modal-body">
                <div class="span10 offset1">
                <form method="POST" action="../Controlador/C_Prontuario_Delictivo.php">
                      <div class="control-group"> 
                      <label class="control-label">Delincuente</label>  
                        <div class="controls">
                            <select class="form-control" data-style="btn-primary" name="cmb_Delincuente" style="text-align:center"/>
                                <?php 
                                    echo $cmdelincuente;
                                 ?>
                            </select>
                      </div>
                      <label class="control-label">Oficial</label>  
                        <div class="controls">
                            <select class="form-control" data-style="btn-primary" name="cmb_Oficial" style="text-align:center"/>
                                <?php 
                                    echo $cmoficial;
                                 ?>
                            </select>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Fecha</label>
                        <div class="controls">
                            <input name="Fecha" type="text" data-tv-field size="35" style="text-align:center"  class="form-control" placeholder="" value="<?php echo "$fecha"; ?>">
                        </div>
                      <label class="control-label">Descripcion</label>  
                        <div class="controls">
                            <textarea rows="3" class="form-control" name="Descripcion" placeholder="Descripcion del Hecho" style="resize: none;"></textarea>
                      </div>
                      </div>
                      <div class="form-actions">
                      </div>
                </div>
  <!-- /container -->
        </div>
        <div class="modal-footer">
        <button type="submit" class="btn btn-success" name="Registrar" style="float: left;">Registrar</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
      </form>
    </div>
  </div>

<?php 

require('../footer.php')

 ?>

