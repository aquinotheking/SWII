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

require("../Modelo/MCiudadano.php");
  
$mc=new Ciudadano();

$sx=$mc->Cargar_Ciudadanos();


 ?>

 <h1 style="margin-top: -60px;">Ciudadanos Registrados</h1>
<div class="row" style="margin-top: -90px;">
          <table class="table table-striped table-bordered">
            <thead>
              <tr>
                <th style="background:black; color:white; text-align: center;">Codigo</th>
                <th style="background:black; color:white; text-align: center;">CI</th>
                <th style="background:black; color:white; text-align: center;">Nombre</th>
                <th style="background:black; color:white; text-align: center;">Apellidos</th>
                <th style="background:black; color:white; text-align: center;">Correo</th>
                <th style="background:black; color:white; text-align: center;">Estado</th>
              </tr>
            </thead>
            <tbody>
                  <?php while ($row = mysql_fetch_array($sx)){ ?>
                  <?php echo '<tr>';?>
                        <?php echo '<td style="text-align:center;">'. $row['ID'] . '</td>';?>
                        <?php echo '<td style="text-align:center;">'. $row['CI'] . '</td>';?>
                        <?php echo '<td style="text-align:center;">'. $row['Nombre'] . '</td>';?>
                        <?php echo '<td style="text-align:center;">'. $row['Apellido'] . '</td>';?>
                        <?php echo '<td style="text-align:center;">'. $row['Correo'] . '</td>';?>
                        <?php echo '<td width=300 style="text-align:center;">';?>
                        <?php echo '<a class="btn btn-primary" href="../Controlador/C_Ciudadano.php?Accion=Liberar&ID='.$row['ID'].'"">Liberar</a> ';?>
                        <?php echo '</td>';?>
                <?php }?>
            </tbody>
          </table>
            
      </form>
    </div>
  </div>

<?php 

require('../footer.php')

 ?>
