<?php 

include_once('Conexion.php');

class Distrito_Policial{

function Cargar_Distrito_Policial()
{
	$cx=conectar();
	$cmd="SELECT * FROM Distrito_Policial WHERE Estado>=1";
	$resultado=mysql_query($cmd);
	desconectar($cx);
	return $resultado;

}

function Modificar_DP($datos)
{
	$cx=conectar();
	$cmd="SELECT Nombre,Direccion,Telefono FROM Distrito_Policial WHERE ID_DP='".$datos['ID_DP']."'";
	$resultado=mysql_query($cmd);
	desconectar($cx);
	return $resultado;
}

function Insertar($datos)
{
	$cx=conectar();
	$cmd="INSERT INTO Distrito_Policial(Nombre,Direccion,Telefono,Estado) values ('".$datos['Nombre']."','".$datos['Direccion']."','".$datos['Telefono']."','".$datos['Estado']."')";
	mysql_query($cmd);
	desconectar($cx);
}

function Modificar($datos)
{
	$cx=conectar();
	$cmd="UPDATE Distrito_Policial SET Nombre='".$datos['Nombre']."',Direccion='".$datos['Direccion']."',Telefono='".$datos['Telefono']."' WHERE ID_DP='".$datos['ID_DP']."'";
	mysql_query($cmd);
	desconectar($cx);
}

function Eliminar($datos)
{
	$cx=conectar();
	$cmd="UPDATE Distrito_Policial SET Estado=0 WHERE ID_DP='".$datos['ID_DP']."'";
	mysql_query($cmd);
	desconectar($cx);
}

}




 ?>