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

include_once("../Modelo/M_Delincuente.php");

$md=new Delincuente();

$sx=$md->Cargar_Delincuentes();


 ?>

 <h1 style="margin-top: -60px;">DELINCUENTES</h1>
<div class="row" style="margin-top: -200px;">
          <table class="table table-striped table-bordered" style="margin-top: 80px;">
            <thead>
              <tr>
                <th style="background:black; color:white; text-align: center;">ID</th>
                <th style="background:black; color:white; text-align: center;">Nombre</th>
                <th style="background:black; color:white; text-align: center;">CI</th>
                <th style="background:black; color:white; text-align: center;">Alias</th>
                <th style="background:black; color:white; text-align: center;">Sexo</th>
                <th style="background:black; color:white; text-align: center;">Estado Civil</th>
                <th style="background:black; color:white; text-align: center;">Fecha</th>
                <th style="background:black; color:white; text-align: center;">Acciones</th>
              </tr>
            </thead>
            <tbody>
                  <?php while ($row = mysql_fetch_array($sx)){  
                    ?>

                  <?php echo '<tr>';?>
                        <?php echo '<td style="text-align:center;">'. $row['ID_Delincuente'] . '</td>';?>
                        <?php echo '<td style="text-align:center;">'. $row['Nombre'] . '</td>';?>
                        <?php echo '<td style="text-align:center;">'. $row['CI'] . '</td>';?>
                        <?php echo '<td style="text-align:center;">'. $row['Alias'] . '</td>';?>
                        <?php echo '<td style="text-align:center;">'. $row['Sexo'] . '</td>';?>
                        <?php echo '<td style="text-align:center;">'. $row['EC'] . '</td>';?>
                        <?php echo '<td style="text-align:center;">'. $row['Fecha'] . '</td>';?>
                        <?php echo '<td width=250 style="text-align:center;">';?>
                        <?php echo '<a class="btn btn-success" href="../Vista/VM_Delincuente.php?ID='.$row['ID_Delincuente'].'"">Modificar</a>';?>
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
            <h4 class="modal-title">Registro Delincuente</h4>
          </div>
        <div class="modal-body">
                <div class="span10 offset1">
                <form method="POST" action="../Controlador/C_Delincuente.php">
                      <div class="control-group"> 
                      <label class="control-label">CI</label>  
                        <div class="controls">
                            <input name="CI" type="text" data-tv-field size="35" style="text-align:center"  class="form-control" placeholder="CI" value=""/>
                      </div>
                      <label class="control-label">Nombre</label>  
                        <div class="controls">
                            <input name="Nombre" type="text" data-tv-field size="35" style="text-align:center"  class="form-control" placeholder="Nombre" value=""/>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Alias</label>
                        <div class="controls">
                            <input name="Alias" type="text" data-tv-field size="35" style="text-align:center"  class="form-control" placeholder="Alias" value="">
                        </div>
                      <label class="control-label">Sexo</label>  
                        <div class="controls">
                            <select class="form-control" data-style="btn-primary" name="cmb_Sexo" style="text-align:center"/>
                                <option value="Masculino">Masculino</option>
                                <option value="Femenino">Femenino</option>
                            </select>
                      </div>
                      <label class="control-label">Estado Civil</label>  
                        <div class="controls">
                            <select class="form-control" data-style="btn-primary" name="cmbEstado_Civil" style="text-align:center"/>
                                <option value="Soltero">Soltero</option>
                                <option value="Casado">Casado</option>
                                <option value="Viudo">Viudo</option>
                                <option value="Divorciado">Divorciado</option>
                            </select>
                      </div>
                        <label class="control-label">Fecha Nacimiento</label>  
                        <div class="controls">
                            <input name="Fecha" type="date" data-tv-field size="35" style="text-align:center"  class="form-control" placeholder="" value=""/>
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

