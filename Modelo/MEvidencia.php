<?php 

include_once('Conexion.php'); 

class Evidencia{

	function Cargar_Evidencias()
	{
		$cx=conectar();
		$cmd="SELECT * FROM Evidencia";
		$resultado=mysql_query($cmd);
		desconectar($cx);
		return $resultado;

	}

	function Listar_Evidencias($ID)
	{
		$cx=conectar();
		$cmd="SELECT * FROM Evidencia WHERE CI='".$ID."'";
		$resultado=mysql_query($cmd);
		desconectar($cx);
		return $resultado;
	}

	function Mostrar_Evidencias($ID)
	{
		$cx=conectar();
		$cmd="SELECT * FROM Evidencia WHERE ID_Caso='".$ID."'";
		$resultado=mysql_query($cmd);
		desconectar($cx);
		return $resultado;
	}

	function Insertar_E($datos)
	{
		$cx=conectar();
		$cmd="INSERT INTO Evidencia(ID_Caso,CI,Fecha,Descripcion,Imagen) values ('".$datos['ID_Caso']."','".$datos['CI']."','".$datos['Fecha']."','".$datos['Descripcion']."','".$datos['Imagen']."')";
		mysql_query($cmd);
		desconectar($cx);
	}
}




 ?>