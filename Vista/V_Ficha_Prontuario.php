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

date_default_timezone_set("America/Asuncion");
$fecha=date("Y/m/d");
$hora=date("h:i:s");

if(isset($_REQUEST['ID']))
{
    $ID=$_REQUEST['ID'];
    $ID_D=$_REQUEST['ID_D'];
    $Alias=$_REQUEST['Alias'];    
    $CI=$_SESSION['CI'];
}
else
{
    header("Location: V_Prontuario_Delictivo.php");
}

 ?>

<div class="container" style="margin-top: -60px;margin-left: 30px;">
<h1 style="margin-top: -60px; margin-left: 200px;">FICHA PRONTUARIO DELICTIVO</h1>
<form class="form-horizontal" style="margin-top: -100px; margin-left: 300px;"  method="POST" action="../Controlador/C_Ficha_Prontuario.php">
    <div class="form-group">
        <label class="control-label col-xs-2">Codigo</label>
        <div class="col-xs-7">
            <input type="text"  id="NCF" class="form-control" name="Caso" value="<?php echo "$ID_D"; ?>" readonly="true" style="text-align: center;" />
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-2">Oficial</label>
        <div class="col-xs-7">
            <input type="text" class="form-control" name="Oficial" value="<?php echo "$CI"; ?>" readonly="true" style="text-align: center;"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-2">Alias</label>
        <div class="col-xs-7">
            <input type="text" class="form-control" name="Delincuente" value="<?php echo "$Alias"; ?>" readonly="true" style="text-align: center;"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-2">Fecha</label>
        <div class="col-xs-7">
            <input type="text" class="form-control" name="Fecha" value="<?php echo "$fecha-$hora"; ?>"  readonly="true" style="text-align: center;"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-2">Lugar</label>
        <div class="col-xs-7">
            <input type="text" class="form-control" name="Lugar" value="" placeholder="Lugar del Hecho" style="text-align: center;"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-1">Descripcion:</label>
    </div>
    <div class="form-group">
        <div class="col-xs-9">
            <textarea rows="6" class="form-control" name="Descripcion" placeholder="Descripcion del Hecho" style="resize: none;"></textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-xs-9 ">
            <input type="submit" class="btn btn-primary btn-lg btn-block" name="Registrar" value="Registrar Ficha">
        </div>
    </div>
    <input type="text" name="ID_D" value="<?php echo "$ID_D"; ?>" style="display:none;"/>
    </form>
    </div>

    
<?php 

require('../footer.php');

 ?>