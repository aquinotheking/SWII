<?php 

include_once('Conexion.php');

class Grado{

	function Cargar_Grado()
	{
		$cx=conectar();
		$cmd="SELECT * FROM Grado WHERE Estado=1";
		$resultado=mysql_query($cmd);
		desconectar($cx);
		return $resultado;

	}

	function Elegir_Grado()
	{
		$cx=conectar();
		$cmd="SELECT Nombre FROM Grado WHERE Estado=1";
		$resultado=mysql_query($cmd);
		desconectar($cx);
		return $resultado;

	}

	function Modificar_Grado($datos)
	{
		$cx=conectar();
		$cmd="SELECT Nombre FROM Grado WHERE Nombre='".$datos['Nombre']."'";
		$resultado=mysql_query($cmd);
		desconectar($cx);
		return $resultado;
	}

	function Insertar($datos)
	{
		$cx=conectar();
		$cmd="INSERT INTO Grado(Nombre,Cantidad,Estado) values ('".$datos['Nombre']."','".$datos['Cantidad']."','".$datos['Estado']."')";
		mysql_query($cmd);
		desconectar($cx);
	}

	function Modificar($datos)
	{
		$cx=conectar();
		$cmd="UPDATE Grado SET Nombre='".$datos['Nombre']."' WHERE Nombre='".$datos['ID']."'";
		mysql_query($cmd);
		desconectar($cx);
	}

	function Eliminar($datos)
	{
		$cx=conectar();
		$cmd="UPDATE Grado SET Estado=0 WHERE Nombre='".$datos['Nombre']."'";
		mysql_query($cmd);
		desconectar($cx);
	}

	function Actualizar($Nombre)
	{
		$cx=conectar();
		$cmd="UPDATE Grado SET Cantidad=Cantidad+1 WHERE Nombre='".$Nombre."'";
		mysql_query($cmd);
		desconectar($cx);
	}

}




 ?>