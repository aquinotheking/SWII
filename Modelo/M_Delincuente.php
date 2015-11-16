<?php 

include_once('Conexion.php');

class Delincuente{

	function Cargar_Delincuentes()
	{
		$cx=conectar();
		$cmd="SELECT * FROM Delincuente";
		$resultado=mysql_query($cmd);
		desconectar($cx);
		return $resultado;

	}

	function Elegir_Delincuente($datos)
	{
		$cx=conectar();
		$cmd="SELECT * FROM Delincuente WHERE ID_Delincuente='".$datos['ID_Delincuente']."'";
		$resultado=mysql_query($cmd);
		desconectar($cx);
		return $resultado;
	}

	function Insertar_Delincuente($datos)
	{
		$cx=conectar();
		$cmd="INSERT INTO Delincuente(Nombre,CI,Alias,Sexo,EC,Fecha) values ('".$datos['Nombre']."','".$datos['CI']."','".$datos['Alias']."','".$datos['Sexo']."','".$datos['EC']."','".$datos['Fecha']."')";
		mysql_query($cmd);
		desconectar($cx);
	}

	function Modificar_Delincuente($datos)
	{
		$cx=conectar();
		$cmd="UPDATE Delincuente SET CI='".$datos['CI']."',Nombre='".$datos['Nombre']."',Alias='".$datos['Alias']."' WHERE ID_Delincuente='".$datos['ID_Delincuente']."'";
		mysql_query($cmd);
		desconectar($cx);
	}

}




 ?>