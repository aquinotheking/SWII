<?php 

function conectar() {
	$host="localhost";//mysql14.000webhost.com
	$user="root";//a4323170_taller
	$pass="";//Taller1
	error_reporting(0);
    $cx = mysql_connect($host, $user, $pass)or die('');  
    mysql_select_db('FELCC',$cx)or die("");//a4323170_felcc
    return $cx;
}

function desconectar($conexion) {
    mysql_close($conexion);
}


 ?>