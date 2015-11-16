<?php 

include_once('Conexion.php');

class Prontuario_Delictivo{

	function Cargar_Prontuarios()
	{
		$cx=conectar();
		$cmd="SELECT * FROM Prontuario_Delictivo";
		$resultado=mysql_query($cmd);
		desconectar($cx);
		return $resultado;

	}

	function Elegir_Prontuario($datos)
	{
		$cx=conectar();
		$cmd="SELECT * FROM Prontuario_Delictivo WHERE ID_Prontuario='".$datos['ID_Prontuario']."'";
		$resultado=mysql_query($cmd);
		desconectar($cx);
		return $resultado;
	}

	function Insertar_Prontuario_D($datos)
	{
		$cx=conectar();
		$cmd="INSERT INTO Prontuario_Delictivo(ID_D,ID_O,Fecha,Descripcion) values ('".$datos['ID_D']."','".$datos['ID_O']."','".$datos['Fecha']."','".$datos['Descripcion']."')";
		mysql_query($cmd);
		desconectar($cx);
	}

}

