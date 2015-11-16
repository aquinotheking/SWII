<?php 

include_once('Conexion.php');

class Tipo_Oficial{

	function Cargar_Tipo_O()
	{
		$cx=conectar();
		$cmd="SELECT * FROM Tipo_Oficial WHERE Estado=1";
		$resultado=mysql_query($cmd);
		desconectar($cx);
		return $resultado;

	}

	function Elegir_Tipo_O()
	{
		$cx=conectar();
		$cmd="SELECT ID_Tipo_O,Nombre FROM Tipo_Oficial WHERE Estado=1";
		$resultado=mysql_query($cmd);
		desconectar($cx);
		return $resultado;

	}

	function Elegir_Tipo_ID($datos)
	{
		$cx=conectar();
		$cmd="SELECT Nombre FROM Tipo_Oficial WHERE Estado=1 AND ID_Tipo_O='".$datos['ID_Tipo_O']."'";
		$resultado=mysql_query($cmd);
		desconectar($cx);
		return $resultado;

	}

	function Modificar_Tipo_O($datos)
	{
		$cx=conectar();
		$cmd="SELECT Nombre,Descripcion FROM Tipo_Oficial WHERE ID_Tipo_O='".$datos['ID_Tipo_O']."'";
		$resultado=mysql_query($cmd);
		desconectar($cx);
		return $resultado;
	}

	function Insertar($datos)
	{
		$cx=conectar();
		$cmd="INSERT INTO Tipo_Oficial(Nombre,Descripcion,Cantidad,Estado) values ('".$datos['Nombre']."','".$datos['Descripcion']."','".$datos['Cantidad']."','".$datos['Estado']."')";
		mysql_query($cmd);
		desconectar($cx);
	}

	function Modificar($datos)
	{
		$cx=conectar();
		$cmd="UPDATE Tipo_Oficial SET Nombre='".$datos['Nombre']."',Descripcion='".$datos['Descripcion']."' WHERE ID_Tipo_O='".$datos['ID_Tipo_O']."'";
		mysql_query($cmd);
		desconectar($cx);
	}

	function Eliminar($datos)
	{
		$cx=conectar();
		$cmd="UPDATE Tipo_Oficial SET Estado=0 WHERE ID_Tipo_O='".$datos['ID_Tipo_O']."'";
		mysql_query($cmd);
		desconectar($cx);
	}

	function Actualizar($ID)
	{
		$cx=conectar();
		$cmd="UPDATE Tipo_Oficial SET Cantidad=Cantidad+1 WHERE ID_Tipo_O='".$ID."'";
		mysql_query($cmd);
		desconectar($cx);
	}

}




 ?>