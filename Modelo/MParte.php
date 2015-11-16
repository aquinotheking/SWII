<?php 

include_once('Conexion.php');

class Parte{

	function Cargar_Parte($Tipo)
	{
		$cx=conectar();
		$cmd="SELECT * FROM Partes WHERE Tipo='".$Tipo."'";
		$resultado=mysql_query($cmd);
		desconectar($cx);
		return $resultado;

	}

	function Modificar_P($id)
	{
		$cx=conectar();
		$cmd="SELECT Nombre,Domicilio,Telefono FROM Partes WHERE ID_Parte='".$id."'";
		$resultado=mysql_query($cmd);
		desconectar($cx);
		return $resultado;
	}

	function Insertar($datos)
	{
		$cx=conectar();
		$cmd="INSERT INTO Partes(Nombre,Fecha,EC,Sexo,CI,Telefono,Nacionalidad,Domicilio,Profesion,Tipo) values ('".$datos['Nombre']."','".$datos['Fecha']."','".$datos['EC']."','".$datos['Sexo']."','".$datos['CI']."','".$datos['Telefono']."','".$datos['Nacionalidad']."','".$datos['Domicilio']."','".$datos['Profesion']."','".$datos['Tipo']."')";
		mysql_query($cmd);
		desconectar($cx);
	}

	function Modificar($datos)
	{
		$cx=conectar();
		$cmd="UPDATE Partes SET Nombre='".$datos['Nombre']."',Domicilio='".$datos['Domicilio']."',Telefono='".$datos['Telefono']."' WHERE ID_Parte='".$datos['ID_Parte']."'";
		mysql_query($cmd);
		desconectar($cx);
	}

	function Cargar_Tipo_P()
	{
		$cx=conectar();
		$cmd="SELECT Tipo,COUNT(Tipo) as Cantidad FROM Partes GROUP BY Tipo";
		$resultado=mysql_query($cmd);
		desconectar($cx);
		return $resultado;
	}
}




 ?>