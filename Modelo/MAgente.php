<?php 

include_once('Conexion.php');

class Agente{

	function Cargar_Agentes()
	{
		$cx=conectar();
		$cmd="SELECT * FROM Agente WHERE Estado=1";
		$resultado=mysql_query($cmd);
		desconectar($cx);
		return $resultado;
	}

	function Elegir_Agente($ID)
	{
		$cx=conectar();
		$cmd="SELECT * FROM Agente WHERE ID='".$ID."' OR CI='".$ID."'";
		$resultado=mysql_query($cmd);
		desconectar($cx);
		return $resultado;
	}

	function Insertar_Agente($datos)
	{
		$cx=conectar();
		$cmd="INSERT INTO Agente(CI,Nombre,Direccion,Telefono,Correo,Grado,Pass,Latitud,Longitud,Estado) values ('".$datos['CI']."','".$datos['Nombre']."','".$datos['Direccion']."','".$datos['Telefono']."','".$datos['Correo']."','".$datos['Grado']."','".$datos['Pass']."','".$datos['Latitud']."','".$datos['Longitud']."','".$datos['Estado']."')";
		mysql_query($cmd);
		desconectar($cx);
	}

	function Modificar_Agente($datos)
	{
		$cx=conectar();
		$cmd="UPDATE Agente SET Nombre='".$datos['Nombre']."',Direccion='".$datos['Direccion']."',Telefono='".$datos['Telefono']."',Correo='".$datos['Correo']."' WHERE ID='".$datos['ID']."'";
		mysql_query($cmd);
		desconectar($cx);
	}

	function Eliminar_Agente($datos)
	{
		$cx=conectar();
		$cmd="UPDATE Agente SET Estado=0 WHERE ID='".$datos['ID']."'";
		mysql_query($cmd);
		desconectar($cx);
	}

}

