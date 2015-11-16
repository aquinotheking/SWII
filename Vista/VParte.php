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

include_once("../Modelo/MOficial.php");

include_once("../Modelo/MParte.php");

$mp=new Parte();
  
$md=new Oficial();

$Tipo="Denunciante";

if(isset($_REQUEST['Tipo']))
{
  $Tipo=$_REQUEST['Tipo'];
}

$sx=$mp->Cargar_Parte($Tipo);

 ?>

 <h1 style="margin-top: -60px; text-decoration: bold;">Partes
<center >
   <a href="VParte.php?Tipo=Denunciante" class="btn btn-danger">Denunciantes</a>
   <a href="VParte.php?Tipo=Imputado" class="btn btn-warning">Imputados</a>
   <a href="VParte.php?Tipo=Victima" class="btn btn-success">Victimas</a>
   <a href="VParte.php?Tipo=Testigo" class="btn btn-primary">Testigos</a>
 </center>
 </h1>
 
<div class="row" style="margin-top: -200px;">
          <table class="table table-striped table-bordered" style="margin-top: 80px;">
            <thead>
              <tr>
                <th style="background:black; color:white; text-align: center;">Codigo</th>
                <th style="background:black; color:white; text-align: center;">Nombre</th>
                <th style="background:black; color:white; text-align: center;">CI</th>
                <th style="background:black; color:white; text-align: center;">Telefono</th>
                <th style="background:black; color:white; text-align: center;">Domicilio</th>
                <th style="background:black; color:white; text-align: center;">Nacionalidad</th>
                <th style="background:black; color:white; text-align: center;">Profesion</th>
                <th style="background:black; color:white; text-align: center;">Tipo</th>
                <th style="background:black; color:white; text-align: center;">Acciones</th>
              </tr>
            </thead>
            <tbody>
                  <?php while ($row = mysql_fetch_array($sx)){ ?>
                  <?php echo '<tr>';?>
                        <?php echo '<td style="text-align:center;">'. $row['ID_Parte'] . '</td>';?>
                        <?php echo '<td style="text-align:center;">'. $row['Nombre'] . '</td>';?>
                        <?php echo '<td style="text-align:center;">'. $row['CI'] . '</td>';?>
                        <?php echo '<td style="text-align:center;">'. $row['Telefono'] . '</td>';?>
                        <?php echo '<td style="text-align:center;">'. $row['Domicilio'] . '</td>';?>
                        <?php echo '<td style="text-align:center;">'. $row['Nacionalidad'] . '</td>';?>
                        <?php echo '<td style="text-align:center;">'. $row['Profesion'] . '</td>';?>
                        <?php echo '<td style="text-align:center;">'. $row['Tipo'] . '</td>';?>
                        <?php echo '<td width=250 style="text-align:center;">';?>
                        <?php echo '<a class="btn btn-info" href="../Vista/VM_Parte.php?ID='.$row['ID_Parte'].'"">Modificar</a>';?>
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
            <h4 class="modal-title">Registro  Parte</h4>
          </div>
        <div class="modal-body">
                <div class="span10 offset1">
                <form method="POST" action="../Controlador/C_Parte.php">
                      <label class="control-label">Nombre</label>  
                        <div class="controls">
                            <input name="Nombre" type="text" data-tv-field size="35" style="text-align:center"  class="form-control" placeholder="Nombre" value=""/>
                      </div>
                      <label class="control-label">Fecha de Nacimiento</label>  
                        <div class="controls">
                            <input name="Fecha" type="date" data-tv-field size="35" style="text-align:center"  class="form-control"  value=""/>
                      </div>
                      <label class="control-label">Estado Civil</label>  
                        <div class="controls">
                            <select class="form-control" data-style="btn-primary" name="cmbEst_Civ" style="text-align:center"/>
                                <option value="Soltero">Soltero</option>
                                <option value="Casado">Casado</option>
                                <option value="Viudo">Viudo</option>
                                <option value="Divorciado">Divorciado</option>
                            </select>
                      </div>
                      <label class="control-label">Sexo</label>  
                        <div class="controls">
                            <select class="form-control" data-style="btn-primary" name="cmbSexo" style="text-align:center"/>
                                <option value="Masculino">Masculino</option>
                                <option value="Femenino">Femenino</option>
                            </select>
                      </div>
                      <label class="control-label">CI</label>  
                        <div class="controls">
                            <input name="CI" type="text" data-tv-field size="35" style="text-align:center" class="form-control" placeholder="CI" value=""/>
                      </div>
                        <label class="control-label">Telefono</label>  
                        <div class="controls">
                            <input name="Telefono" type="text" data-tv-field size="35" style="text-align:center"  class="form-control" placeholder="Telefono" value=""/>
                      </div>
                        <label class="control-label">Nacionalidad</label>  
                        <div class="controls">
                            <input name="Nacionalidad" type="text" data-tv-field size="35" style="text-align:center"  class="form-control" placeholder="Nacionalidad" value=""/>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Domicilio</label>
                        <div class="controls">
                            <input name="Domicilio" type="text" data-tv-field size="35" style="text-align:center"  class="form-control" placeholder="Domicilio" value="">
                        </div>
                      <label class="control-label">Profesion</label>  
                        <div class="controls">
                            <input name="Profesion" type="text" data-tv-field size="35" style="text-align:center"  class="form-control" placeholder="Profesion" value=""/>
                      </div>
                      <label class="control-label">Tipo</label>  
                        <div class="controls">
                            <select class="form-control" data-style="btn-primary" name="cmbTipo" style="text-align:center"/>
                                <option value="Denunciante">Denunciante</option>
                                <option value="Imputado">Imputado</option>
                                <option value="Victima">Victima</option>
                                <option value="Testigo">Testigo</option>
                            </select>
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

