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

require("../Modelo/MDP.php");
  
$md=new Distrito_Policial();

$sx=$md->Cargar_Distrito_Policial();


 ?>

 <h1 style="margin-top: -60px;">DISTRITO POLICIAL</h1>
<div class="row" style="margin-top: -90px;">
          <table class="table table-striped table-bordered">
            <thead>
              <tr>
                <th style="background:black; color:white; text-align: center;">Codigo</th>
                <th style="background:black; color:white; text-align: center;">Nombre</th>
                <th style="background:black; color:white; text-align: center;">Direccion</th>
                <th style="background:black; color:white; text-align: center;">Telefono</th>
                <th style="background:black; color:white; text-align: center;">Acciones</th>
              </tr>
            </thead>
            <tbody>
                  <?php while ($row = mysql_fetch_array($sx)){ ?>
                  <?php echo '<tr>';?>
                        <?php echo '<td style="text-align:center;">'. $row['ID_DP'] . '</td>';?>
                        <?php echo '<td style="text-align:center;">'. $row['Nombre'] . '</td>';?>
                        <?php echo '<td style="text-align:center;">'. $row['Direccion'] . '</td>';?>
                        <?php echo '<td style="text-align:center;">'. $row['Telefono'] . '</td>';?>
                        <?php echo '<td width=250 style="text-align:center;">';?>
                        <?php echo '<a class="btn btn-success" href="../Vista/VM_DP.php?ID='.$row['ID_DP'].'"">Modificar</a> ';?>
                        <?php echo '<a class="btn btn-danger" href="../Vista/VE_DP.php?ID='.$row['ID_DP'].'">Eliminar</a>';?>
                        <?php echo '</td>';?>
                <?php }?>
            </tbody>
          </table>
            <center>
                <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#Registrar" >Registrar</button>
            </center>

        </div>

        <!-- Trigger the modal with a button -->
  
  <!-- Modal -->
  <div class="modal fade" data-keyboard="false" data-backdrop="static" id="Registrar" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
          <div class="modal-header" style="background: black; color: white;">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Registro Distrito Policial</h4>
          </div>
        <div class="modal-body">
                <div class="span10 offset1">
                <form method="POST" action="../Controlador/C_DP.php">
                      <div class="control-group <?php echo !empty($nameError)?'error':'';?>"   
                          <label for="recipient-name"  class="control-label">Nombre</label>
                        <div class="controls">
                            <input name="Nombre" type="text" data-tv-field size="35" style="text-align:center"  class="form-control" placeholder="Nombre" value="<?php echo !empty($name)?$name:'';?>">
                            <?php if (!empty($nameError)): ?>
                                <span class="help-inline"><?php echo $nameError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($descriptionError)?'error':'';?>">
                        <label class="control-label">Direccion</label>
                        <div class="controls">
                            <input name="Direccion" type="text" data-tv-field size="35" style="text-align:center"  class="form-control" placeholder="Direccion" value="<?php echo !empty($name)?$name:'';?>">
                            <?php if (!empty($descriptionError)): ?>
                            <span class="help-inline"><?php echo $descriptionError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($descriptionError)?'error':'';?>">
                        <label class="control-label">Telefono</label>
                        <div class="controls">
                            <input name="Telefono" type="text" data-tv-field size="35" style="text-align:center"  class="form-control" placeholder="Telefono" value="">
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
