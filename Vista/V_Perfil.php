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

require("../header.php");

include_once("../Modelo/MOficial.php");

include_once("../Modelo/MTipo_O.php");

date_default_timezone_set("America/Asuncion");
$fecha=date("Y/m/d");
$hora=date("h:i:s");

$CI=$_SESSION['CI'];

$mt=new Tipo_Oficial();
  
$mo=new Oficial();

$sx=$mo->Elegir_Oficial($CI);

$sz=$mt->Elegir_Tipo_O();

while ($row = mysql_fetch_array($sx)){ 
                      
        $cs=$mt->Elegir_Tipo_ID($row['Tipo']);

                 while ($r=mysql_fetch_array($cs)) {
                   $nto=$r[0];
               }

        $CI=$row['CI'];
        $Nombre=$row['Nombre'];
        $Direccion=$row['Direccion'];
        $Telefono=$row['Telefono'];
        $Correo=$row['Correo'];
        $Sexo=$row['Sexo'];
        $Estado_Civil=$row['Estado_Civil'];
        $Procedencia=$row['Procedencia'];
        $Cargo=$row['Cargo'];

}

 ?>

<div class="container" style="margin-top: -60px;margin-left: 51px;">
<h1 style="margin-top: -60px; ">PERFIL DEL OFICIAL</h1>
<form class="form-horizontal" style="margin-top: -100px;" id="file-submit" enctype="multipart/form-data" method="POST" action="../Controlador/C_Evidencia.php">
    <div class="form-group">
        <label class="control-label col-xs-3">CI</label>
        <div class="col-xs-6">
            <input type="text"  id="NCF" class="form-control" name="N_Caso" value="<?php echo "$CI"; ?>" readonly="true" style="text-align: center;" />
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-3">Nombre</label>
        <div class="col-xs-6">
            <input type="text" class="form-control" name="Fecha_E" value="<?php echo "$Nombre"; ?>"  readonly="true" style="text-align: center;"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-3">Direccion</label>
        <div class="col-xs-6">
            <input type="text" class="form-control" name="CI_O" value="<?php echo "$Direccion"; ?>" readonly="true" style="text-align: center;"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-3">Telefono:</label>
        <div class="col-xs-6">
            <input type="text" class="form-control" name="CI_O" value="<?php echo "$Telefono"; ?>" readonly="true" style="text-align: center;"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-3">Correo</label>
        <div class="col-xs-6">
            <input type="text" class="form-control" name="CI_O" value="<?php echo "$Correo"; ?>" readonly="true" style="text-align: center;"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-3">Sexo</label>
        <div class="col-xs-6">
            <input type="text" class="form-control" name="CI_O" value="<?php echo "$Sexo"; ?>" readonly="true" style="text-align: center;"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-3">Estado Civil</label>
        <div class="col-xs-6">
            <input type="text" class="form-control" name="CI_O" value="<?php echo "$Estado_Civil"; ?>" readonly="true" style="text-align: center;"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-3">Procedencia</label>
        <div class="col-xs-6">
            <input type="text" class="form-control" name="CI_O" value="<?php echo "$Procedencia"; ?>" readonly="true" style="text-align: center;"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-3">Grado</label>
        <div class="col-xs-6">
            <input type="text" class="form-control" name="CI_O" value="<?php echo "$Cargo"; ?>" readonly="true" style="text-align: center;"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-3">Tipo</label>
        <div class="col-xs-6">
            <input type="text" class="form-control" name="CI_O" value="<?php echo "$nto"; ?>" readonly="true" style="text-align: center;"/>
        </div>
    </div>
<center>
    <a class="btn btn-primary btn-lg" href="V_Evidencias.php" style="margin-top: 30px;">Volver</a>
</center>
</form>
    

</div>

    <script src=".../js/jquery-latest.min.js"></script>
    <script src="../js/responsive.js"></script>
    <script src="../js/bootstrap.min.js"></script>

<?php 

require('../footer.php');

 ?>