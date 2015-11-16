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


require('../header.php');

include_once('../Modelo/MFicha_Prontuario.php');

date_default_timezone_set("America/Asuncion");
$fecha=date("Y/m/d");
$hora=date("h:i:s");

if(isset($_REQUEST['ID']))
{
    $ID=$_REQUEST['ID'];
    $Alias=$_REQUEST['Alias'];
    $Oficial=$_REQUEST['CI'];
    $Fecha=$_REQUEST['Fecha'];
    $Descripcion=$_REQUEST['Descripcion'];
}
else
{
    header("Location: V_Prontuario_Delictivo.php");
}

$mfp=new Ficha_Prontuario();

$sx=$mfp->Elegir_Ficha_Prontuario($ID);

while ($rw=mysql_fetch_array($sx)) {
   $T_Ficha_Prontuario.=" <tr><td>".$rw['CI_Oficial']."</td><td>".$rw['Fecha']."</td><td>".$rw['Descripcion']."</td></tr>";
 }

?>

<div class="container" style="margin-top: -60px;margin-left: 51px;">
<h1 style="margin-top: -60px;">TARJETA PRONTUARIO</h1>
<form class="form-horizontal" style="margin-top: -100px;" method="POST" action="../Controlador/CDenuncia.php">
    <div class="form-group">
        <label class="control-label col-xs-3">Codigo Prontuario</label>
        <div class="col-xs-3">
            <input type="text"  id="NCF" class="form-control" name="ID_D" value="<?php echo "$ID"; ?>" readonly="true" style="text-align:center;"/>
        </div>
        <label class="control-label col-xs-3">Fecha</label>
        <div class="col-xs-3">
            <input type="text" class="form-control" name="FH" value="<?php echo "$Fecha"; ?>"  readonly="true" style="text-align:center;"/>
        </div>
        <label class="control-label col-xs-3">CI Oficial</label>
        <div class="col-xs-3">
            <input type="text" class="form-control" name="CI_S" value="<?php echo "$Oficial"; ?>" readonly="true" style="text-align:center;"/>
        </div>
        <label class="control-label col-xs-3">Delincuente</label>
        <div class="col-xs-3">
            <input type="text" class="form-control" name="Hora_D" value="<?php echo "$Alias"; ?>" readonly="true" style="text-align:center;"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-3">Descripcion del Hecho:</label>
        <div class="col-xs-9">
            <textarea rows="3" class="form-control" readonly="true" name="Descripcion" style="resize: none;"><?php echo "$Descripcion"; ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-xs-15">
            <table class="table table-hover">
                <tr style="background:black;color:white;">
                    <td>Oficial</td>
                    <td>Fecha</td>
                    <td>Descripcion</td>
                </tr>
                <?php 

                    echo "$T_Ficha_Prontuario";

                 ?>
            </table>
        </div>
    </div>
    <div class="form-group">
        <div class="col-xs-12 ">
            <a href="V_Prontuario_Delictivo.php" class="btn btn-primary btn-lg" name="Registrar" value="Volver">Volver</a>
        </div>
    </div>
</form>
    

</div>

<script src=".../jquery-latest.min.js"></script>
    <script src="../responsive.js"></script>
    <script src="../bootstrap.min.js"></script>

<?php 

require('../footer.php');

 ?>
