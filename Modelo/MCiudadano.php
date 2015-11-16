<?php 

include_once('Conexion.php');

class Ciudadano{

	function Cargar_Ciudadanos()
	{
		$cx=conectar();
		$cmd="SELECT * FROM Ciudadano ";
		$resultado=mysql_query($cmd);
		desconectar($cx);
		return $resultado;

	}

	function Liberar_Ciudadano($datos)
	{
		$cx=conectar();
		$cmd="UPDATE Ciudadano SET Estado=1 WHERE ID='".$datos['ID']."'";
		mysql_query($cmd);
		desconectar($cx);
	}

}




 ?>