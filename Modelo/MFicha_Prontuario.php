<?php 

include_once('Conexion.php');

class Ficha_Prontuario{

	function Cargar_Fichas_Prontuarios()
	{
		$cx=conectar();
		$cmd="SELECT * FROM Ficha_Prontuario";
		$resultado=mysql_query($cmd);
		desconectar($cx);
		return $resultado;
	}

	function Elegir_Ficha_Prontuario($datos)
	{
		$cx=conectar();
		$cmd="SELECT * FROM Ficha_Prontuario WHERE ID_Prontuario='".$datos['ID_Prontuario']."'";
		$resultado=mysql_query($cmd);
		desconectar($cx);
		return $resultado;
	}

	function Insertar_Ficha_Prontuario($datos)
	{
		$cx=conectar();
		$cmd="INSERT INTO Ficha_Prontuario(ID_Prontuario,CI_Oficial,ID_Delincuente,Fecha,Lugar,Descripcion) values ('".$datos['ID_Prontuario']."','".$datos['CI_Oficial']."','".$datos['ID_Delincuente']."','".$datos['Fecha']."','".$datos['Lugar']."','".$datos['Descripcion']."')";
		mysql_query($cmd);
		desconectar($cx);
	}

}

