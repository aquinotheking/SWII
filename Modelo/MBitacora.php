<?php 

include_once('Conexion.php');

class Bitacora{

function Cargar_Bitacora()
{
	$cxs=conectar();
	$cmd="SELECT * FROM Bitacora ";
	$resultado=mysql_query($cmd);
	desconectar($cx);
	return $resultado;

}

function Modificar_Tipo_O($datos)
{
	$cxs=conectar();
	$cmd="SELECT Nombre,Descripcion FROM Tipo_Oficial WHERE ID_Tipo_O='".$datos['ID_Tipo_O']."'";
	$resultado=mysql_query($cmd);
	desconectar($cx);
	return $resultado;
}

function Insertar($bt)
{
	$cxs=conectar();
	$cmd="INSERT INTO Bitacora(CI_Oficial,Fecha,Hora,Accion,Motivo) values ('".$bt['CI_Oficial']."','".$bt['Fecha']."','".$bt['Hora']."','".$bt['Accion']."','".$bt['Motivo']."')";
	mysql_query($cmd);
	desconectar($cx);
}



}




 ?>