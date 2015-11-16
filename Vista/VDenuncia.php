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

include_once('../Modelo/MTipo_D.php');

include_once('../Modelo/MD_Partes.php');

include_once('../Modelo/MOficial.php');

include_once('../Modelo/MDenuncia.php');

include_once('../Modelo/MD_Investigador.php');

include_once('../Modelo/MDP.php');

$mtd=new Tipo_Denuncia();

$mo=new Oficial();

$mdp=new Detalle_Partes();

$md=new Denuncia();

$mdi=new Detalle_Investigador();

$mp=new Distrito_Policial();

$CIO=$_SESSION['CI'];

$sz=$md->ND();

$Denunciante="Denunciante";$Imputado="Imputado";$Victima="Victima"; $Testigo="Testigo";

$sx=$mtd->Cargar_Tipo_D();

$sy=$mo->Cargar_Oficiales_Inv();

date_default_timezone_set("America/Asuncion");
$fecha=date("d/m/Y");
$hora=date("h:i:s");

while ($row=mysql_fetch_array($sz)) {
    $NC=$row['Estado'];
  }

$sdi=$mdi->Cargar_Detalle($NC);

$sa=$mdp->Cargar_Detalle($Denunciante,$NC);
$sb=$mdp->Cargar_Detalle($Imputado,$NC);
$sc=$mdp->Cargar_Detalle($Victima,$NC);
$sd=$mdp->Cargar_Detalle($Testigo,$NC);

$sf=$mp->Cargar_Distrito_Policial();

while ($row=mysql_fetch_array($sf)) {
    $cmdp.=" <option value='".$row['Nombre']."'>".$row['Nombre']."</option>";
  }

while ($row=mysql_fetch_array($sx)) {
    $cmtd.=" <option value='".$row['Nombre']."'>".$row['Nombre']."</option>";
  }

while ($rw=mysql_fetch_array($sy)) {
   $cmo.=" <option value='".$rw['CI']."'>".$rw['Cargo']. " - " .$rw['Nombre']."</option>";
 }

while ($rw=mysql_fetch_array($sa)) {
   $tdd.=" <tr><td>".$rw['CI']."</td><td>".$rw['Nombre']."</td><td>".$rw['Domicilio']."</td><td>".$rw['Telefono']."</td></tr>";
 }

 while ($rw=mysql_fetch_array($sb)) {
   $tdi.=" <tr><td>".$rw['CI']."</td><td>".$rw['Nombre']."</td><td>".$rw['Domicilio']."</td><td>".$rw['Telefono']."</td></tr>";
 }

 while ($rw=mysql_fetch_array($sc)) {
   $tdv.=" <tr><td>".$rw['CI']."</td><td>".$rw['Nombre']."</td><td>".$rw['Domicilio']."</td><td>".$rw['Telefono']."</td></tr>";
 }

 while ($rw=mysql_fetch_array($sd)) {
   $tdt.=" <tr><td>".$rw['CI']."</td><td>".$rw['Nombre']."</td><td>".$rw['Domicilio']."</td><td>".$rw['Telefono']."</td></tr>";
 }

  while ($rw=mysql_fetch_array($sdi)) {
   $tdinv.=" <tr><td>".$rw['CI']."</td><td>".$rw['Nombre']."</td><td>".$rw['Cargo']."</td></tr>";
 }


 ?>

<script type="text/javascript">
    function PasarDenunciante(){
        var valor = document.getElementById("NCF").value;
        var tipo = document.getElementById("lblDenunciante").innerHTML;
        window.location.href="VD_Denunciante.php?ID="+valor+"&Tipo="+tipo;
    }
    function PasarImputado(){
        var valor = document.getElementById("NCF").value;
        var tipo = document.getElementById("lblImputado").innerHTML;
        window.location.href="VD_Denunciante.php?ID="+valor+"&Tipo="+tipo;
    }
    function PasarVictima(){
        var valor = document.getElementById("NCF").value;
        var tipo = document.getElementById("lblVictima").innerHTML;
        window.location.href="VD_Denunciante.php?ID="+valor+"&Tipo="+tipo;
    }
    function PasarTestigo(){
        var valor = document.getElementById("NCF").value;
        var tipo = document.getElementById("lblTestigo").innerHTML;
        window.location.href="VD_Denunciante.php?ID="+valor+"&Tipo="+tipo;
    }
    function PasarCD(){
        var valor = document.getElementById("NCF").value;
        window.location.href="VD_Investigador.php?ID="+valor;
    }
</script>


