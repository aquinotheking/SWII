<?php 

include_once('Conexion.php');

class Tipo_Denuncia{

	function Cargar_Tipo_D()
	{
		$cx=conectar();
		$cmd="SELECT * FROM Tipo_Denuncia WHERE Estado=1";
		$resultado=mysql_query($cmd);
		desconectar($cx);
		return $resultado;

	}

	function Elegir_Tipo_D()
	{
		$cx=conectar();
		$cmd="SELECT ID_TD,Nombre FROM Tipo_Denuncia WHERE Estado=1";
		$resultado=mysql_query($cmd);
		desconectar($cx);
		return $resultado;

	}

	function Elegir_Tipo_ID($datos)
	{
		$cx=conectar();
		$cmd="SELECT Nombre FROM Tipo_Denuncia WHERE Estado=1 AND ID_TD='".$datos['ID_TD']."'";
		$resultado=mysql_query($cmd);
		desconectar($cx);
		return $resultado;

	}

	function Modificar_Tipo_D($datos)
	{
		$cx=conectar();
		$cmd="SELECT Nombre,Descripcion FROM Tipo_Denuncia WHERE ID_TD='".$datos['ID_TD']."'";
		$resultado=mysql_query($cmd);
		desconectar($cx);
		return $resultado;
	}

	function Insertar($datos)
	{
		$cx=conectar();
		$cmd="INSERT INTO Tipo_Denuncia(Nombre,Descripcion,Estado) values ('".$datos['Nombre']."','".$datos['Descripcion']."','".$datos['Estado']."')";
		mysql_query($cmd);
		desconectar($cx);
	}

	function Modificar($datos)
	{
		$cx=conectar();
		$cmd="UPDATE Tipo_Denuncia SET Nombre='".$datos['Nombre']."',Descripcion='".$datos['Descripcion']."' WHERE ID_TD='".$datos['ID_TD']."'";
		mysql_query($cmd);
		desconectar($cx);
	}

	function Eliminar($datos)
	{
		$cx=conectar();
		$cmd="UPDATE Tipo_Denuncia SET Estado=0 WHERE ID_TD='".$datos['ID_TD']."'";
		mysql_query($cmd);
		desconectar($cx);
	}

}




 ?>