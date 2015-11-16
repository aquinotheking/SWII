<?php 

include_once('Conexion.php');

class Detalle_Investigador{

	function Cargar_Detalle($Codigo)
	{
		$cx=conectar();
		$cmd="SELECT * FROM Detalle_Investigador WHERE ID_D='".$Codigo."' ";
		$resultado=mysql_query($cmd);
		desconectar($cx);
		return $resultado;
	}

	function Insertar($datos)
	{
		$cx=conectar();
		$cmd="INSERT INTO Detalle_Investigador(ID_D,CI,Nombre,Cargo) values ('".$datos['ID_D']."','".$datos['CI']."','".$datos['Nombre']."','".$datos['Cargo']."')";
		mysql_query($cmd);
		desconectar($cx);
	}

	function Eliminar($datos)
	{
		$cx=conectar();
		$cmd="Delete FROM Detalle_Investigador WHERE ID_D='".$datos['ID_D']."' AND CI='".$datos['CI']."'";
		mysql_query($cmd);
		desconectar($cx);
	}

}




 ?>