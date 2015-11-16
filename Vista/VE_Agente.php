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

if(isset($_REQUEST['ID']))
{
    $ID=$_REQUEST['ID'];    
}
else
{
    header("Location: V_Agentes.php");
}

include('../header.php');

include_once("../Modelo/MAgente.php");
  
$ma=new Agente();


$sx=$ma->Elegir_Agente($ID);

$Nm="";

$Dc="";

while ($row=mysql_fetch_array($sx)) {
	$Nm=$row['Nombre'];
}

 ?>
 <form action="../Controlador/C_Agente.php" method="POST">
<div class="container" >
<h2 style="font-size: 40px; color:black; margin-left: 55px; margin-top: 80px;">Eliminar Agente Policial</h2>
 <section class="content bgcolor-1" style="margin-left: 80px;">
				<span class="input input--nao">
					<input class="input__field input__field--nao" type="text" id="input-1" name="CI" value="<?php echo "$ID"; ?>" />
					<label class="input__label input__label--nao" for="input-1">
						<span class="input__label-content input__label-content--nao">CI</span>
					</label>
					<svg class="graphic graphic--nao" width="300%" height="100%" viewBox="0 0 1200 60" preserveAspectRatio="none">
						<path d="M0,56.5c0,0,298.666,0,399.333,0C448.336,56.5,513.994,46,597,46c77.327,0,135,10.5,200.999,10.5c95.996,0,402.001,0,402.001,0"/>
					</svg>
				</span></br>
				<span class="input input--nao">
					<input class="input__field input__field--nao" type="text" id="input-2" name="Nombre" value="<?php echo "$Nm"; ?>" />
					<label class="input__label input__label--nao" for="input-2">
						<span class="input__label-content input__label-content--nao">Nombre</span>
					</label>
					<svg class="graphic graphic--nao" width="300%" height="100%" viewBox="0 0 1200 60" preserveAspectRatio="none">
						<path d="M0,56.5c0,0,298.666,0,399.333,0C448.336,56.5,513.994,46,597,46c77.327,0,135,10.5,200.999,10.5c95.996,0,402.001,0,402.001,0"/>
					</svg>
				</span></br>
				<span class="input input--nao">
					<input class="input__field input__field--nao" type="text" id="input-3" name="Motivo" />
					<label class="input__label input__label--nao" for="input-3">
						<span class="input__label-content input__label-content--nao">Motivo</span>
					</label>
					<svg class="graphic graphic--nao" width="300%" height="100%" viewBox="0 0 1200 60" preserveAspectRatio="none">
						<path d="M0,56.5c0,0,298.666,0,399.333,0C448.336,56.5,513.994,46,597,46c77.327,0,135,10.5,200.999,10.5c95.996,0,402.001,0,402.001,0"/>
					</svg></br>
				</span>
			</section>
			<input type="submit" class="btn btn-danger btn-lg" value="Eliminar" name="Eliminar" />
</div>
</form>
<script src="../js/classie.js"></script>
		<script>
			(function() {
				// trim polyfill : https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/Trim
				if (!String.prototype.trim) {
					(function() {
						// Make sure we trim BOM and NBSP
						var rtrim = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g;
						String.prototype.trim = function() {
							return this.replace(rtrim, '');
						};
					})();
				}

				[].slice.call( document.querySelectorAll( 'input.input__field' ) ).forEach( function( inputEl ) {
					// in case the input is already filled..
					if( inputEl.value.trim() !== '' ) {
						classie.add( inputEl.parentNode, 'input--filled' );
					}

					// events:
					inputEl.addEventListener( 'focus', onInputFocus );
					inputEl.addEventListener( 'blur', onInputBlur );
				} );

				function onInputFocus( ev ) {
					classie.add( ev.target.parentNode, 'input--filled' );
				}

				function onInputBlur( ev ) {
					if( ev.target.value.trim() === '' ) {
						classie.remove( ev.target.parentNode, 'input--filled' );
					}
				}
			})();
		</script>
<?php 

require('../footer.php');

 ?>