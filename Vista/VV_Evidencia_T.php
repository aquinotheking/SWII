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


include_once('../Modelo/MEvidencia.php');

$me=new Evidencia();

$ID=$_REQUEST['ID'];

$sx=$me->Mostrar_Evidencias($ID);

while ($rw=mysql_fetch_array($sx)) {
	$imgs.="<figure itemprop='associatedMedia' itemscope itemtype='http://schema.org/ImageObject' ><a href= '".$rw['Imagen']."' itemprop='contentUrl' data-size='1024x1024'><img src= ".$rw['Imagen']." itemprop='thumbnail' alt='Image description'  /></a><figcaption itemprop='caption description' style='font-size:20px;text-align:center;'><b>Caso:</b> ".$rw['ID_Caso']."  <b>Oficial: </b> ".$rw['CI']."  <b>      Fecha: </b> ".$rw['Fecha']."<br><b>Descripcion:</b> ".$rw['Descripcion']."  </figcaption></figure>";
 }
 ?>

<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Evidencias AYCSOFT</title>
<link rel='stylesheet prefetch' href='http://photoswipe.s3.amazonaws.com/pswp/dist/photoswipe.css'>
<link rel='stylesheet prefetch' href='http://photoswipe.s3.amazonaws.com/pswp/dist/default-skin/default-skin.css'>
<link rel="stylesheet" href="../Visor/css/style.css">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<link   href="../css/bootstrap.min.css" rel="stylesheet">
<script src="../js/bootstrap.min.js"></script>
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/bootstrapValidator.min.js"></script>
    
  </head>

  <body style="background:black; color:white;">

<img src="../Img/escudo.png">  

<img src="../Img/escudo.png" style="float:right;">  

<center><h1 style="margin-top: -80px; margin-left: 150px;">CASO TERMINADO EVIDENCIAS REGISTRADAS</h1></center>
<center>
  <div class="my-simple-gallery" itemscope itemtype="http://schema.org/ImageGallery" style="margin-top: 80px; border-color: white;">

  <?php 

  echo "$imgs";

   ?>  

  </div>
</center>
<!-- Root element of PhotoSwipe. Must have class pswp. -->
<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">

    <!-- Background of PhotoSwipe. 
         It's a separate element, as animating opacity is faster than rgba(). -->
    <div class="pswp__bg"></div>

    <!-- Slides wrapper with overflow:hidden. -->
    <div class="pswp__scroll-wrap">

        <!-- Container that holds slides. PhotoSwipe keeps only 3 slides in DOM to save memory. -->
        <!-- don't modify these 3 pswp__item elements, data is added later on. -->
        <div class="pswp__container">
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
        </div>

        <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
        <div class="pswp__ui pswp__ui--hidden">

            <div class="pswp__top-bar">

                <!--  Controls are self-explanatory. Order can be changed. -->

                <div class="pswp__counter"></div>

                <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>

                <button class="pswp__button pswp__button--share" title="Share"></button>

                <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>

                <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
              
                <button class="pswp__button pswp__button--slideshow" title="Play / Stop">Play/Stop</button>
            

                <!-- Preloader demo http://codepen.io/dimsemenov/pen/yyBWoR -->
                <!-- element will get class pswp__preloader--active when preloader is running -->
                <div class="pswp__preloader">
                    <div class="pswp__preloader__icn">
                      <div class="pswp__preloader__cut">
                        <div class="pswp__preloader__donut"></div>
                      </div>
                    </div>
                </div>
            </div>

            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                <div class="pswp__share-tooltip"></div> 
            </div>

            <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
            </button>

            <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
            </button>
          
            <div class="pswp__caption">
                <div class="pswp__caption__center"></div>
            </div>

          </div>

        </div>

</div>
<center>
	<a class="btn btn-primary btn-lg" href="V_Evidencias_T.php" style="margin-top: 30px;">Volver</a>
</center>
<script src='http://photoswipe.s3-eu-west-1.amazonaws.com/pswp/dist/photoswipe.js'></script>
<script src='http://photoswipe.s3-eu-west-1.amazonaws.com/pswp/dist/photoswipe-ui-default.min.js'></script>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="../Visor/js/index.js"></script>
    	


  </body>
</html>
