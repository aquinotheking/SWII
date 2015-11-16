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


include_once('../header.php');

 ?>
<script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>
<script type="text/javascript"><!--
<?php 
  

 ?>
    function initialize() {
        var latlng = new google.maps.LatLng(-17.8,-63.1667);
        var settings = {
            zoom: 13,
            center: latlng,
            mapTypeControl: true,
            navigationControl: true,
            navigationControlOptions: {style: google.maps.NavigationControlStyle.SMALL},
            mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var map = new google.maps.Map(document.getElementById("map_canvas"), settings);
    var company = new google.maps.LatLng(-17.776151, -63.181251);
    var companyM = new google.maps.Marker({
    position: company,
    map: map,
    icon:"../img/Markers/police.png",
    title:"Oficial Aquino"
  });
  var content = '<div id="content">'+
    '<div id="siteNotice" style="width:150px; height:0px; background:black;"><img src="../img/ayc.jpg" style="width:35px; height:35px; float:left; background:black;"/>'+
    '</div>'+
    '<div id="bodyContent" >'+
    '<p style="text-align:center;font-size:25px; background:black;color:white;" ><b>OFICIAL</b></p>'+
    '<p style="margin-top:10px;">9001961</p>'+
    '<p>Ramiro Aquino Romero</p>'+
    '<p>Coronel</p>'+
    '<p>60000101</p>'+
    '</div>'+
    '</div>';

    var companyPos = new google.maps.LatLng(-17.776151, -63.20);
    var companyMarker = new google.maps.Marker({
    position: companyPos,
    map: map,
    title:"Oficial Aquino"
  });
  var contentString = '<div id="content">'+
    '<div id="siteNotice" style="width:150px; height:0px; background:black;"><img src="../img/ayc.jpg" style="width:35px; height:35px; float:left; background:black;"/>'+
    '</div>'+
    '<div id="bodyContent" >'+
    '<p style="text-align:center;font-size:25px; background:black;color:white;" ><b>OFICIAL</b></p>'+
    '<p style="margin-top:10px;">9001961</p>'+
    '<p>Ramiro Aquino Romero</p>'+
    '<p>Coronel</p>'+
    '<p>60000101</p>'+
    '</div>'+
    '</div>';
 
var infowindow = new google.maps.InfoWindow({
    content: contentString
});
  google.maps.event.addListener(companyMarker, 'click', function() {
infowindow.open(map,companyMarker);
});
  google.maps.event.addListener(companyM, 'click', function() {
infowindow.open(map,companyM);
});
  }
    </script>
<body onload="initialize()">
<h1 style="font-size: 40px; margin-top: -60px;">MAPA DE AGENTES POLICIALES EN SERVICIO</h1>
  <div id="map_canvas" style="width:1000px; height:600px; margin-top: -170px;border-style: solid double"></div>
</body>

<?php 

include_once('../footer.php');

 ?>