<div class="container" style="margin-top: -60px;margin-left: 51px;">
<h1 style="margin-top: -60px;">FORMULARIO DE DENUNCIA</h1>
<form class="form-horizontal" style="margin-top: -100px;" method="POST" action="../Controlador/CDenuncia.php">
    <div class="form-group">
        <label class="control-label col-xs-3">Numero de Caso</label>
        <div class="col-xs-3">
            <input type="text"  id="NCF" class="form-control" name="ID_D" value="<?php echo "$NC"; ?>" readonly="true" style="text-align:center;"/>
        </div>
        <label class="control-label col-xs-3">Fecha</label>
        <div class="col-xs-3">
            <input type="text" class="form-control" name="FH" value="<?php echo "$fecha"; ?>"  readonly="true" style="text-align:center;"/>
        </div>
        <label class="control-label col-xs-3">CI Oficial</label>
        <div class="col-xs-3">
            <input type="text" class="form-control" name="CI_S" value="<?php echo "$CIO"; ?>" readonly="true" style="text-align:center;"/>
        </div>
        <label class="control-label col-xs-3">Hora</label>
        <div class="col-xs-3">
            <input type="text" class="form-control" name="Hora_D" value="<?php echo "$hora"; ?>" readonly="true" style="text-align:center;"/>
        </div>
        <label class="control-label col-xs-3">Tipo de Denuncia</label>
        <div class="col-xs-3">
            <select  class="form-control" name="cmbTD" id="CmbTD" style="text-align:center;">
                    <?php echo "$cmtd";  ?>
            </select>
        </div>
        <label class="control-label col-xs-3">Distrito Policial</label>
        <div class="col-xs-3">
            <select  class="form-control" name="cmbDP" id="CmbDP" style="text-align:center;">
                    <?php echo "$cmdp";  ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-3">Lugar del Hecho:</label>
        <div class="col-xs-9">
            <input type="text" class="form-control" name="LugarH" placeholder="Lugar del Hecho">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-3">Descripcion del Hecho:</label>
        <div class="col-xs-9">
            <textarea rows="3" class="form-control" name="DescripcionH" placeholder="Descripcion del Hecho" style="resize: none;"></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-3">Investigador Asignado:</label>
        <div class="col-xs-6">
            <a href="javascript:PasarCD();" class="btn btn-primary" onclick="PasarCD();">Agregar</a> 
        </div>
    </div>
    <div class="form-group">
        <div class="col-xs-12">
            <table class="table table-hover">
                <tr style="background:black;color:white;">
                    <td>CI</td>
                    <td>Nombre</td>
                    <td>Grado</td>
                </tr>
                <?php 

                    echo "$tdinv";

                 ?>
            </table>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-3" id="lblDenunciante">Denunciante</label>
        <div class="col-xs-6">
            <a href="javascript:PasarDenunciante();" class="btn btn-danger" onclick="PasarDenunciante();">Agregar</a> 
        </div>
    </div>
    <div class="form-group">
        <div class="col-xs-12">
            <table class="table table-hover">
                <tr style="background:black;color:white;">
                    <td>CI</td>
                    <td>Nombre</td>
                    <td>Domicilio</td>
                    <td>Telefono</td>
                </tr>
                <?php 

                    echo "$tdd";

                 ?>
            </table>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-3" id="lblImputado">Imputado</label>
        <div class="col-xs-6">
            <a href="javascript:PasarImputado();" class="btn btn-warning" onclick="PasarImputado();">Agregar</a>
        </div>
    </div>
    <div class="form-group">
        <div class="col-xs-12">
            <table class="table table-hover">
                <tr style="background:black;color:white;">
                    <td>CI</td>
                    <td>Nombre</td>
                    <td>Domicilio</td>
                    <td>Telefono</td>
                </tr>
                <?php 

                    echo "$tdi";

                 ?>
            </table>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-3" id="lblVictima">Victima</label>
        <div class="col-xs-6">
            <a href="javascript:PasarVictima();" class="btn btn-success" onclick="PasarVictima();">Agregar</a>
        </div>
    </div>
    <div class="form-group">
        <div class="col-xs-12">
            <table class="table table-hover">
                <tr style="background:black;color:white;">
                    <td>CI</td>
                    <td>Nombre</td>
                    <td>Domicilio</td>
                    <td>Telefono</td>
                </tr>
                <?php 

                    echo "$tdv";

                 ?>
            </table>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-3" id="lblTestigo">Testigo</label>
        <div class="col-xs-6">
            <a href="javascript:PasarTestigo();" class="btn btn-info" onclick="PasarTestigo();">Agregar</a>
        </div>
    </div>
    <div class="form-group">
        <div class="col-xs-12">
            <table class="table table-hover">
                <tr style="background:black;color:white;">
                    <td>CI</td>
                    <td>Nombre</td>
                    <td>Domicilio</td>
                    <td>Telefono</td>
                </tr>
                <?php 

                    echo "$tdt";

                 ?>
            </table>
        </div>
    </div>
    <div class="form-group">
        <div class="col-xs-12 ">
            <input type="submit" class="btn btn-primary btn-lg btn-block" name="Registrar" value="Registrar Denuncia">
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
 