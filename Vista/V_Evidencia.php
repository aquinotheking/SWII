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
}
else
{
    header("Location: V_Evidencias.php");
}

$CI=$_SESSION['CI'];
 ?>

    <script src="../js/jquery-1.11.3.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"/>
    <script src="../js/jquery-latest.min.js"></script>
    <style type="text/css">

.thumbnail {
    width: 150px;
    margin: 0 auto;
    margin-bottom: 10px;
}

#preview {
    position: relative;
}

#preview a {
    position: absolute;
    bottom: 5px;
    left: 5px;
    right: 5px;
    display: none;
}

#file-info {
    text-align: center;
    display: block;
}

input[type=file] {
    position: absolute;
    visibility: hidden;
    width: 0;
    z-index: -9999;
}

#file-save {
    text-align:center;
    width: 171px;
}
    </style>


    <script type="text/javascript">

    $(document).on('ready',function () {
    $('#preview').hover(
    function() {
        $(this).find('a').fadeIn();
    }, function() {
        $(this).find('a').fadeOut();
    }
)
$('#file-select').on('click', function(e) {
     e.preventDefault();
    
    $('#file').click();
})

$('input[type=file]').change(function() {
    var file = (this.files[0].name).toString();
    var reader = new FileReader();
    
    $('#file-info').text('');
    $('#file-info').text(file);
    
     reader.onload = function (e) {
         $('#preview img').attr('src', e.target.result);
     }
     
     reader.readAsDataURL(this.files[0]);
    });
});
</script>
<div class="container" style="margin-top: -60px;margin-left: 51px;">
<h1 style="margin-top: -60px; margin-left: -280px;">FORMULARIO DE EVIDENCIA</h1>
<form class="form-horizontal" style="margin-top: -100px;" id="file-submit" enctype="multipart/form-data" method="POST" action="../Controlador/C_Evidencia.php">
    <div class="form-group">
        <label class="control-label col-xs-3">Numero de Caso</label>
        <div class="col-xs-3">
            <input type="text"  id="NCF" class="form-control" name="N_Caso" value="<?php echo "$ID"; ?>" readonly="true" style="text-align: center;" />
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-3">Fecha</label>
        <div class="col-xs-3">
            <input type="text" class="form-control" name="Fecha_E" value="<?php echo "$fecha-$hora"; ?>"  readonly="true" style="text-align: center;"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-3">CI Oficial</label>
        <div class="col-xs-3">
            <input type="text" class="form-control" name="CI_O" value="<?php echo "$CI"; ?>" readonly="true" style="text-align: center;"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-1">Descripcion:</label>
    </div>
    <div class="form-group">
        <div class="col-xs-9">
            <textarea rows="3" class="form-control" name="Descripcion" placeholder="Descripcion del Hecho" style="resize: none;"></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-1">Evidencia</label>
    </div>
    <div class="form-group">
        <div class="col-xs-9">
            <div id="preview" class="thumbnail">
            <a href="#" id="file-select" class="btn btn-default">Elegir archivo</a>
            <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxNzEiIGhlaWdodD0iMTgwIj48cmVjdCB3aWR0aD0iMTcxIiBoZWlnaHQ9IjE4MCIgZmlsbD0iI2VlZSI+PC9yZWN0Pjx0ZXh0IHRleHQtYW5jaG9yPSJtaWRkbGUiIHg9Ijg1LjUiIHk9IjkwIiBzdHlsZT0iZmlsbDojYWFhO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1zaXplOjEycHg7Zm9udC1mYW1pbHk6QXJpYWwsSGVsdmV0aWNhLHNhbnMtc2VyaWY7ZG9taW5hbnQtYmFzZWxpbmU6Y2VudHJhbCI+MTcxeDE4MDwvdGV4dD48L3N2Zz4="/>
        </div>
        <span class="alert alert-info" id="file-info">No hay archivo aún</span>
                <input id="file" name="file" type="file"/>
                <button name="Registrar"  class="btn btn-primary btn-lg" id="file-save">Guardar</button>
        </div>
    </div>
</form>
    

</div>

    <script src=".../js/jquery-latest.min.js"></script>
    <script src="../js/responsive.js"></script>
    <script src="../js/bootstrap.min.js"></script>

<?php 

require('../footer.php');

 ?>