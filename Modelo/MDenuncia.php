<?php 

include_once('Conexion.php');

class Denuncia{

	function Cargar_Denuncias()
	{
		$cx=conectar();
		$cmd="SELECT * FROM Denuncia";
		$resultado=mysql_query($cmd);
		desconectar($cx);
		return $resultado;

	}

	function Cargar_Denuncias_Terminadas()
	{
		$cx=conectar();
		$cmd="SELECT * FROM Denuncia WHERE Estado='TERMINADO'";
		$resultado=mysql_query($cmd);
		desconectar($cx);
		return $resultado;

	}

	function Cargar_Denuncias_Activas()
	{
		$cx=conectar();
		$cmd="SELECT * FROM Denuncia WHERE Estado='EN INVESTIGACION'";
		$resultado=mysql_query($cmd);
		desconectar($cx);
		return $resultado;

	}

	function Elegir_Denuncia($ID)
	{
		$cx=conectar();
		$cmd="SELECT * FROM Denuncia WHERE ID_D='".$ID."'";
		$resultado=mysql_query($cmd);
		desconectar($cx);
		return $resultado;
	}

	function Insertar($datos)
	{
		$cx=conectar();
		$cmd="INSERT INTO Denuncia(ID_D,FH,CI_S,DP,TD,Lugar,Descripcion,Estado) values ('".$datos['ID_D']."','".$datos['FH']."','".$datos['CI_S']."','".$datos['DP']."','".$datos['TD']."','".$datos['Lugar']."','".$datos['Descripcion']."','".$datos['Estado']."')";
		mysql_query($cmd);
		desconectar($cx);
	}

	function Terminar_Caso($ID)
	{
		$cx=conectar();
		$cmd="UPDATE Denuncia SET Estado='TERMINADO' WHERE ID_D='".$ID."'";
		mysql_query($cmd);
		desconectar($cx);
	}

	function ActualizarND()
	{
		$cx=conectar();
		$cmd="UPDATE Distrito_Policial SET Estado=Estado+1 WHERE ID_DP=1";
		mysql_query($cmd);
		desconectar($cx);
	}

	function ND()
	{
		$cx=conectar();
		$cmd="SELECT Estado FROM Distrito_Policial WHERE ID_DP=1";
		$resultado=mysql_query($cmd);
		desconectar($cx);
		return $resultado;
	}

}




 ?>