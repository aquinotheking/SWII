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

require("../Modelo/MDenuncia.php");
  
$md=new Denuncia();

$sx=$md->Cargar_Denuncias_Activas();


 ?>

 <h1 style="margin-top: -60px;">Denuncias Registradas</h1>
<div class="row" style="margin-top: -90px;">
          <table class="table table-striped table-bordered">
            <thead>
              <tr>
                <th style="background:black; color:white; text-align: center;">Caso</th>
                <th style="background:black; color:white; text-align: center;">Denuncia</th>
                <th style="background:black; color:white; text-align: center;">Lugar</th>
                <th style="background:black; color:white; text-align: center;">Distrito Policial</th>
                <th style="background:black; color:white; text-align: center;">Fecha y Hora</th>
                <th style="background:black; color:white; text-align: center;">Estado</th>
                <th style="background:black; color:white; text-align: center;">Evidencia</th>
              </tr>
            </thead>
            <tbody>
                  <?php while ($row = mysql_fetch_array($sx)){ ?>
                  <?php echo '<tr>';?>
                        <?php echo '<td style="text-align:center;">'. $row['ID_D'] . '</td>';?>
                        <?php echo '<td style="text-align:center;">'. $row['TD'] . '</td>';?>
                        <?php echo '<td style="text-align:center;">'. $row['Lugar'] . '</td>';?>
                        <?php echo '<td style="text-align:center;">'. $row['DP'] . '</td>';?>
                        <?php echo '<td style="text-align:center;">'. $row['FH'] . '</td>';?>
                        <?php echo '<td style="text-align:center;">'. $row['Estado'] . '</td>';?>
                        <?php echo '<td width=300 style="text-align:center;">';?>
                        <?php echo '<a class="btn btn-info" href="../Vista/V_Evidencia.php?ID='.$row['ID_D'].'"">Agregar</a> ';?>
                        <?php echo '<a class="btn btn-success" href="../Vista/VV_Evidencia.php?ID='.$row['ID_D'].'"">Ver</a> ';?>
                        <?php echo '<a class="btn btn-danger" href="../Controlador/C_Evidencia.php?Accion=Cerrar&ID='.$row['ID_D'].'"">Cerrar Caso</a> ';?>
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
