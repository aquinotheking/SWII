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

require("../Modelo/MTipo_P.php");
  
$md=new Tipo_Persona();

$sx=$md->Cargar_Tipo_P();


 ?>

 <h1 style="margin-top: -60px;">TIPO DE PARTE</h1>
<div class="row" style="margin-top: -90px;">
          <table class="table table-striped table-bordered">
            <thead>
              <tr>
                <th style="background:black; color:white; text-align: center;">Codigo</th>
                <th style="background:black; color:white; text-align: center;">Nombre</th>
                <th style="background:black; color:white; text-align: center;">Descripcion</th>
                <th style="background:black; color:white; text-align: center;">Acciones</th>
              </tr>
            </thead>
            <tbody>
                  <?php while ($row = mysql_fetch_array($sx)){ ?>
                  <?php echo '<tr>';?>
                        <?php echo '<td style="text-align:center;">'. $row['ID_TP'] . '</td>';?>
                        <?php echo '<td style="text-align:center;">'. $row['Nombre'] . '</td>';?>
                        <?php echo '<td style="text-align:center;">'. $row['Descripcion'] . '</td>';?>
                        <?php echo '<td width=250 style="text-align:center;">';?>
                        <?php echo '<a class="btn btn-success" href="../Vista/VMTipo_P.php?ID='.$row['ID_TP'].'"">Modificar</a> ';?>
                        <?php echo '<a class="btn btn-danger" href="../Vista/VETipo_P.php?ID='.$row['ID_TP'].'">Eliminar</a>';?>
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
  <div class="modal fade" data-keyboard="false" data-backdrop="static"id="myModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
          <div class="modal-header" style="background: black; color: white;">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Registro Tipo de Parte</h4>
          </div>
        <div class="modal-body">
                <div class="span10 offset1">
                <form method="POST" action="../Controlador/CTipo_P.php">
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
                        <label class="control-label">Descripcion</label>
                        <div class="controls">
                            <input name="Descripcion" type="text" data-tv-field size="35" style="text-align:center"  class="form-control" placeholder="Descripcion" value="<?php echo !empty($name)?$name:'';?>">
                            <?php if (!empty($descriptionError)): ?>
                            <span class="help-inline"><?php echo $descriptionError;?></span>
                            <?php endif;?>
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

