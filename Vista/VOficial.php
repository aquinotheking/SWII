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

include_once("../Modelo/MGrado.php");

include_once("../Modelo/MTipo_O.php");

$mg=new Grado();

$mt=new Tipo_Oficial();
  
$md=new Oficial();

$sx=$md->Cargar_Oficiales();

$sy=$mg->Elegir_Grado();

$sz=$mt->Elegir_Tipo_O();

while ($row=mysql_fetch_array($sy)) {
    $cmgrado.=" <option value='".$row['Nombre']."'>".$row['Nombre']."</option>";
  }

while ($row=mysql_fetch_array($sz)) {
    $cmtipo.=" <option value='".$row['ID_Tipo_O']."'>".$row['Nombre']."</option>";
  }

 ?>

 <h1 style="margin-top: -60px;">OFICIALES POLICIALES</h1>
<div class="row" style="margin-top: -200px;">
          <table class="table table-striped table-bordered" style="margin-top: 80px;">
            <thead>
              <tr>
                <th style="background:black; color:white; text-align: center;">CI</th>
                <th style="background:black; color:white; text-align: center;">Nombre</th>
                <th style="background:black; color:white; text-align: center;">Direccion</th>
                <th style="background:black; color:white; text-align: center;">Telefono</th>
                <th style="background:black; color:white; text-align: center;">Correo</th>
                <th style="background:black; color:white; text-align: center;">Grado</th>
                <th style="background:black; color:white; text-align: center;">Tipo</th>
                <th style="background:black; color:white; text-align: center;">Acciones</th>
              </tr>
            </thead>
            <tbody>
                  <?php while ($row = mysql_fetch_array($sx)){ 
                      
                      $cs=$mt->Elegir_Tipo_ID($row['Tipo']);

                    while ($r=mysql_fetch_array($cs)) {
                      $nto=$r[0];
                      } 
                    ?>

                  <?php echo '<tr>';?>
                        <?php echo '<td style="text-align:center;">'. $row['CI'] . '</td>';?>
                        <?php echo '<td style="text-align:center;">'. $row['Nombre'] . '</td>';?>
                        <?php echo '<td style="text-align:center;">'. $row['Direccion'] . '</td>';?>
                        <?php echo '<td style="text-align:center;">'. $row['Telefono'] . '</td>';?>
                        <?php echo '<td style="text-align:center;">'. $row['Correo'] . '</td>';?>
                        <?php echo '<td style="text-align:center;">'. $row['Cargo'] . '</td>';?>
                        <?php echo '<td style="text-align:center;">'. $nto. '</td>';?>
                        <?php echo '<td width=250 style="text-align:center;">';?>
                        <?php echo '<a class="btn btn-success" href="../Vista/VM_Oficial.php?ID='.$row['CI'].'"">Modificar</a>';?>
                        <?php echo '<a class="btn btn-danger" href="../Vista/VE_Oficial.php?ID='.$row['CI'].'">Eliminar</a>';?>
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
            <h4 class="modal-title">Registro  Oficial</h4>
          </div>
        <div class="modal-body">
                <div class="span10 offset1">
                <form method="POST" action="../Controlador/C_Oficial.php">
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
                        <label class="control-label">Direccion</label>
                        <div class="controls">
                            <input name="Direccion" type="text" data-tv-field size="35" style="text-align:center"  class="form-control" placeholder="Direccion" value="">
                        </div>
                        <label class="control-label">Telefono</label>  
                        <div class="controls">
                            <input name="Telefono" type="text" data-tv-field size="35" style="text-align:center"  class="form-control" placeholder="Telefono" value=""/>
                      </div>
                      <label class="control-label">Correo</label>  
                        <div class="controls">
                            <input name="Correo" type="text" data-tv-field size="35" style="text-align:center" class="form-control" placeholder="Correo" value=""/>
                      </div>
                      <label class="control-label">Sexo</label>  
                        <div class="controls">
                            <select class="form-control" data-style="btn-primary" name="cmbSexo" style="text-align:center"/>
                                <option value="Masculino">Masculino</option>
                                <option value="Femenino">Femenino</option>
                            </select>
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
                      <label class="control-label">Procedencia</label>  
                        <div class="controls">
                            <input name="Procedencia" type="text" data-tv-field size="35" style="text-align:center"  class="form-control" placeholder="Procedencia" value=""/>
                      </div>
                      <label class="control-label">Grado</label>  
                        <div class="controls">
                            <select class="form-control" data-style="btn-primary" name="cmbGrado" style="text-align:center"/>
                                <?php 
                                    echo $cmgrado;
                                 ?>
                            </select>
                      </div>
                      <label class="control-label">Tipo Oficial</label>  
                        <div class="controls">
                            <select class="form-control" data-style="btn-primary" name="cmbTipo" style="text-align:center"/>
                                <?php 
                                    echo $cmtipo;
                                 ?>
                            </select>
                      </div>
                      <label class="control-label">Contraseña</label>  
                        <div class="controls">
                            <input name="Password" type="password" data-tv-field size="35" style="text-align:center"  class="form-control" placeholder="Contraseña" value=""/>
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

