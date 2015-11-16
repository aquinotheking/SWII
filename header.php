<!Doctype html>
<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,700' rel='stylesheet' type='text/css'>

	<link rel="shortcut icon" href="../img/ayc.ico">

	<link rel="stylesheet" href="../Aplicacion/css/reset.css"> <!-- CSS reset -->
	<link rel="stylesheet" href="../Aplicacion/css/style.css"> <!-- Resource style -->
	<script src="../Aplicacion/js/modernizr.js"></script> <!-- Modernizr -->
    <link   href="../css/bootstrap.min.css" rel="stylesheet">
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery.min.js"></script>
  	<script src="../js/bootstrap.min.js"></script>
  	<script src="../js/bootstrapValidator.min.js"></script>

  	<link rel="stylesheet" type="text/css" href="../css/normalize.css" />
	<link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.2.0/css/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" href="../css/demo.css" />
	<link rel="stylesheet" type="text/css" href="../css/set2.css" />

	<script src="../Buscador/js/jquery-1.5.1.min.js"></script>
	<script src="../Buscador/js/jquery-ui-1.8.13.custom.min.js"></script>
	<link href="../Buscador/css/ui-lightness/jquery-ui-1.8.13.custom.css"  />

  	
	<title>AYCSOFT | FELCC</title>
	
</head>
<body>
	<header class="cd-main-header">
		<a href="#0" class="cd-logo"><img src="../img/emblema.png" alt="Logo" style="width:130px; height:55px; margin-top: -15px; margin-left: -25px; "></a>
		<a href="#0" class="cd-nav-trigger">Menu<span></span></a>

		<nav class="cd-nav">
			<ul class="cd-top-nav">
				<li><a href="VContact.php">Contactenos</a></li>
				<li><a href="#" data-toggle="modal" data-target="#about">About</a></li>
				<li class="has-children account">
					<a href="#0">
						<img src="../img/escudo.png" alt="avatar">Cuenta
					</a>
					<ul>
						<li><a href="#" data-toggle="modal" data-target="#FELCC">FELCC</a></li>
						<li><a href="V_Perfil.php">Mi Perfil</a></li>
						<li><a href="../Controlador/C_Logout.php">Salir</a></li>
					</ul>
				</li>
			</ul>
		</nav>
	</header> <!-- .cd-main-header -->

	<main class="cd-main-content" style="margin-top: 50px;" id="sr">
		<nav class="cd-side-nav">
			<ul>
				<li class="cd-label">Administracion</li>
				<li class="has-children overview">
					<a href="#">Oficial</a>
					<ul>
						<li><a href="VGrado.php">Grado</a></li>
						<li><a href="VTipo_O.php">Tipo Oficial</a></li>
						<li><a href="VOficial.php">Oficiales</a></li>
					</ul>
				</li>
				<li class="has-children notifications">
					<a href="VDP.php">Distrito Policial</a>
				</li>
				<li class="has-children images">
					<a href="VReportes.php">Reportes</a>
				</li>
			</ul>

			<ul>
				<li class="cd-label">Solicitud</li>
				<li class="has-children overview">
					<a href="V_Ciudadano.php">Ciudadano</a>
				</li>
				<li class="has-children images">
					<a href="#0">Solicitudes</a>
					<ul>
						<li><a href="#0">Ver Solicitudes</a></li>
					</ul>
				</li>

				<li class="has-children users">
					<a href="#0">Agentes</a>
					
					<ul>
						<li><a href="V_Agentes.php">Agentes</a></li>
						<li><a href="VMapa.php">Ver Mapa</a></li>
					</ul>
				</li>
			</ul>

			<ul>
				<li class="cd-label">Denuncias</li>
				<li class="has-children overview">
					<a href="#0">Denuncia</a>
					<ul>
						<li><a href="VDenuncia.php">Registrar Denuncia</a></li>
						<li><a href="VTipo_D.php">Tipo Denuncia</a></li>
						<li><a href="VDenuncias.php">Ver Denuncias</a></li>
					</ul>
				</li>
				<li class="has-children users">
					<a href="VParte.php">Partes</a>
				</li>

				<li class="has-children bookmarks">
					<a href="#">Evidencias</a>
					<ul>
						<li><a href="V_Evidencias.php">Denuncias En Proceso</a></li>
						<li><a href="V_Evidencias_T.php">Denuncias Terminadas</a></li>
					</ul>
				</li>
			</ul>

			<ul>
				<li class="cd-label">Control</li>
				<li class="has-children users">
					<a href="V_Delincuente.php">Delincuente</a>
				</li>
				<li class="has-children bookmarks">
					<a href="V_Prontuario_Delictivo.php">Prontuario Delictivo</a>
				</li>
			</ul>
		</nav>

<div class="modal fade" data-keyboard="false" data-backdrop="static" id="about" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
          <div class="modal-header" style="background: black; color: white;">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">AYCSOFT</h4>
          </div>
          <div class="modal-body">
          <center>
          	<img src="../img/ayc.jpg" width="300" height="300">
          	<p>Software desarrollado para la materia Taller de Grado a cargo del Ingeniero Alanoca que fue nuestro tutor hasta su completa culminacion</p>
          </center>
        </div>
        <div class="modal-footer">
        <button type="submit" class="btn btn-success" name="Registrar" style="float: left;" onclick="window.open('http://aycsoftw.comule.com/')">Visitar Pagina Web</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        </div>
	</div>
	</div>
</div>

<div class="modal fade" data-keyboard="false" data-backdrop="static" id="FELCC" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
          <div class="modal-header" style="background: black; color: white;">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">F.E.L.C.C</h4>
          </div>
          <div class="modal-body">
          <center>
          	<img src="../img/sombrero.jpg" width="300" height="300">
          	<p>La fuerza especial de lucha contra el crimen es el organismo especializado de la policia nacional, encargado de la prevencion e investigacion de delitos, identificacion y aprehencion de los presuntos responsables, busqueda, recoleccion y custodia de evidencias, el estudio, analisis tecnico cientifico de las pruebas materiales y evacuacion de dictamenes periciales; respetando los derechos humanos y en cumplimiento de las normas legales vigentes</p>
          </center>
        </div>
        <div class="modal-footer">
        <button type="submit" class="btn btn-success" name="Registrar" style="float: left;" onclick="window.open('http://aycsoftw.comule.com/')">Visitar Pagina Web</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        </div>
	</div>
	</div>
</div>
		<div class="content-wrapper">
		



