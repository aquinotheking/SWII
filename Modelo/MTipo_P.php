<?php 

include_once('Conexion.php');

class Tipo_Persona{

	function Cargar_Tipo_P()
	{
		$cx=conectar();
		$cmd="SELECT * FROM Tipo_Persona WHERE Estado=1";
		$resultado=mysql_query($cmd);
		desconectar($cx);
		return $resultado;

	}

	function Elegir_Tipo_P()
	{
		$cx=conectar();
		$cmd="SELECT ID_TP,Nombre FROM Tipo_Persona WHERE Estado=1";
		$resultado=mysql_query($cmd);
		desconectar($cx);
		return $resultado;

	}

	function Elegir_Tipo_ID($datos)
	{
		$cx=conectar();
		$cmd="SELECT Nombre FROM Tipo_Persona WHERE Estado=1 AND ID_TP='".$datos['ID_TP']."'";
		$resultado=mysql_query($cmd);
		desconectar($cx);
		return $resultado;

	}

	function Modificar_Tipo_P($datos)
	{
		$cx=conectar();
		$cmd="SELECT Nombre,Descripcion FROM Tipo_Persona WHERE ID_TP='".$datos['ID_TP']."'";
		$resultado=mysql_query($cmd);
		desconectar($cx);
		return $resultado;
	}

	function Insertar($datos)
	{
		$cx=conectar();
		$cmd="INSERT INTO Tipo_Persona(Nombre,Descripcion,Estado) values ('".$datos['Nombre']."','".$datos['Descripcion']."','".$datos['Estado']."')";
		mysql_query($cmd);
		desconectar($cx);
	}

	function Modificar($datos)
	{
		$cx=conectar();
		$cmd="UPDATE Tipo_Persona SET Nombre='".$datos['Nombre']."',Descripcion='".$datos['Descripcion']."' WHERE ID_TP='".$datos['ID_TP']."'";
		mysql_query($cmd);
		desconectar($cx);
	}

	function Eliminar($datos)
	{
		$cx=conectar();
		$cmd="UPDATE Tipo_Persona SET Estado=0 WHERE ID_TP='".$datos['ID_TP']."'";
		mysql_query($cmd);
		desconectar($cx);
	}

}




 ?>